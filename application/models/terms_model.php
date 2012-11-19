<?php
class Terms_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
		$this->load->model('tags_model');
	}
	
	/**
	 * Get terms (with child tags)
	 * 
	 * @Author	Ichou	(2012.11.17)
	 * @param	Boolean	$withTags
	 * @return	Array
	 */
	public function get_terms($withTags = FALSE)
	{		
		$this->db->from('terms');
		$param['select'] && $this->db->select($param['select']);
		$param['where'] && $this->db->where($param['where']);
		$param['limit'] && $this->db->limit($param['limit']);
		$param['order'] ? $this->db->order_by($param['order']) : $this->db->order_by("term_rank");
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach ($result as $k => $v) {
			$result[$k]['term_url'] = site_url("page/term/$v[term_id]");
		}
		
		if($withTags === TRUE){
			foreach($result as $k=>$v){
				$result[$k]['tags'] = $this->tags_model->get_tags($v[term_id]);
			}
		}
		
		return($result);
	}
	
	public function get_term_name($value = FALSE)
	{
		$this->db->select('term_id,term_name');
		$query = $this->db->get_where('terms',array('term_id' => $value));
		$result = $query->row_array();
		return $result;
	}
	
}
	
	
/* End of file terms_model.php */
/* Location: ./application/models/terms_model.php */