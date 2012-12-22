<?php
header("content-type:text/html; charset=utf-8");
define('IN_TG',true);
require ('../include/mysql_connect.php');
if (isset($_GET['com_id'])){
	$Com_Id = $_GET['com_id'];
}
$sql = 'DELETE FROM `cd_comments` WHERE com_id ='.$Com_Id;
mysql_query('set names utf8');
$result = mysql_query($sql) or die(mysql_error());
if($result){
	header('location:../index.php?title=discuss&list=view');
}else{
	echo "<script language='javascript'>alert('记录删除失败！');location.href='../index.php?title=discuss&list=view';</script>";
}
?>	