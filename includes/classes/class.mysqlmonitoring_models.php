<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   PHP-Nuke Titanium Database Monitor Models
   ============================================
   Copyright (c) 2021 by The 86it Developers Network

   Filename      : class.mysqlmonitoring_models
   Author        : Ernest Buffington (www.86it.us)
   Version       : 1.0.0
   Date          : 03.26.2021 (mm.dd.yyyy)

   Notes         : Databse Monitoring Model
************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

class Mysqlmonitoring_model extends CI_Model
{
    /**
     * Mysqlmonitoring_model constructor.
     */
    public function __construct()
    {
        parent::__construct(); // construct the Model class
        $this->load->database();
    }

    /**
     * @return mixed
     */
    public function processList()
    {
        return $this->db->query('SHOW PROCESSLIST')->result();
    }

    /**
     * @return mixed
     */
    public function globalStatus()
    {
        return $this->db->query('SHOW GLOBAL STATUS')->result();
    }
}
?>
