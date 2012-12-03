<?php 

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('number');
		
		$this->load->model('softs_model');
		$this->load->model('tags_model');
		$this->load->model('terms_model');
		
		$this->load->library('pagination');
	}

	public function index($str = FALSE)
	{		
		if(! $str) show_404();
		
		$str = trim($str);
		$data['map']['term_name'] = "关于 $str 的搜索结果";
		
		$data['site_url'] = base_url();
		$data['terms'] = $this->terms_model->get_terms(TRUE);
		$data['top20'] = $this->softs_model->get_top_softs(20);
		
		$query = array("like"=>$str);
		$config['base_url'] = site_url("search/$str");
		$config['total_rows'] = $this->softs_model->get_softs_num($query);
		$config['uri_segment'] 	= 3;
		$this->pagination->initialize($config); 
		
		echo $this->db->last_query();
		
		$query['limit'] = $this->pagination->per_page;
		$query['offset'] = $this->uri->segment($this->pagination->uri_segment);
		$data['softs'] = $this->softs_model->get_softs($query);
		
		//var_dump($data);
		$this->load->view('header',$data);
		$this->load->view('sider',$data);
		$this->load->view('page',$data);
		$this->load->view('footer',$data);
	}	
}


/* End of file search.php */
/* Location: ./application/controllers/search.php */