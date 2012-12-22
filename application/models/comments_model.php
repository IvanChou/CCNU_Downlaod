<?php
class Comments_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_comments($soft_id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if(! $soft_id) return FALSE;
		
		$this->db->where("soft_id","$soft_id");
		$limit && $this->db->limit($limit);
		$offset && $this->db->limit($limit,$offset);
		$query = $this->db->get("comments");
		$result = $query->result_array();
		
		return($result);

	}
	
	public function add_comment($request=array())
	{
		$data = array(
					"user_num"=>"2009213663",
					"user_name"=>$request['name'],
					"com_text"=>$request['content'],
					"soft_id"=>$request['soft-id'],
					"com_time"=>date('Y-m-d h:i:s')
					);
		//var_dump($data);
		$this->db->insert('comments', $data); 
		
		return TRUE;
	}
	
}
	
	
/* End of file comments_model.php */
/* Location: ./application/models/comments_model.php */