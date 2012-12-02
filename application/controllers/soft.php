<?php

class Soft extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('number');
		$this->load->helper('download');
		
		$this->load->model('softs_model');
		$this->load->model('tags_model');
		$this->load->model('terms_model');
		$this->load->model('comments_model');
		$this->load->model('dlogs_model');
		
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('user_agent');
	}
	
	public function show($id = FALSE)
	{
		if(! $this->is_exist($id)) show_404();
		
		$data['site_url'] = base_url();
		$data['terms'] = $this->terms_model->get_terms(TRUE);
		$data['top20'] = $this->softs_model->get_top_softs(20);
		
		$data['soft'] = $this->softs_model->get_soft(array("where"=>"id = $id"));
		
		$config['base_url'] = site_url("soft/show/$id");
		$config['total_rows'] = count($this->comments_model->get_comments($id));
		$this->pagination->initialize($config); 
		
		$data['comments'] = $this->comments_model->get_comments($id,$this->pagination->per_page,$this->uri->segment($this->pagination->uri_segment));
		
		$this->load->view('header',$data);
		$this->load->view('sider',$data);
		$this->load->view('soft',$data);
		$this->load->view('footer',$data);
	}
	
	public function down($id = FALSE)
	{
		if(! $this->is_exist($id)) show_404();
		
		$this->dlogs_model->down($id);
		
		$query = array(
						"where"=>"id = $id",
						"select"=>"soft_url,soft_name"
						);
		$soft = $this->softs_model->get_soft($query);
		
		$x = explode('.', $soft['soft_url']);
		$extend = end($x);
		$name = $soft['soft_name'].'.'.$extend;
		$file = file_get_contents($soft['soft_url']);
		
		force_download($name, $file);
	}
	
	public function comment()
	{
		// 验证权限
		
		$this->form_validation->set_rules('soft-id', 'Soft-id', 'callback_is_exist[true]');
		$this->form_validation->set_rules('content', 'Comment-content', 'htmlspecialchars|required|min_length[5]|max_length[140]|xss_clean');
		$this->form_validation->set_rules('name', 'user-name', 'trim|required|min_length[1]|max_length[12]|xss_clean');
		$this->output->set_header("Content-type:text/html; charset=utf-8");
		
		if ($this->form_validation->run() == FALSE){
			echo validation_errors();
		} else {
			$this->comments_model->add_comment($_REQUEST);
			echo "OK!评论原来如此轻松~";
		}
		
	}
	
	public function like($id = FALSE)
	{
		if(! $this->is_exist($id)) show_404();
		$result = $this->dlogs_model->appraise($id,"like");
		$this->output->set_header("Content-type:text/html; charset=utf-8");
		
		switch ($result) {
			case '404':
				echo "小平同志说：“实践是检验真理的唯一标准。” 所e还是把它Down下来看看再评价吧~";
				break;
			case 'repeat':
				echo "你明明已经点过支持了的说，健忘了？还是瞎捣乱 =。=";
				break;
			default:
				echo "我代表软件感谢您!";
				break;
		}
	}
	
	public function unlike($id = FALSE)
	{
		if(! $this->is_exist($id)) show_404();
		$result = $this->dlogs_model->appraise($id,"unlike");
		$this->output->set_header("Content-type:text/html; charset=utf-8");

		switch ($result) {
			case '404':
				echo "怎么可以 o_O~ 你都还没下载就给差评，小心被寄寿衣啊!";
				break;
			case 'repeat':
				echo "呃，呃，它跟你有深仇大恨吗？你已经反对过它了哦";
				break;
			default:
				echo "少年，你点了反对耶，我觉得我们得一起喝喝茶了~";
				break;
		}
	}
	
	function is_exist($id,$is_form=FALSE)
	{
		$id = (int)$id;
		if(! $id){
			$is_form && $this->form_validation->set_message('is_exist', 'The %s field is required');
			return FALSE;
		}
		if($this->softs_model->get_softs_num(array("where"=>"ID = $id")) == 0){
			$is_form && $this->form_validation->set_message('is_exist', 'The %s field is wrong');
			return FALSE;
		}
		
		return TRUE;
	}
	
}

/* End of file soft.php */
/* Location: ./application/controllers/soft.php */