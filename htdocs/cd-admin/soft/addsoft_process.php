<?php
header("content-type:text/html; charset=utf-8");
define('IN_TG',true);
require '../include/mysql_connect.php';
logincheck();
$addtype = $_POST['add_type'];
$soft_name = (isset($_POST['soft_name'])) ? $_POST['soft_name'] : '';
$term = (isset($_POST['firstmenu'])) ? $_POST['firstmenu'] : 0;
$tag = (isset($_POST['secondmenu'])) ? $_POST['secondmenu'] : 0;
$desc = (isset($_POST['desc'])) ? $_POST['desc'] : '';
$soft_os =(isset($_POST['soft_os'])) ? $_POST['soft_os'] : '';
$soft_os = implode('',$soft_os);
if($soft_os=="1"){
	$soft_os = 'Win';
}else if($soft_os=="2"){
	$soft_os = 'Linux';
}else if($soft_os=="3"){
	$soft_os = 'Mac OS';
}else if($soft_os=="4"){
	$soft_os = 'Android';
}else if($soft_os=="12"){
	$soft_os = 'Win,Linux';
}else{
	$soft_os = '适合多种平台';
}
//http上传
if($addtype=='http'){
	if($_FILES['upload']['tmp_name']!=''){
		if(!empty($soft_name)&&!empty($desc)&&!empty($soft_os)&&($term != 0)&&($tag != 0)){
			require_once ('../include/class.HttpUpload.php');
			$upload = new Upload(array('uploadPath'=>'../../cd-resource/'.$term.''));
	        $upload->fileUpload($_FILES['upload'],$soft_name,$soft_os,$desc,$term,$tag);
	        $error = $upload->getStatus();
	        $upload_id = $upload->getId();
	
	        $dest_dir = '../../cd-resource/'.$term;   //设定上传目录
	        $dest_dir2 = 'cd-resource/'.$term;
			
			if($_FILES['soft_pic']['tmp_name']!=''){
				$arr = explode('.',$_FILES['soft_pic']['name']); //分割文件名
                $file_extend = end($arr); //取数组中的最后一个值
		        $sql4 = 'select soft_url from `cd_softs` where ID = '.$upload_id;
		        $result4 = mysql_query($sql4) or die(mysql_error());
		        $row4 = mysql_fetch_assoc($result4);
		        $imgnewname = split("\.|/",$row4['soft_url']);
		
		        $file_newname = $dest_dir.'/'.$imgnewname[2].'.'.$file_extend;
		        $file_newname2 = $dest_dir2.'/'.$imgnewname[2].'.'.$file_extend;
				if($_FILES['soft_pic']['type'] == 'image/jpeg'||$_FILES['soft_pic']['type'] == 'image/pjpeg'||$_FILES['soft_pic']['type'] == 'image/png'||$_FILES['soft_pic']['type'] == 'image/gif'){
					if (move_uploaded_file($_FILES['soft_pic']['tmp_name'], $file_newname)){
						$sql3 = "update `cd_softs` set soft_img = '$file_newname2' where ID = ".$upload_id;
						$result3 = mysql_query($sql3) or die(mysql_error());
						if(!$result3){
							@unlink($file_newname);
						}
					}
				}else{
					echo "<script language='javascript'>alert('上传的图标只能是jpg，gif或png格式！');location.href='../index.php?title=soft&list=softadd';</script>";
					break;
				}
			}
		}
	}else{
		echo "<script language='javascript'>alert(\"请选择上传的软件！\");location.href='../index.php?title=soft&list=softadd';</script>";
		break;
	}
	foreach($error as $key =>$value){
		echo "<script language='javascript'>alert(\"$value\");location.href='../index.php?title=soft&list=view';</script>";
	}
}else{
    //ftp上传开始
	$ftpsoftname = (isset($_POST['ftpsoftname'])) ? trim($_POST['ftpsoftname']) : '';
	$url = 'cd-resource/'.$term.'/'.$ftpsoftname;
	$softtruename2 = split("/",$url);
	$softexitend = explode ('.',$ftpsoftname);
	$softexitend = end($softexitend);
	//$softexitend = split("\.|/",$url);
	$realsofturl = '../../'.'cd-resource/'.'ftp/'.$ftpsoftname;
	//物理文件名中“.”的个数
	$dotnum = substr_count($ftpsoftname,'.');
	//物理文件名中是否含有中文
	$chinese_isexist = preg_match('/[\x80-\xff]./', $ftpsoftname);
	if(file_exists($realsofturl)&&$ftpsoftname!=''&&$dotnum >= 1&&$chinese_isexist == 0){
		$size = filesize($realsofturl);
		if(!empty($soft_name)&&!empty($desc)&&($term != 0)&&($tag != 0)&&!empty($soft_os)){
			$sql2 = "INSERT INTO `cd_softs` (soft_name, soft_url,term_id,tag_id,soft_size,soft_description,soft_os,post_time) VALUES ('$soft_name', '$url',$term,$tag,$size, '$desc','$soft_os',now())";
			mysql_query('set names utf8');
			$result2 = mysql_query($sql2) or die(mysql_error());
			$upload_id = mysql_insert_id();
			
			$dest_dir = '../../cd-resource/'.$term;   //设定上传目录
			$dest_dir2 = 'cd-resource/'.$term;
			if(!file_exists($dest_dir)){
				mkdir($dest_dir, 0777);
			}
			if($_FILES['soft_pic']['tmp_name']!=''){
				$arr = explode('.',$_FILES['soft_pic']['name']); //分割文件名
				$file_extend = end($arr); //取数组中的最后一个值
				$newname = date("YmdHis").'_'.rand(1000,9999).'.'.$file_extend;
				$file_newname = $dest_dir.'/'.$newname;
				$file_newname2 = $dest_dir2.'/'.$newname;
				
				if($_FILES['soft_pic']['type'] == 'image/jpeg'||$_FILES['soft_pic']['type'] == 'image/pjpeg'||$_FILES['soft_pic']['type'] == 'image/png'||$_FILES['soft_pic']['type'] == 'image/gif'){
					if (move_uploaded_file($_FILES['soft_pic']['tmp_name'], $file_newname)){
						$sql3 = "update `cd_softs` set soft_img = '$file_newname2' where ID = ".$upload_id;
					    $result3 = mysql_query($sql3) or die(mysql_error());
						if(!$result3){
							@unlink($file_newname);
						}
					}
				}else{
					$sql8 = 'delete from `cd_softs` where ID = '.$upload_id;
					$result8 = mysql_query($sql8) or die(mysql_error());
					echo "<script language='javascript'>alert('上传的图标只能是jpg，gif或png格式！');location.href='../index.php?title=soft&list=softadd';</script>";
					break;
				}
			}
			
			$sql6 = 'select soft_img from `cd_softs` where ID = '.$upload_id;
			$result6 = mysql_query($sql6) or die(mysql_error());
			$row6 = mysql_fetch_assoc($result6);
			$softrename = split("\.|/",$row6['soft_img']);
			
			if($row6['soft_img']!=''){
				$newsofturl = 'cd-resource/'.$term.'/'.$softrename[2].'.'.$softexitend;
			}else{
				$softnewname = date("YmdHis").'_'.rand(1000,9999);
				$newsofturl = 'cd-resource/'.$term.'/'.$softnewname.'.'.$softexitend;
			}
			$copy_soft = copy('../../'.'cd-resource/'.'ftp/'.$ftpsoftname,'../../cd-resource/'.$term.'/'.$ftpsoftname);
			if($copy_soft){
				$del_soft = unlink('../../'.'cd-resource/'.'ftp/'.$ftpsoftname);
			}
			if($row6['soft_img']!=''){
				$rename = rename('../../cd-resource/'.$term.'/'.$ftpsoftname,'../../cd-resource/'.$term.'/'.$softrename[2].'.'.$softexitend);
			}
			if($row6['soft_img']==''){
				$rename = rename('../../cd-resource/'.$term.'/'.$ftpsoftname,'../../cd-resource/'.$term.'/'.$softnewname.'.'.$softexitend);
			}
			if($copy_soft && $del_soft && $rename){
				$sql4 = "UPDATE `cd_softs` SET soft_url = '$newsofturl' WHERE ID = ".$upload_id;
				$result4 = mysql_query($sql4) or die(mysql_error());
			}else{
				$sql7 = 'delete from `cd_softs` where ID ='.$upload_id;
				$result7 = mysql_query($sql7) or die(mysql_error());
				echo "<script language=\"javascript\">alert('软件移动或修改软件名失败，没有修改数据库记录！');location.href='../index.php?title=soft&list=softadd';</script>";
			}
			echo "<script language='javascript'>alert('软件上传成功！');location.href='../index.php?title=soft&list=view';</script>";
		}
	}elseif($chinese_isexist == 1){
		echo "<script language='javascript'>alert('物理文件名中含有中文，系统将无法重命名软件名，请去掉物理文件名中的中文！');location.href='../index.php?title=soft&list=softadd';</script>";
		break;
	}elseif($dotnum == 0){
		echo "<script language='javascript'>alert('物理文件名中没有点号，软件将没有扩展名，请重新输入！');location.href='../index.php?title=soft&list=softadd';</script>";
		break;
	}else{
		echo "<script language='javascript'>alert('物理文件不存在，请先上传软件再添加记录！');location.href='../index.php?title=soft&list=softadd';</script>";
		break;
	}
}
?>