<?php
define('IN_TG',true);
header("content-type:text/html; charset=utf-8");
require ('../include/mysql_connect.php');
if(isset($_POST['check']) != ''){
	foreach($_POST['check'] as $data){
		$sql = 'DELETE FROM `cd_comments` WHERE com_id ='.$data;
		mysql_query('set names utf8');
		$result = mysql_query($sql) or die(mysql_error());
		if($result){
			header('location:../index.php?title=discuss&list=view');
		}else{
			echo "<script language='javascript'>alert('评论删除失败！');location.href='../index.php?title=discuss&list=view';</script>";
		}
	}
}else{
	echo "<script language='javascript'>alert('没有选中评论！');location.href='../index.php?title=discuss&list=view';</script>";
}
?>