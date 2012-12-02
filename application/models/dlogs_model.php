<?php
class Dlogs_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function down($id = FALSE)
	{
		if(! $id) return FALSE;
		
		$data = array(
					"downer_ip"=>$this->input->ip_address(),
					"down_time"=>date('Y-m-d h:i:s'),
					"down_soft"=>$id,
					"downer_bs"=>$this->agent->browser()." ".$this->agent->version(),
					"downer_os"=>$this->agent->platform()
					);
		$this->db->insert('downlog', $data);
		
		$query = "UPDATE `".$this->db->dbprefix('softs')."` as a 
				LEFT JOIN `".$this->db->dbprefix('tags')."` as b ON a.`tag_id`=b.`tag_id` 
				LEFT JOIN `".$this->db->dbprefix('terms')."` as c ON a.`term_id`=c.`term_id` 
				SET a.`down_count` = a.down_count+1,b.`down_count` = b.down_count+1,c.`down_count` = c.down_count+1 
				WHERE `ID` = '".$id."'";
		$this->db->query($query);
		
	}
	
	public function appraise($id=FALSE,$method="like")
	{
		if(! $id) return FALSE;
		
		$method = $method=="like" ? 1 : -1;
		$field_add = $method==1 ? "downer_top_count" : "downer_down_count";
		$field_mus = $field_add=="downer_top_count" ? "downer_down_count" : "downer_top_count";
		
		$this->db->order_by("ID", "desc");
		$this->db->where(array("downer_ip"=>$_SERVER['REMOTE_ADDR'],"down_soft"=>$id));
		$query = $this->db->get('downlog');
		$result = $query->row_array();
		
		switch ($result['soft_appraise']) {
			case NUll :
				return "404";
				break;
			case '0':
				$this->db->update('downlog',array('soft_appraise'=>$method),"ID = $result[ID]");
				$this->_up_into_soft($id,$field_add,"+1");
				break;
			case $method :
				return "repeat";
				break;
			default:
				$this->db->update('downlog',array('soft_appraise'=>$method),"ID = $result[ID]");
				$this->_up_into_soft($id,$field_mus,"-1");
				$this->_up_into_soft($id,$field_add,"+1");
				break;
		}
		return "succeed";
	}
	
	function _up_into_soft($id,$field,$method)
	{
		$this->db->where('ID',$id);
		$this->db->set($field,"$field $method",FALSE);
		$this->db->update('softs');
	}	

}
	
	
/* End of file dlogs_model.php */
/* Location: ./application/models/dlogs_model.php */