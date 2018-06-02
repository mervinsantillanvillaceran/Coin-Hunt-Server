<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model {

	private $per_page = 10;

	public function __construct()
	{
		parent::__construct();
	}

	public function add($data)
	{
		$this->db->insert('feedback', $data);
	}

	public function get_feedbacks($start)
	{
		$this->db->limit($this->per_page, $start);
		$this->db->order_by('id DESC');

		$query = $this->db->get('feedback');

		return $query->result();
	}

	public function get_feedbacks_total_rows()
	{
		$this->db->from('feedback');

		return $this->db->count_all_results();
	}
}

/* End of file  */
/* Location: ./application/models/ */