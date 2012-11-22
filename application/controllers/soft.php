<?php

class Soft extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('number');
		
		$this->load->model('softs_model');
		$this->load->model('tags_model');
		$this->load->model('terms_model');
	}
	
	public function id($id = FALSE)
	{
		if(! $id) show_404();
		$data['site_url'] = base_url();
		$data['terms'] = $this->terms_model->get_terms(TRUE);
		$data['top20'] = $this->softs_model->get_top_softs(20);
		
		$query = array("where"=>"id = $id");
		$data['soft'] = $this->softs_model->get_soft($query);
		
		$data['soft']['soft_size'] = byte_format($data['soft']['soft_size']);
		$data['soft']['post_time'] = date("Y年m月d日",strtotime($data['soft']['post_time']));
		
		//var_dump($data);
		$this->load->view('header',$data);
		$this->load->view('sider',$data);
		$this->load->view('soft',$data);
		$this->load->view('footer',$data);
	}
	
}

/* End of file soft.php */
/* Location: ./application/controllers/soft.php */