<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {

	private $news_per_page = 10;

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_trending($page)
	{
		$this->db->select('id, banner, title, source, source_link, created_date, views, tags');
		$this->db->where('is_ico', 0);
		$this->db->where('is_airdrop', 0);
		$this->db->where('trending', 1);
		$this->db->where('status', 'active');
       	$this->db->limit($this->news_per_page, ($page - 1) * $this->news_per_page);
		$this->db->order_by('id DESC');
		$query = $this->db->get('news');

		return $query->result();
	}

	public function get_all_new($page)
	{
		$this->db->select('id, banner, title, source, source_link, created_date, views, tags');
		$this->db->where('is_ico', 0);
		$this->db->where('is_airdrop', 0);
		$this->db->where('status', 'active');
       	$this->db->limit($this->news_per_page, ($page - 1) * $this->news_per_page);
		$this->db->order_by('id DESC');
		$query = $this->db->get('news');

		return $query->result();
	}

	public function get_all_ico($page)
	{
		$this->db->select('id, banner, title, source, source_link, created_date, views, tags');
		$this->db->where('is_ico', 1);
		$this->db->where('status', 'active');
       	$this->db->limit($this->news_per_page, ($page - 1) * $this->news_per_page);
		$this->db->order_by('id DESC');
		$query = $this->db->get('news');

		return $query->result();
	}

	public function get_all_airdrop($page)
	{
		$this->db->select('id, banner, title, source, source_link, created_date, views, tags');
		$this->db->where('is_airdrop', 1);
		$this->db->where('status', 'active');
       	$this->db->limit($this->news_per_page, ($page - 1) * $this->news_per_page);
		$this->db->order_by('id DESC');
		$query = $this->db->get('news');

		return $query->result();
	}

	public function get_related_news($id, $tag)
	{
		$this->db->select('id, banner, title, source, source_link, created_date, views, tags');
		$this->db->from('news');
		$this->db->where('id !=', $id);
		$this->db->where('status', 'active');
		$this->db->like('tags', $tag);
       	$this->db->limit(6, 0);
		$this->db->order_by('created_date DESC');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->where('status', 'active');
		$query =$this->db->get('news');

		return $query->result();
	}

	public function add($data)
	{
		$this->db->insert('news', $data);
		$id = $this->db->insert_id();
		return $id;
	}

	public function edit($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('news', $data);
	}

	public function get_news($start)
	{
		$this->db->where('status', 'active');
		$this->db->limit($this->news_per_page, $start);
		$this->db->order_by('id DESC');

		$query = $this->db->get('news');

		return $query->result();
	}

	public function get_news_total_rows()
	{
		$this->db->from('news');
		$this->db->where('status', 'active');

		return $this->db->count_all_results();
	}

	public function delete($id)
	{
		$data = array(
			'status' => 'deleted'
		);

		$this->db->where('id', $id);
		$this->db->update('news', $data);
	}
}

/* End of file  */
/* Location: ./application/models/ */