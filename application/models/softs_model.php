<?php
class Softs_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	/**
	 * Get Softs
	 * 
	 * @Author	Ichou	(2012.11.01)
	 * @param	Array	$param
	 * @return	Array
	 */
	public function get_softs($param = FALSE)
	{	
		$this->_set_sql($param);
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach($result as $k=>$v){
			$v['ID'] && $result[$k]['soft_page'] = site_url("soft/show/$v[ID]");
			$v['soft_img'] && $result[$k]['soft_img'] = base_url().$v['soft_img'];
			$v['soft_description'] && $result[$k]['soft_description'] = strip_tags($v['soft_description']);
			$v['soft_size'] && $result[$k]['soft_size'] = byte_format($v['soft_size']);
			$v['post_time'] && $result[$k]['post_time'] = date("Y/m/d",strtotime($v['post_time']));
		}
		
		return($result);

	}
	
	/**
	 * Get the number of softs under some limits.
	 * 
	 * @Author	Ichou
	 * @param	Array $param
	 * @return	Integer
	 */
	public function get_softs_num($param = FALSE)
	{
		$this->_set_sql($param);
		$query = $this->db->get();
		$result = $query->num_rows();
		return($result);
	}
	
	/**
	 * Get Top Softs by down_counts
	 * 
	 * @Author	Ichou	(2012.11.17)
	 * @param	integer	$num
	 * @param	integer	$tag	tag_id
	 * @return	Array
	 */
	public function get_top_softs($num = FALSE,$tag = FALSE)
	{
		if(! $num) return FALSE;
		
		$query = array(
						'select'=>'soft_name,ID',
						'limit'	=>$num,
						'order'	=>'down_count desc'
						);
		$tag && $query['where'] = 'tag_id ='.$tag;
		
		return $this->get_softs($query);
	}
	
	/**
	 * Get a soft by id or more limits.
	 * 
	 * @Author	Ichou	(2012.11.01)
	 * @param	Mixed	$param
	 * @return	Array
	 */
	public function get_soft($param = FALSE)
	{
		if(! $param) return FALSE;
		
		if(! is_array($param)){
			$param = (int)$param;
			$param && $param = array("where"=>"id = $param");
		}
		
		$this->_set_sql($param);
		$param['select'] || $this->db->select('softs.*,tag_name,term_name');
		$this->db->join('tags','softs.tag_id=tags.tag_id');
		$this->db->join('terms','softs.term_id=terms.term_id');
		
		$query = $this->db->get();
		$result = $query->row_array();
		
		$result['ID'] && $result['soft_down'] = site_url("soft/down/$result[ID]");
		$result['soft_img'] && $result['soft_img'] = base_url().$result['soft_img'];
		$result['soft_size'] && $result['soft_size'] = byte_format($result['soft_size']);
		$result['post_time'] = date("Y年m月d日",strtotime($result['post_time']));
		$result['term_id'] && $result['term_url'] = site_url("page/term/$result[term_id]");
		$result['tag_id'] && $result['tag_url'] = site_url("page/tag/$result[tag_id]");
		
		return $result;
	}
	
	/**
	 * Format and rebulid the sql limits.
	 * 
	 * @Author	Ichou
	 * @param	Array	$param
	 */
	function _set_sql($param = array())
	{	
		$this->db->from('softs');
		$param['select'] && $this->db->select($param['select']);
		$param['where'] && $this->db->where($param['where']);
		$param['where_ids'] && $this->db->where_in('ID',$param['where_in']);
		$param['like'] && $this->db->where("`soft_name` LIKE '%$param[like]%' OR `soft_description` LIKE '%$param[like]%' ORDER BY case when `soft_name` LIKE '%$param[like]%' then 1 else 0 end desc,`ID` desc",NULL,FALSE);
		$param['limit'] && $this->db->limit($param['limit']);
		$param['offset'] && $this->db->limit($param['limit'],$param['offset']);
		if($param['order']){
			$param['like'] || $this->db->order_by($param['order']);
		}else{
			$param['like'] || $this->db->order_by('ID','desc');
		}
	}
}
	
	
/* End of file softs_model.php */
/* Location: ./application/models/softs_model.php */