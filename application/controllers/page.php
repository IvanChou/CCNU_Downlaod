<?php 

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('number');
		
		$this->load->model('softs_model');
		$this->load->model('tags_model');
		$this->load->model('terms_model');
	}

	public function term($term = FALSE)
	{
		if(! $term) show_404();
		
		$data['site_url'] = base_url();
		
		$query = array("where"=>"term_id = $term");
		
		$config['base_url'] = site_url("page/term/$term");
		$config['total_rows'] = $this->softs_model->get_softs_num($query);
		$this->load->library('pagination');

		$this->pagination->initialize($config); 
		
		$side['terms'] = $this->terms_model->get_terms(TRUE);
		$side['top20'] = $this->softs_model->get_top_softs(20);
		
		$data['softs'] = $this->softs_model->get_softs(array(
															"where"=>"term_id = $term",
															"limit"=>$config['per_page'],
															"offset"=>$this->uri->segment(4)
															));
		
		foreach ($data['softs'] as $k => $v) {
			$data['softs'][$k]['post_time'] = date("Y/m/d",strtotime($v['post_time']));
			$data['softs'][$k]['soft_size'] = byte_format($v['soft_size']);
		}
		
		//var_dump($data);
		$this->load->view('header',$data);
		$this->load->view('sider',$side);
		$this->load->view('page',$data);
		$this->load->view('footer');
	}
	
}


/* End of file home.php */
/* Location: ./application/controllers/home.php */