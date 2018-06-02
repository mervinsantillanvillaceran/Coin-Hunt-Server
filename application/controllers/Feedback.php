<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
		$this->load->model('Feedback_model','feedback');
	}

	public function add()
	{	
		$this->feedback->add($this->input->post());
		echo json_encode(array('success' => true));
	}

	public function view()
	{
		if($this->session->userdata('username')){
			$this->load->view('feedback');
		}
		else{
			redirect('index.php/user/login');
		}
	}

	public function get_feedbacks()
	{
       	$cur_page = $this->input->post('page');

       	$total_rows = $this->feedback->get_feedbacks_total_rows();
       	$start = empty($cur_page)? 0 : ($cur_page - 1) * 10;

       	$data = array(
       		'list' => $this->feedback->get_feedbacks($start),
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
}
