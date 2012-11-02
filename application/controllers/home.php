<?php 

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('softs_model');
	}

	public function index()
	{
		$query = array(
										'select'=>'soft_name,down_count,soft_url',
										'limit'	=>'10',
										'order'	=>'down_count desc'
									);
		$data['weekly'] = $this->softs_model->get_softs($query);
		//var_dump($data);
		$this->load->view('home',$data);
	}
	
}


/* End of file home.php */
/* Location: ./application/controllers/home.php */