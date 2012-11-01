<?php
class Softs_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_softs($param = FALSE)
	{
		if($id === FALSE)
		{
			$query = $this->db->get('softs');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('softs',array('id'=>$id));
		return $query->row_array();
	}
}
	
	
/* End of file softs_model.php */
/* Location: ./application/models/softs_model.php */