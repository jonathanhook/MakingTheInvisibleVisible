<?php 

class Media_model extends CI_Model {

	private	$media_table = 'media';
    private $type_table = 'content_types';

    function __construct()
    {
        parent::__construct();
    }

    public function create($name, $thumbnail, $user_id, $type)
    {
    	$data = array('name' => $name,
                      'thumbnail' => $thumbnail,  
					  'user_id' => $user_id,
					  'type' => $type);

    	return $this->db
    		 		->insert($this->media_table, $data);
    }

    public function get_all()
    {
    	return $this->db
    				->select('media.*, (SELECT COUNT(*) FROM comments WHERE comments.media_id = media.id) AS num_comments')
    				->from($this->media_table)
    				->get()
    				->result();

    }

    public function get_type_id_from_name($type)
    {
        return $this->db
                    ->select('id')
                    ->from($this->type_table)
                    ->where('name', $type)
                    ->get()
                    ->row();
    }

    public function get_media_from_type($type)
    {
        $result = $this->get_type_id_from_name($type);
        if(!is_array($result))
        {
            $type_id = $result->id;

            return $this->db
                        ->select('media.*, (SELECT COUNT(*) FROM comments WHERE comments.media_id = media.id) AS num_comments')
                        ->from($this->media_table)
                        ->where('type', $type_id)
                        ->order_by('created_on', 'desc')
                        ->get()
                        ->result();
        }
    }

    public function get_media_from_id($id)
    {
        return $this->db
                    ->select()
                    ->from($this->media_table)
                    ->where('id', $id)
                    ->get()
                    ->row();
    }

    // move to type_model
    public function get_type($type_name)
    {
        return $this->db
                    ->select('id')
                    ->from($this->type_table)
                    ->where('name', $type_name)
                    ->get()
                    ->result();
    }
}