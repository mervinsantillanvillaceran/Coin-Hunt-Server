<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
		$this->load->model('News_model','news');
	}

	public function index()
	{
		redirect('index.php/user/login');
	}

	public function get_all_trending($page)
	{
		echo json_encode($this->news->get_all_trending($page));
	}

	public function get_all_new($page)
	{
		echo json_encode($this->news->get_all_new($page));
	}

	public function get_all_ico($page)
	{
		echo json_encode($this->news->get_all_ico($page));
	}

	public function get_all_airdrop($page)
	{
		echo json_encode($this->news->get_all_airdrop($page));
	}

	public function get_related_news($id, $tag)
	{
		echo json_encode($this->news->get_related_news($id, $tag));
	}

	public function get_by_id($id)
	{
		echo json_encode($this->news->get_by_id($id));	
	}

	public function view()
	{
		if($this->session->userdata('username')){
			$this->load->view('news');
		}
		else{
			redirect('index.php/user/login');
		}
	}

	public function get_news()
	{
       	$cur_page = $this->input->post('page');

       	$total_rows = $this->news->get_news_total_rows();
       	$start = empty($cur_page)? 0 : ($cur_page - 1) * 10;

       	$data = array(
       		'list' => $this->news->get_news($start),
       		'pagination' => $this->createPagination($total_rows, 10, $cur_page)
       	);

       	echo json_encode($data);
	}

	private function createPagination($rows, $per_page, $cur_page){
		$this->load->library('pagination');

		$config['per_page'] = $per_page;
       	$config['total_rows'] = $rows;
        $config['cur_page'] = $cur_page;

       	$this->pagination->initialize($config);
       	return $this->pagination->create_links();
	}

	public function add()
	{
		if($this->session->userdata('username')){
			$this->load->view('add_news');
		}
		else{
			redirect('index.php/user/login');
		}
	}

	public function edit($id)
	{
		if($this->session->userdata('username')){
			$data['news'] = $this->news->get_by_id($id)[0];
			$this->load->view('edit_news', $data);
		}
		else{
			redirect('index.php/user/login');
		}
	}

	public function add_details()
	{
		if($this->session->userdata('username')){
			$data = array();

			$config['upload_path'] = realpath(APPPATH.'../asset/uploads');
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['max_size'] = 5024;
			$config['encrypt_name'] = true;  

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
			} 
			else {
				$fileData = $this->upload->data();
				$data['banner'] = $fileData['file_name'];
			}

			$data['title'] = $this->input->post('title');
			$data['source'] = $this->input->post('source');
			$data['source_link'] = $this->input->post('source_link');
			$data['body'] = $this->input->post('body');
			$data['trending'] = $this->input->post('trending');
			$data['is_ico'] = $this->input->post('ico');
			$data['is_airdrop'] = $this->input->post('airdrop');
			$data['created_date'] = date("M d, Y h:i A");
			$data['tags'] = $this->input->post('tags');
			$data['status'] = 'active';

			$id = $this->news->add($data);
			$this->sendMessage($id);
			redirect('index.php/news/view');
		}
		else{
			redirect('index.php/user/login');
		}			
	}

	public function edit_details($id)
	{
		if($this->session->userdata('username')){
			$data = array();

			$config['upload_path'] = realpath(APPPATH.'../asset/uploads');
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['max_size'] = 1000000;
			$config['encrypt_name'] = true;  

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
			} 
			else {
				$fileData = $this->upload->data();
				$data['banner'] = $fileData['file_name'];
			}

			$data['title'] = $this->input->post('title');
			$data['source'] = $this->input->post('source');
			$data['source_link'] = $this->input->post('source_link');
			$data['body'] = $this->input->post('body');
			$data['trending'] = $this->input->post('trending');
			$data['is_ico'] = $this->input->post('ico');
			$data['is_airdrop'] = $this->input->post('airdrop');
			$data['tags'] = $this->input->post('tags');
			$data['status'] = 'active';
			
			$this->news->edit($id, $data);
			redirect('index.php/news/view');
		}
		else{
			redirect('index.php/user/login');
		}			
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->news->delete($id);
		echo json_encode(array('success' => true));
	}

	private function sendMessage($id){
		$data = $this->news->get_by_id($id)[0];
		$category = "";

		if($data->is_ico == 1){
			$category = "ICO : ";
		}
		else if($data->is_airdrop == 1){
			$category = "Airdrop/Bounty : ";
		}
		else if($data->trending == 1){
			$category = "Trending : ";
		}
		else{
			$category = "New : ";
		}

	    $content = array(
	        "en" => $category.$data->title
	        );

	    $fields = array(
	        'app_id' => "7ed9b11e-b388-4811-bc06-00a0d0e68ab3",
	        'included_segments' => array('All'),
	        'data' => array("news_id" => $id),
	        'large_icon' =>"ic_launcher_round.png",
	        'contents' => $content
	    );

	    $fields = json_encode($fields);
		print("\nJSON sent:\n");
		print($fields);

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
	                                               'Authorization: Basic M2Q1NzllMTctMzk4OS00NTg3LWJmYjktMDMzY2QxYWU3NzFm'));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

	    $response = curl_exec($ch);
	    curl_close($ch);

	    return $response;
	}
}
