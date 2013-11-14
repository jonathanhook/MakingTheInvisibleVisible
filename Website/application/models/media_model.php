<?php 

class Media_model extends CI_Model {

	private	$media_table = 'media';
    private $type_table = 'content_types';

    function __construct()
    {
        parent::__construct();
    }

    public function create($name, $user_id, $type)
    {
    	$data = array('name' => $name,
					  'user_id' => $user_id,
					  'type' => $type
					  );

    	return $this->db
    		 		->insert($this->media_table, $data);
    }

    public function get_all()
    {
    	return $this->db
    				->select()
    				->from($this->media_table)
    				->get()
    				->result();

    }

    public function get_videos()
    {
        return $this->db
                    ->select()
                    ->from($this->media_table)
                    ->where('type', 1)
                    ->get()
                    ->result();
    }

    public function get_images()
    {
        return $this->db
                    ->select()
                    ->from($this->media_table)
                    ->where('type', 2)
                    ->get()
                    ->result();
    }

    public function get_audio()
    {
        return $this->db
                    ->select()
                    ->from($this->media_table)
                    ->where('type', 3)
                    ->get()
                    ->result();
    }

    public function get_type($type)
    {
        return $this->db
                    ->select()
                    ->from($this->type_table)
                    ->where('name', $type)
                    ->get()
                    ->row();
    }
}