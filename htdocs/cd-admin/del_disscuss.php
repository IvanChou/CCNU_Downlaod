<?php
header("content-type:text/html; charset=utf-8");
require ('./includes/mysql_connect.php');
if (isset($_GET['com_id'])){
	$Com_Id = $_GET['com_id'];
}
$sql = 'DELETE FROM `cd_comments` WHERE com_id ='.$Com_Id;
mysql_query('set names utf8');
$result = mysql_query($sql) or die(mysql_error());
if($result){
	header('location:./disscuss.php?title=disscuss&list=view');
}
else{
	echo "<script language='javascript'>alert('记录删除失败！');location.href='disscuss.php?title=disscuss&list=view';</script>";
}
?>	

