<?php
header("content-type:text/html; charset=utf-8");
require ('./includes/mysql_connect.php');
if (isset($_GET['softid'])){
	$softid = $_GET['softid'];
}
$sql = "SELECT soft_url as softname,term_id FROM `cd_softs` WHERE ID =". $softid;
mysql_query('set names utf8');
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);
$folder_name = "../";
$softname = $row['softname'];

//若有缩略图，同步将缩略图删除
$sql3 ="SELECT soft_img as softimg FROM `cd_softs` WHERE ID =".$softid;
$result3 = mysql_query($sql3) or die(mysql_error());
$row3 = mysql_fetch_assoc($result3);
$softimg = $row3['softimg'];
if(file_exists($folder_name.$softimg)&&$softimg != ''){
    $del_soft = unlink($folder_name.$softimg);
}

if(unlink($folder_name.$softname) || !file_exists($folder_name.$softname)){
	$sql2 = 'DELETE FROM `cd_softs` WHERE ID = '.$softid;
	$result2 = mysql_query($sql2) or die (mysql_error());
	if($result2){
		header('location:./index.php?title=soft&list=view');
	}else{
		echo "<script language='javascript'>alert('记录删除失败！');location.href='index.php?title=soft&list=view';</script>";
	}
}else{
	echo "<script language='javascript'>alert('软件删除失败，记录没有被删除！');location.href='index.php?title=soft&list=view';</script>";
}
?>	

