<?php 

class Comments_model extends CI_Model 
{
	private	$comments_table = 'comments';

    function __construct()
    {
        parent::__construct();
    }

    public function create($user_id, $media_id, $text)
    {
    	$data = array('user_id' => $user_id,
    				  'media_id' => $media_id,
					  'text' => $text);

    	return $this->db
    		 		->insert($this->comments_table, $data);
    }

    

    public function get_comments_from_media_id($media_id)
    {
    	return $this->db
    				->select('comments.text, comments.created_on, users.first_name, users.last_name')
    				->from($this->comments_table)
    				->join('users', 'users.id = comments.user_id')
    				->where('media_id', $media_id)
    				->order_by('comments.created_on', 'asc')
    				->get()
    				->result();
    }

    public function get_num_comments($media_id)
    {
        return $this->db
                    ->select()
                    ->from($this->comments_table)
                    ->where('media_id', $media_id)
                    ->get()
                    ->num_rows();
    }
}