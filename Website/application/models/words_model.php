<?php 

class Words_Model extends CI_Model 
{
	private	$words_table = 'words';

    function __construct()
    {
        parent::__construct();
    }

    public function create($user_id, $title, $text)
    {
    	$data = array('user_id' => $user_id,
					  'title' => $title,
                      'text' => $text);

    	return $this->db
    		 		->insert($this->words_table, $data);
    }

    public function update($id, $title, $text)
    {
        $data = array('title' => $title,
                      'text' => $text);

        return $this->db
                    ->where('id', $id)
                    ->update($this->words_table, $data);
    }

    public function get($id)
    {
        return $this->db
                    ->select('words.id, words.title, words.text, users.first_name, users.last_name')
                    ->from($this->words_table)
                    ->join('users', 'users.id = words.user_id')
                    ->where('words.id', $id)
                    ->get()
                    ->row();
    }

    public function get_all_words_from_user($user_id)
    {
        return $this->db
                    ->select('words.id, words.title, words.text, users.first_name, users.last_name')
                    ->from($this->words_table)
                    ->join('users', 'users.id = words.user_id')
                    ->where('user_id', $user_id)
                    ->get()
                    ->result();
    }

        public function get_all_words_from_other_users($user_id)
    {
        return $this->db
                    ->select('words.id, words.title, words.text, users.first_name, users.last_name')
                    ->from($this->words_table)
                    ->join('users', 'users.id = words.user_id')
                    ->where('user_id !=', $user_id)
                    ->get()
                    ->result();
    }

    public function get_from_user_and_title($user_id, $title)
    {
        return $this->db
                    ->select()
                    ->from($this->words_table)
                    ->where('title', $title)
                    ->where('user_id', $user_id)
                    ->get()
                    ->row();
    }

    public function title_and_user_exists($user_id, $title)
    {
        $result = $this->db
                       ->select('COUNT(1)')
                       ->from($this->words_table)
                       ->where('title', $title)
                       ->where('user_id', $user_id)
                       ->count_all_results();

        return $result > 0;
    }
}
