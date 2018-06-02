<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model','user');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function login_user()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = $this->user->login_credentials($username, $password);

		if($data){
			$this->session->set_userdata('username', $username);
			redirect('index.php/news/view');
		}
		else{
			redirect('index.php/user/login');
		}
	}

	public function logout()
	{		
		$this->session->sess_destroy();
		redirect('index.php/user/login');
	}
}
