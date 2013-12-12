<?php 

class User_model extends CI_Model {

	private	$user_table = 'users';


    function __construct()
    {
        parent::__construct();
    }

    public function get_all_users()
    {
    	return $this->db
    				->select()
    				->from($this->user_table)
    				->get()
    				->result();
    }

    public function get_all_users_id_and_name()
    {
        return $this->db
                    ->select('id, first_name')
                    ->from($this->user_table)
                    ->get()
                    ->result();
    }


    public function get_all_user_names()
    {
    	return $this->db
    				->select('username')
    				->from($this->user_table)
    				->get()
    				->result();
    }


    public function get_all_user_ids_and_names()
    {
    	return $this->db
    				->select('id, username')
    				->from($this->user_table)
    				->get()
    				->result();
    }
}