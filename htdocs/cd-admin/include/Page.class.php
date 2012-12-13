<?php
/*类名称：分页类
 *功能说明：该分页类可以查看上一页、下一页、首页、尾页，显示总的记录数，显示每页显示显示数，每页显示的起始-结束条数，当前页数/总的页数，分页列表，跳转的某一分页
 *          跳转分页对填入的数字进行了验证（大于总记录数和小于等于0的情况
 *          实际应用中可以随意组合以上模板，且提供了传入其它参数的接口（即除了自定义的page还可以有其它参数）
 *时间：2012-07-28
 */


class Page{
	private $total;
	private $listRows;//每页显示函数
	private $limit;
	private $uri;
	private $pageNum;//页数
	private $config=array('header'=>'条信息','prev'=>'上一页','next'=>'下一页','first'=>'首页','last'=>'尾页');
	
	
	private $listNum = 3;
	
	public function __construct($total,$listRows=10,$pa=""){
		$this->total=$total;
		$this->listRows=$listRows;
		$this->uri=$this->getUri($pa);
		$this->page=!empty($_GET['page']) ? $_GET['page']:1;
		$this->pageNum=ceil($this->total/$this->listRows);
		$this->limit=$this->setLimit();
	}
	
	private function setLimit(){
		return "Limit ".($this->page-1)*($this->listRows).",{$this->listRows}";
	}
	private function getUri($pa){
		$url = $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':'?').$pa;
		
		$parse = parse_url($url);

		if(isset($parse['query'])){
			parse_str($parse['query'],$params);
			unset($params['page']);
			$url = $parse['path'].'?'.http_build_query($params);
		}
		return $url;
		
	}
	
	private function __get($args){
		if($args=="limit"){
			return $this->limit;
		}else{
			return null;
		}
	
	}
	private function start(){
		if($this->total==0)
			return 0;
		else
			return ($this->page-1)*$this->listRows+1;
	}
	
	private function end(){
		return min($this->page*$this->listRows,$this->total);
	}
	
	private function first(){
		if($this->page==1){
			$links = "<a>&laquo;{$this->config['first']}</a>";
		}else{
			$links = "<a href='javascript:setPage(\"{$this->uri}&page=1\")'>&laquo;{$this->config['first']}</a>";
		}
		return $links;
	}
	private function prev(){
		if($this->page==1){
			$links = "<a>&laquo;{$this->config['prev']}</a>";
		}else{
			$links = "<a href='javascript:setPage(\"{$this->uri}&page=".($this->page-1)."\")'>&laquo;{$this->config['prev']}</a>";
		}
		return $links;
	}
	private function next(){
		if($this->page==$this->pageNum){
			$links = "<a>{$this->config['next']}&raquo;</a>";
		}else{
			$links = "<a href='javascript:setPage(\"{$this->uri}&page=".($this->page+1)."\")'>{$this->config['next']}&raquo;</a>";
		}
		return $links;
	}
	private function last(){
		if($this->page==$this->pageNum){
			$links = "<a>{$this->config['last']}&raquo;</a>";
		}else{
			$links = "<a href='javascript:setPage(\"{$this->uri}&page=".($this->pageNum)."\")'>{$this->config['last']}&raquo;</a>";
		}
		return $links;
	}
	private function goPage(){
		return '<input type="text" style="margin-right:3px;width:18px;text-align:center;" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.')?'.$this->pageNum.':this.value&&(this.value<1)?1:this.value;setPage(\''.$this->uri.'&page=\'+page+\'\')}" value="'.$this->page.'" style="width:25px;"/><input type="button" class="button" style="padding: 2px 3px 2px 3px !important;width:23px;margin-right:3px;vertical-align:top;" value="GO" onclick="javascript:var page=(this.previousSibling.value>'.$this->pageNum.')?'.$this->pageNum.':this.previousSibling.value&&(this.previousSibling.value<1)?1:this.previousSibling.value;setPage(\''.$this->uri.'&page=\'+page+\'\')" />';
	}
	private function pageList(){
		$linkPage = '';
		
		$inum = floor($this->listNum/2);
		
		for($i=$inum;$i>=1;$i--){
			$page = $this->page-$i;
			if($page<1)
				continue;
			
			$linkPage .= "<a href='javascript:setPage(\"{$this->uri}&page={$page}\")' class='number'>{$page}</a>";
		}
		$linkPage .= "<a class='number current'>{$this->page}</a>";
		
		for($i=1;$i<=$inum;$i++){
			$page = $this->page+$i;
			if($page<=$this->pageNum)
				$linkPage .= "<a href='javascript:setPage(\"{$this->uri}&page={$page}\")' class='number'>{$page}</a>";
			else
				break;
		}
		return $linkPage;
	}

	function fpage($display = array(0,1,2,3,4,5,6,7,8)){
		$html[0] = "&nbsp;&nbsp;共有{$this->total}{$this->config['header']}&nbsp;&nbsp;";
		$html[1] = "&nbsp;&nbsp;每页显示".($this->end()-$this->start()+1)."条,本页显示{$this->start()}-{$this->end()}条&nbsp;&nbsp;";
		$html[2] = "&nbsp;&nbsp;{$this->page}/{$this->pageNum}页&nbsp;&nbsp;";
		$html[3] = $this->first();
		$html[4] = $this->prev();
		$html[5] = $this->pageList();
		$html[6] = $this->next();
		$html[7] = $this->last();
		$html[8] = $this->goPage();
		
		$fpage = '';
		foreach($display as $index){
			$fpage .= $html[$index];
		}
		return $fpage;
	}


}



?>