<?php
class Softs_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_softs($param = FALSE)
	{
		if($param === FALSE)
		{
			$query = $this->db->get('softs');
			return $query->result_array();
		}
		
		$this->db->from('softs');
		$param['select'] && $this->db->select($param['select']);
		$param['where'] && $this->db->where($param['where']);
		$param['limit'] && $this->db->limit($param['limit']);
		$param['order'] && $this->db->order_by($param['order']);
		
		$query = $this->db->get();
		return $query->result_array();
	}
}
	
	
/* End of file softs_model.php */
/* Location: ./application/models/softs_model.php */