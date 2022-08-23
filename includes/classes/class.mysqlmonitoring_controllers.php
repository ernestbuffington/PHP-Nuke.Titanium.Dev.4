<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   PHP-Nuke Titanium Database Monitor Controllers
   ============================================
   Copyright (c) 2021 by The 86it Developers Network

   Filename      : class.mysqlmonitoring_controllers.php
   Author        : Ernest Buffington (www.86it.us)
   Version       : 1.0.0
   Date          : 03.26.2021 (mm.dd.yyyy)

   Notes         : Databse Monitoring Model
************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/**
 * Class Mysqlmonitoring
 *
 * Get data from database
 * Display data in graph with refresh interval
 */
class Mysqlmonitoring extends CI_Controller
{
    public function index()
    {
        // Settings options
        // Fill the params array

        $data['params']['slowqueries'] = 1; // Query longer than 1 seconds
        $data['params']['refreshtime'] = 1000; // Refresh graph in 3 seconds
        $data['params']['receivedsentcolumns'] = 10; // Columns in table received/sent bytes
        $data['params']['connectionsgraphcolumns'] = 10; // Columns in graph received/sent bytes
        $data['params']['connectionscolumns'] = 10; // Columns in table connections/process bytes
        $data['params']['receivedsentgraphcolumns'] = 10; // Columns in graph connections/process bytes

        $this->load->view('mysqlmonitoring', $data);
    }

    public function getData()
    {

        // Path to your model
        $this->load->model('Mysqlmonitoring_model', 'mysqlmonitoring');

        /* Get all actual process with time over $config['slowq'] seconds */
        foreach ($this->mysqlmonitoring->processList() as $process) {
            if ($process->Time > $this->input->post('slowqueries') and $process->Command != 'Sleep') $data['slow'][] = $process;
        }

        foreach ($this->mysqlmonitoring->globalStatus() as $global) {
            if (isset($global->Variable_name)) $status[$global->Variable_name] = $global->Value;
        }

        $data['bytesSent'] = $status['Bytes_sent'];
        $data['bytesReceived'] = $status['Bytes_received'];
        $data['Connections'] = $status['Connections'];
        $data['process'] = count($this->mysqlmonitoring->processList());
        $data['Com_insert'] = $status['Com_insert'];
        $data['Com_update'] = $status['Com_update'];
        $data['Com_delete'] = $status['Com_delete'];
        $data['Com_select'] = $status['Com_select'];

        /* Return JSON to $.ajax */
        /* Array */
        echo json_encode($data);
    }
}