<?php
class Tags_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	/**
	 * Get tags list.
	 * 
	 * @Author	Ichou
	 * @param	Integer	$term	term_id
	 * @param	Array	$param
	 * @return	Array
	 */
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
		
		foreach ($result as $k => $v) {
			$result[$k]['tag_url'] = site_url("page/tag/$v[tag_id]");
		}
		
		return($result);

	}

	/**
	 * Get tag's name (whith term's information or not).
	 * 
	 * @Author	Ichou
	 * @param	Integer	$value		tag_id
	 * @param	Blooean	$with_term
	 * @return	Array
	 */
	public function get_tag_name($value = FALSE,$with_term = FALSE)
	{
		if($with_term){
			$this->db->select('tag_id,term_id,tag_name,term_name');
			$this->db->from('tags');
			$this->db->where('tag_id',$value);
			$this->db->join('terms','tags.tag_parent=terms.term_id');
			$query = $this->db->get();
			$result = $query->row_array();
			
			$result['term_url'] = site_url("page/term/$result[term_id]");
			
			return $result;
			
		}
		
		$this->db->select('tag_name');
		$query = $this->db->get_where('tags',array('tag_id' => $value));
		$result = $query->row_array();
		return $result;
	}
	
}
	
	
/* End of file tags_model.php */
/* Location: ./application/models/tags_model.php */