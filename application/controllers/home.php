<?php 

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		
		$this->load->model('softs_model');
		$this->load->model('tags_model');
		$this->load->model('terms_model');
		$this->load->model('home_model');
		
		$this->load->helper('number');
	}

	public function index()
	{
		$data['site_url'] = base_url();
		
		$side['terms'] = $this->terms_model->get_terms(TRUE);
		$side['top20'] = $this->softs_model->get_top_softs(20);

		$data_need = array_combine(array('need_title','need'),$this->home_model->get_need());
		$data = array_merge($data,$data_need);
		$data['notice'] = $this->home_model->get_notice();
		$data['often']	= $this->home_model->get_often();
		
		$data['theNew'] = $this->softs_model->get_softs(array("limit"=>"8"));
		
		//var_dump($data);
		$this->load->view('header',$data);
		$this->load->view('sider',$side);
		$this->load->view('home',$data);
		$this->load->view('footer',$data);
	}
	
}


/* End of file home.php */
/* Location: ./application/controllers/home.php */