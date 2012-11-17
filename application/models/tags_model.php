<?php
class Tags_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_tags($term,$param = FALSE)
	{
		if(! is_int($term = (int)$term)) return FALSE;
		
		$this->db->from('tags');
		$this->db->where("tag_parent",$term);
		$param['select'] && $this->db->select($param['select']);
		$param['where'] && $this->db->where($param['where']);
		$param['limit'] && $this->db->limit($param['limit']);
		$param['order'] ? $this->db->order_by($param['order']) : $this->db->order_by("tag_rank");
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return($result);

	}
	
}
	
	
/* End of file tags_model.php */
/* Location: ./application/models/tags_model.php */