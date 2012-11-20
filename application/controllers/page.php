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
		$data['map'] = $this->terms_model->get_term_name($term);
		$this->_get_list("term",$term,$data);
	}

	public function tag($tag = FALSE)
	{
		$data['map'] = $this->tags_model->get_tag_name($tag,TRUE);
		$this->_get_list("tag",$tag,$data);
	}

	function _get_list($method,$param = FALSE,$data = FALSE)
	{
		if(! $param) show_404();
		
		$data['site_url'] = base_url();
		
		$query = array("where"=>$method."_id = $param");
		
		$config['base_url'] = site_url("page/$method/$param");
		$config['total_rows'] = $this->softs_model->get_softs_num($query);
		$this->load->library('pagination');
		$this->pagination->initialize($config); 

		$data['terms'] = $this->terms_model->get_terms(TRUE);
		$data['top20'] = $this->softs_model->get_top_softs(20);
		
		$data['softs'] = $this->softs_model->get_softs(array(
															"where"=>$method."_id = $param",
															"limit"=>$this->pagination->per_page,
															"offset"=>$this->uri->segment(4)
															));
		foreach ($data['softs'] as $k => $v) {
			$data['softs'][$k]['post_time'] = date("Y/m/d",strtotime($v['post_time']));
			$data['softs'][$k]['soft_size'] = byte_format($v['soft_size']);
		}
		
		//var_dump($data);
		$this->load->view('header',$data);
		$this->load->view('sider',$data);
		$this->load->view('page',$data);
		$this->load->view('footer',$data);
	}
	
}


/* End of file page.php */
/* Location: ./application/controllers/page.php */