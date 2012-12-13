<?php
define('IN_TG',true);
require '../include/mysql_connect.php';
/*$fp=fopen("../../../application/config/home.php",'w');
//通知公告
$info = $_POST['info'];
//常用软件
$often = 'array(';
foreach($_POST['check'] as $da){
	$often .=','.$da;
}
$often .=')';
$often=  substr_replace($often,'',6,1);
//装机必备
$title = 'array(';
foreach($_POST['check2'] as $da2){
	$sql = 'SELECT term_name FROM cd_terms WHERE term_id = '.$da2;
	mysql_query('set names utf8');
	$result = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	$title .=','.'"'.$row['term_name'].'"';
}
$title .= ')';
$title = substr_replace($title,'',6,1);
$data = '<?'.'php'.'  if ( ! defined('.'"BASEPATH"'.')) exit('.'"No direct script access allowed"'.' );';
$data .= ' $home["'.'notice'.'"] = '.'"'.$info.'";';
$data .= ' $home["'.'often'.'"] ='.$often.';';
$data .= ' $home["'.'need_title'.'"] ='.$title.';';
fwrite($fp, $data); 
fclose($fp);
header('location:../index.php?title=index&list=view');*/
$need = 'array(';
foreach($_POST['check2'] as $da2){
	$need .= ',array(';
	$sql = 'SELECT ID FROM cd_softs WHERE term_id = '.$da2;
	$result = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_assoc($result)){
		foreach($_POST['check3'] as $da3){
			if($row['ID']==$da3){
				$need .= ','.$da3;
			}
		}
	}
	$need .= ')';
	//echo substr($need,0,'(');
}
$need .= ')';
//$need = substr_replace($need,'',6,1);
echo $need;
?>