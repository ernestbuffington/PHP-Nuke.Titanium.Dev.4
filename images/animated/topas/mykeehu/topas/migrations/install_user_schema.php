<?php
/**
*
* Topic Password. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017, Mykee
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace mykeehu\topas\migrations;

class install_user_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return (isset($this->config['topic_password_version']) && version_compare($this->config['topic_password_version'], '3.0.0', '>='));
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_schema()
	{
		return array(
			'add_tables' 		=> array(
				$this->table_prefix . 'topics_access'	=> array(
					'COLUMNS'    		=> array(
						'topic_id'  				=> array('UINT','0'),
						'user_id'   			=> array('UINT','0'),
						'session_id'	=> array('CHAR:32',''),
					),
					'PRIMARY_KEY' => array('topic_id','user_id','session_id'),
				),
			),
			'add_columns'	=> array(
				$this->table_prefix . 'forums'			=> array(
					'forum_allow_topic_password'				=> array('BOOL',0),
				),
				$this->table_prefix . 'topics'			=> array(
					'topic_password'				=> array('VCHAR',''),
				),
			),
			'cache_purge' => array(
				'template',
				'cache',
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'forums'			=> array(
					'forum_allow_topic_password',
				),
				$this->table_prefix . 'topics'			=> array(
					'topic_password',
				),
			),
			'drop_tables' 		=> array(
				$this->table_prefix . 'topics_access',
			),
			'drop_keys'    => array(
				$this->table_prefix . 'config' => array(
					'topic_password_version'
				)
			),
		);
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this,'hash_passwords'))),
			array('config.add', array('topic_password_version','3.0.0')),
		);
	}

	public function hash_passwords()
	{
		$installedmod = $this->db_tools->sql_column_exists($this->table_prefix . 'forums', 'forum_allow_topic_password');

		if($installedmod == true && !isset($this->config['topic_password_version']))
		{

			global $phpbb_container;

			$passwords_manager = $phpbb_container->get('passwords.manager');

			$sql               = 'SELECT topic_id, topic_password
			FROM ' . TOPICS_TABLE;
			$result            = $this->db->sql_query($sql);

			$newarray          = array();

			while($row = mysqli_fetch_assoc($result))
			{
				if($row['topic_password'])
				{
					$newarray[$row['topic_id']] = $passwords_manager->hash($row['topic_password']);
				}
				else
				{
					$newarray[$row['topic_id']] = '';
				}
			}

			foreach($newarray as $id => $pass)
			{
				if($pass)
				{
					$sql = 'UPDATE ' . TOPICS_TABLE . '
					SET topic_password="'.$pass. '"
					WHERE topic_id = ' . (int) $id;

					$this->db->sql_query($sql);
				}
			}

			$this->db->sql_freeresult($result);

		}
	}
}
