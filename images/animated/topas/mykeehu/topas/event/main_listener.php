<?php
/**
*
* Topic Password. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017, Mykee
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace mykeehu\topas\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Topic Password Event listener.
*/
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;
	
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;
	
	/** @var \phpbb\db\driver\driver_interface */
	protected $passwords_manager;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string phpEx */
	protected $request;
	
	/** @var string */
	protected $topics_access_table;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper	$helper		Controller helper object
	* @param \phpbb\template\template	$template	Template object
	* @param \phpbb\user               $user       User object
	* @param string                    $php_ext    phpEx
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\passwords\manager $passwords_manager, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, $php_ext, \phpbb\request\request $request, $topics_access_table)
	{
		$this->auth = $auth;
		$this->db = $db;
		$this->passwords_manager = $passwords_manager;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->php_ext = $php_ext;
		$this->request = $request;
		$this->topics_access_table = $topics_access_table;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'                       => 'user_setup',
			'core.modify_posting_auth'              => 'modify_posting_auth',
			'core.posting_modify_message_text'      => 'posting_modify_message_text',
			'core.posting_modify_submit_post_before'=> 'posting_modify_submit_post_before',
			'core.posting_modify_template_vars'     => 'posting_modify_template_vars',
			'core.viewforum_modify_topicrow'        => 'viewforum_modify_topicrow',
			'core.viewtopic_before_f_read_check'    => 'viewtopic_before_f_read_check',
			'core.submit_post_modify_sql_data'      => 'submit_post_modify_sql_data',
			'core.search_get_posts_data'            => 'search_get_posts_data',
			'core.feed_base_modify_item_sql'        => 'feed_base_modify_item_sql',
			'core.acp_manage_forums_request_data'   => 'acp_manage_forums_request_data',
			'core.acp_manage_forums_initialise_data'=> 'acp_manage_forums_initialise_data',
			'core.acp_manage_forums_display_form'   => 'acp_manage_forums_display_form',
		);
	}

	/**
	* Load common language files during user setup
	*
	* @param \phpbb\event\data	$event	Event object
	*/
	public function user_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name'=> 'mykeehu/topas',
			'lang_set'=> 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}


	// ---------------------
	// posting.php
	public function modify_posting_auth($event)
	{
		$mode      = $event['mode'];
		$post_data = $event['post_data'];
		$auth      = $event['is_authed'];
		$topic_id  = $event['topic_id'];
		$forum_id  = $event['forum_id'];
		if($mode == 'edit' && $post_data['topic_password'] && (!$this->auth->acl_get('a_') && !$this->auth->acl_get('m_', $forum_id) && !$this->auth->acl_get('m_'))){
			login_topic_box(array(
					'topic_id'      => $topic_id,
					'topic_password'=> $post_data['topic_password'],
				));

		}
	}
	public function posting_modify_message_text($event)
	{
		global $phpbb_container;

		$post_data = $event['post_data'];
		$getpass   = $post_data['topic_password'];
		$newpass   = $this->request->variable('topic_password', '', true);
/*		$passwords_manager = $phpbb_container->get('passwords.manager');*/

		if($getpass === $newpass || $newpass == ''){
			$post_data['topic_password'] = $newpass;
		}
		else
		{
			$post_data['topic_password'] = $this->passwords_manager->hash($newpass);
		}

		$event['post_data'] = $post_data;
	}

	public function posting_modify_submit_post_before($event)
	{
		$post_data = $event['post_data'];
		$data      = $event['data'];

		$data['topic_password'] = $post_data['topic_password'];
		$event['data'] = $data;
	}

	public function posting_modify_template_vars($event)
	{
		$page_data       = $event['page_data'];
		$post_data       = $event['post_data'];
		$post_id         = $event['post_id'];
		$mode            = $event['mode'];
		$page_data_addon = array(
			'S_ALLOW_PASSWORD'   => ( ($mode == 'post' && $post_data['forum_allow_topic_password']) || ($mode == 'edit' && $post_id == $post_data['topic_first_post_id'] && ($post_data['forum_allow_topic_password'] || $post_data['topic_password'])) ) ? true : false,
			'EDIT_TOPIC_PASSWORD'=> (!empty($post_data['topic_password'])) ? $post_data['topic_password'] : '',
		);
		$event['page_data'] = $page_data + $page_data_addon;
	}

	// ---------------------
	// viewforum.php
	public function viewforum_modify_topicrow($event)
	{
		$topic_row = $event['topic_row'];
		$row       = $event['row'];
		$topic_row['S_PASSWORDED_TOPIC'] = (!empty($row['topic_password'])) ? true : false;
		$event['topic_row'] = $topic_row;
	}

	// ---------------------
	// viewtopic.php
	public function viewtopic_before_f_read_check($event)
	{
		$topic_data = $event['topic_data'];
		if($topic_data['topic_password'] && (!$this->auth->acl_get('a_') && !$this->auth->acl_get('m_', $forum_id) && !$this->auth->acl_get('m_'))){
			$this->login_topic_box($topic_data);
		}
	}

	// ---------------------
	// functions_posting.php
	public function submit_post_modify_sql_data($event)
	{

		$post_mode = $event['post_mode'];

		if($post_mode == 'post' || $post_mode == 'edit_topic' || $post_mode == 'edit_first_post'){
			$post_data = $event['data'];
			$where     = $event['sql_data'];

			$sql_addon = array(
				'topic_password'=> $post_data['topic_password'],
			);
			$where[TOPICS_TABLE]['sql'] = $where[TOPICS_TABLE]['sql'] + $sql_addon;
			$event['sql_data'] = $where;
		}
	}

	// ---------------------
	// search.php
	public function search_get_posts_data($event)
	{
		$where = $event['sql_array'];
		$where['WHERE'] = $where['WHERE']. " AND t.topic_password = ''";
		$event['sql_array'] = $where;
	}

	// ---------------------
	// 	phpbb / feed / base.php
	public function feed_base_modify_item_sql($event)
	{
		$where = $event['sql_ary'];
		$where['LEFT_JOIN'][] = array('FROM' => array(TOPICS_TABLE=> 't'),'ON'  => 't.topic_id = p.topic_id ');
		$where['WHERE'] = $where['WHERE']." AND t.topic_password = ''";
		$event['sql_ary'] = $where;
	}

	// ---------------------
	// acp_forums.php
	public function acp_manage_forums_request_data($event)
	{
		$forum_data = $event['forum_data'];
		$forum_data['forum_allow_topic_password'] = $this->request->variable('forum_allow_topic_password', false);
		$event['forum_data'] = $forum_data;
	}

	public function acp_manage_forums_initialise_data($event)
	{
		$forum_data = $event['forum_data'];
		$forum_data['forum_allow_topic_password'] = false;
		$event['forum_data'] = $forum_data;
	}

	public function acp_manage_forums_display_form($event)
	{

		$template_data = $event['template_data'];
		$row           = $event['row'];
		$template_data['HAS_TOPIC_PASSWORD'] = false;

		if($row)
		{
			$sql    = 'SELECT MAX(topic_password) as tp
			FROM ' . TOPICS_TABLE . '
			WHERE forum_id = ' . $row['forum_id'];

			$result = $this->db->sql_query($sql);
			$trow   = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			$template_data['HAS_TOPIC_PASSWORD'] = ($trow['tp']) ? true : false;
		}
		
		$template_data['S_FORUM_ALLOW_TOPIC_PASSWORD'] = ($row['forum_allow_topic_password']) ? true : false;

		$event['template_data'] = $template_data;
	}

	// ---------------------
	// Addons
	private function login_topic_box($topic_data)
	{

		$password = $this->request->variable('password', '', true);

		$sql    = 'SELECT topic_id
		FROM ' . $this->topics_access_table . '
		WHERE topic_id = ' . $topic_data['topic_id'] . '
		AND user_id = ' . $this->user->data['user_id'] . "
		AND session_id = '" . $this->db->sql_escape($this->user->session_id) . "'";
		$result = $this->db->sql_query($sql);
		$row    = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if($row){
			return true;
		}

		if($password){
			// Remove expired authorised sessions
			$sql    = 'SELECT t.session_id
			FROM ' . $this->topics_access_table . ' t
			LEFT JOIN ' . SESSIONS_TABLE . ' s ON (t.session_id = s.session_id)
			WHERE s.session_id IS NULL';
			$result = $this->db->sql_query($sql);

			if($row = $this->db->sql_fetchrow($result)){
				$sql_in = array();
				do
				{
					$sql_in[] = (string) $row['session_id'];
				}
				while($row = $this->db->sql_fetchrow($result));

				// Remove expired sessions
				$sql = 'DELETE FROM ' . $this->topics_access_table . '
				WHERE ' . $this->db->sql_in_set('session_id', $sql_in);
				$this->db->sql_query($sql);
			}
			$this->db->sql_freeresult($result);

			/*$passwords_manager = $phpbb_container->get('passwords.manager');*/

			if($this->passwords_manager->check($password, $topic_data['topic_password']) || $password == $topic_data['topic_password'])
			{
				$sql_ary = array(
					'topic_id'  => (int) $topic_data['topic_id'],
					'user_id'   => (int) $this->user->data['user_id'],
					'session_id'=> (string) $this->user->session_id,
				);

				$this->db->sql_query('INSERT INTO ' . $this->topics_access_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary));

				return true;
			}

			$this->template->assign_var('LOGIN_ERROR', $this->user->lang['WRONG_PASSWORD']);
		}
		
		/* page_header before template vars - important! */
		page_header($this->user->lang['LOGIN']);
		
		$this->template->assign_vars(array(
				'FORUM_NAME'     => $topic_data['forum_name'],
				'TOPIC_TITLE'    => $topic_data['topic_title'],
				'S_LOGIN_ACTION' => build_url(array('t')),
				'S_HIDDEN_FIELDS'=> build_hidden_fields(array('t' => $topic_data['topic_id'])),
			));
		
		$this->template->set_filenames(array(
				'body'=> '@mykeehu_topas/login_topic.html',
			));

		page_footer();
	}
}
