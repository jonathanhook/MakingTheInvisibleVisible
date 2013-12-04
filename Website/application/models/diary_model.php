<?php 

class Diary_model extends CI_Model 
{

	private	$diary_table = 'diary';

    function __construct()
    {
        parent::__construct();
    }

    public function create($name, $user_id, $type, $week)
    {
    	$data = array('name' => $name,
					  'user_id' => $user_id,
					  'type' => $type,
                      'week' => $week
					  );

    	return $this->db
    		 		->insert($this->diary_table, $data);
    }

    public function get_all_for_user($user_id)
    {
    	return $this->db
    				->select()
    				->from($this->diary_table)
    				->where('user_id', $user_id)
    				->get()
    				->result();
    }
}