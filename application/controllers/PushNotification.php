<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PushNotification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
		$this->load->model('PushNotification_model','notification');
	}

	public function add()
	{	
		$device_token = $this->input->post('device_token');
		$send_flag = $this->input->post('send_flag');

		$data = $this->notification->get_by_token($device_token);

		if($data){
			$this->notification->update($device_token, $send_flag);
		}
		else{
			$this->notification->add($this->input->post());
		}
		echo json_encode(array('success' => true));
	}
}
