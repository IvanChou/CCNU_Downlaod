<?php
class Tags_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_tags_hot($num = 5)
	{
		$this->db->order_by('down_count','random');
		$this->db->select('tag_id,tag_name,down_count');
		
		$query = $this->db->get('tags');
		$result = $query->result_array();
		
		foreach($result as $k=>$v){
			$result[$k]['url'] = site_url("tag/".$v['tag_id']);
			switch ((int)($v['down_count']/$num)){
				case 1:
					$result[$k]['class'] = 'hot';break;
				case 2:
					$result[$k]['class'] = 'hotter';break;
				case 3:
					$result[$k]['class'] = 'very_hot';break;
				case 4:
					$result[$k]['class'] = 'super_hot';break;
				default:
					$result[$k]['class'] = 'normal';
			}
		}
		
		return ($result);
	}
	
}
	
	
/* End of file tags_model.php */
/* Location: ./application/models/tags_model.php */