<?php 

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('softs_model');
	}

	public function index()
	{
		$data = $this->softs_model->get_softs();
		//var_dump($data);
		$this->load->view('home',$data);
	}
	
}


/* End of file home.php */
/* Location: ./application/controllers/home.php */