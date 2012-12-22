<?php
define('IN_TG',true);
require '../include/mysql_connect.php';
//返回的数据格式(xml格式)
header("Content-Type:text/xml;charset=utf-8");
//不要缓存数据
header("Cache-Control:no-cache");
$firstmenu = $_POST['firstmenu'];
//file_put_contents("./my.log",$firstmenu."\r\n",FILE_APPEND);
//到数据库查询一级栏目下有哪些二级栏目
$info = "";
if($firstmenu == ""){
	$info = "<secondmenu><num>0</num><menuname>未指定一级栏目</menuname></secondmenu>";
}else{
	$sql = 'select * from `cd_tags` where tag_parent ='.$firstmenu;
	mysql_query("set names utf8");
	$result = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($result);
	$info ="<secondmenu>";
	if($num>=1){
		while($row = mysql_fetch_assoc($result)){
		$info .= "<num>".$row['tag_id']."</num><menuname>".$row['tag_name']."</menuname>";
		}
	}else{
		$info .="<num>0</num><menuname>没有二级栏目</menuname>";
	}
	$info .="</secondmenu>";
}
//file_put_contents("./my.log",$info."\r\n",FILE_APPEND);
echo $info;

?>