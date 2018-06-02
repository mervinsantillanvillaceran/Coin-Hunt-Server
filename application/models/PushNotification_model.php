<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PushNotification_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function add($data)
	{
		$this->db->insert('push_notification', $data);
	}

	public function update($device_token, $send_flag)
	{
		$data = array(
			'send_flag' => $send_flag
		);

		$this->db->where('device_token', $device_token);
		$this->db->update('push_notification', $data);
	}

	public function get_by_token($device_token)
	{
		$this->db->where('device_token', $device_token);
		$query = $this->db->get('push_notification');

		return $query->result();
	}
}

/* End of file  */
/* Location: ./application/models/ */