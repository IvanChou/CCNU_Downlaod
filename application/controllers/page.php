<?php 

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
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
	
	/**
	 * Get Page's content. Just for DRY.
	 * 
	 * @Author	Ichou
	 * @param	String	$method	in(tag,term)
	 * @param	Array	$param
	 * @param	Array	$data
	 */
	function _get_list($method,$param = FALSE,$data = FALSE)
	{
		if(! $param) show_404();
		
		$data['site_url'] = base_url();
		$data['terms'] = $this->terms_model->get_terms(TRUE);
		$data['top20'] = $this->softs_model->get_top_softs(20);
		
		$query = array("where"=>$method."_id = $param");
		$config['base_url'] = site_url("page/$method/$param");
		$config['total_rows'] = $this->softs_model->get_softs_num($query);
		$this->pagination->initialize($config); 
		
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


/* End of file page.php */
/* Location: ./application/controllers/page.php */