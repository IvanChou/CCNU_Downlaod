<?php
class Home_model extends CI_Model {
	
	var $home;
	
	public function __construct()
	{
		$this->load->model('softs_model');
		
		// Load the ~/config/home.php
		if(is_file(APPPATH . 'config/home.php')) {
			include (APPPATH . 'config/home.php');
		}
		$this->home = (object)$home;
	}
	
	/**
	 * Get the web-notice from config.
	 * 
	 * @Author	Ichou
	 * @return	String
	 */
	public function get_notice()
	{
		return $this->home->notice;
	}
	
	/**
	 * Get the often-used softs list from config.
	 * 
	 * @Author	Ichou
	 * @return	Array
	 */
	public function get_often()
	{
		$often = $this->home->often;
		$result = $this->softs_model->get_softs(array("where_ids"=>$often));
		
		foreach ($often as $k => $v) {
			foreach ($result as $s) {
				if($v == $s['ID']){
					$often[$k] = $s;
					break;
				}
			}
			
		}
		
		return $often;
	}
	
	/**
	 * Get the must-need softs array from config.
	 * 
	 * @Author	Ichou
	 * @return	Array
	 */
	public function get_need()
	{
		$need_title = $this->home->need_title;
		$need_ids = $this->home->need;
		
		foreach ($need_ids as $k => $v) {
			$result = $this->softs_model->get_softs(array("where_ids"=>$v));
			foreach ($v as $x => $y) {
				foreach ($result as $s) {
					if($y == $s['ID']){
						$need[$k][$x] = $s;
						break;
					}
				}
			}
		}
		
		return array($need_title,$need);
	}
}
	
/* End of file home_model.php */
/* Location: ./application/models/home_model.php */