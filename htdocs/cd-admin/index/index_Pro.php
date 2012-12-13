<?php
//通知公告
$info = isset($_POST['info']) ? $_POST['info'] : '';
$often = isset($_POST['often']) ? $_POST['often'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$need = isset($_POST['need']) ? $_POST['need'] : '';
if($info!=''&&$title!=''&&$often!=''&&$need!=''){
	$often_num = count($often);
	$title_num = count($title);
	$need_num = count($need);
	$flag = true;
	for($i=0;$i<$often_num;$i++){
		$a = (int)$often[$i];
		$b = $often[$i];
		if($often[$i]==''||"$a"!="$b"){
			$flag = false;
		}
	}
	for($j=0;$j<$title_num;$j++){
		$a = (int)$title[$j];
		$b = $title[$j];
		if($title[$j]==''||"$a"=="$b"){
			$flag = false;
		}
	}
	for($k=0;$k<$need_num;$k++){
		$a = (int)$need[$k];
		$b = $need[$k];
		if($need[$k]==''||"$a"!="$b"){
			$flag = false;
		}
	}
	if($flag==true){
		$fp=fopen("../../../application/config/home.php",'w');
		//常用软件
		$often = 'array(';
		foreach($_POST['often'] as $da){
			$often .=','.$da;
		}
		$often .=')';
		$often = str_replace('array(,', 'array(', $often);
		//装机必备
		$title = 'array(';
		foreach($_POST['title'] as $da2){
			$title .=','.'"'.$da2.'"';
		}
		$title .= ')';
		$title = substr_replace($title,'',6,1);
		$need = 'array(';
		$i=0;
		foreach($_POST['need'] as $da3){
			if($i%5==0){
				$need .= ',array(';
			}
			$need .= ','.$da3;
			if($i%5==4){
				$need .= ')';
			}
			$i++;
		}
		$need .= ')';
		$need = str_replace('array(,', 'array(', $need);
		$data = '<?'.'php'.'  if ( ! defined('.'"BASEPATH"'.')) exit('.'"No direct script access allowed"'.' );';
		$data .= ' $home["'.'notice'.'"] = '.'"'.$info.'";';
		$data .= ' $home["'.'often'.'"] ='.$often.';';
		$data .= ' $home["'.'need_title'.'"] ='.$title.';';
		$data .= ' $home["'.'need'.'"] ='.$need.';';
		fwrite($fp, $data); 
		fclose($fp);
		header('location:../index.php?title=index&list=view');
	}else{
		echo "<script language='javascript'>alert('数字框的内容为空？在数字框填了文字？在文字框填了数字？！');location.href='../index.php?title=index&list=view';</script>";
	}
}else{
	echo "<script language='javascript'>alert('你把所有内容都置空了？还是把通知公告的内容置空了？如果不是，你又是怎么找到这个页面的，不错！但是对不起，先登录吧！');location.href='../index.php?title=index&list=view';</script>";
}
?>