<?php 

class Session_Model extends CI_Model 
{
	private	$sessions_table = 'sessions';

    function __construct()
    {
        parent::__construct();
    }

    public function create($title, $date)
    {
    	$data = array('title' => $title,
    				  'date' => $date);

    	return $this->db
    		 		->insert($this->sessions_table, $data);
    }
}