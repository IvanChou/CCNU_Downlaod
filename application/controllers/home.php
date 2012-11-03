<?php 

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		
		$this->load->model('softs_model');
		$this->load->model('tags_model');
	}

	public function index()
	{
		$data['site_url'] = base_url();
		
		$query = array(//本周下载排汗
										'select'=>'soft_name,down_count,soft_url',
										'limit'	=>'10',
										'where'	=>'post_time > "'.date('Y-m-d',strtotime('last monday')).'"',
										'order'	=>'down_count desc'
									);
		$data['weekly'] = $this->softs_model->get_softs($query);
		
		$query = array(//下载总排行
										'select'=>'soft_name,soft_url',
										'limit'	=>'10',
										'order'	=>'down_count desc'
									);
		$data['total'] = $this->softs_model->get_softs($query);
		
		$query = array(//下载总排行
										'select'=>'soft_name,soft_url',
										'limit'	=>'10',
										'order'	=>'down_count desc'
									);
		$data['total'] = $this->softs_model->get_softs($query);
		
		$data['hotag'] = $this->tags_model->get_tags_hot();
		
		//var_dump($data);
		$this->load->view('home',$data);
	}
	
}


/* End of file home.php */
/* Location: ./application/controllers/home.php */