<?php
define('IN_TG',true);
require_once ('../include/mysql_connect.php');
logincheck();
header("content-type:text/html; charset=utf-8");
	$softname = escape_data(trim($_POST['softnameedit']));
	$oldterm = $_POST['oldterm'];
	$softname2 = $_POST['softname2'];
	$softtruename2 = split("/",$_POST['softname2']);
	$softexitend = split("\.|/",$_POST['softname2']);
	$term = $_POST['firstmenu'];
	$tag = $_POST['secondmenu'];
	$soft_url = 'cd-resource/'.$term.'/'.$_POST['softname'];
	$d = $_POST['desc'];
	$os = $_POST['softos'];
	$soft_size = trim($_POST['softsize']).$_POST['softsizeliangji'];
	$softid = $_POST['soft_id'];
	//将人工填写的软件大小转换成以B为单位的值，以便可以存储在数据库
	if (strpos($soft_size,"GB")){
		$soft_size = str_replace("GB","","$soft_size");	
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1073741824;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
			break;
		}
	}elseif(strpos($soft_size,"MB")){
		$soft_size = str_replace("MB","","$soft_size");	
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1048576;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
			break;
		}
	}elseif(strpos($soft_size,"KB")){
		$soft_size = str_replace("KB","","$soft_size");	
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1024;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
			break;
		}
	}elseif(strpos($soft_size,"B")){
		$soft_size = str_replace("B","","$soft_size");
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
			break;
		}
	}elseif(is_numeric($soft_size)){
		$soft_size = $soft_size*1;
	}else{
		echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
		break;
	}
	
	$sql7 = 'select term_id from `cd_softs` where ID = '.$softid;
	$result7 = mysql_query($sql7) or die(mysql_error());
	$row7 = mysql_fetch_assoc($result7);
	$dest_dir = '../../cd-resource/'.$row7['term_id'];   //设定上传目录
	$dest_dir2 = 'cd-resource/'.$row7['term_id'];
	
	$sql8 = "select soft_img from `cd_softs` where ID =".$softid;
	$result8 = mysql_query($sql8) or die(mysql_error());
	$num8 = mysql_num_rows($result8);
	$row8 = mysql_fetch_assoc($result8);
	if($_FILES['upload']['tmp_name']!=''){
		$arr = explode('.',$_FILES['upload']['name']); //分割文件名
        $file_extend = end($arr); //取数组中的最后一个值
		$newimg = split("\.",$_POST['softname']);
		$newname = $newimg[0].'.'.$file_extend;
		$file_newname = $dest_dir.'/'.$newname;
		$file_newname2 = $dest_dir2.'/'.$newname;
		
		if($_FILES['upload']['type'] == 'image/jpeg'||$_FILES['upload']['type'] == 'image/pjpeg'||$_FILES['upload']['type'] == 'image/png'||$_FILES['upload']['type'] == 'image/gif'){
			if($num8 !=0 && file_exists('../../'.$row8['soft_img']) && $row8['soft_img']!=''){
				unlink('../../'.$row8['soft_img']);
			}
			if (move_uploaded_file($_FILES['upload']['tmp_name'], $file_newname)){
				$sql9 = "update `cd_softs` set soft_img = '$file_newname2' where ID = ".$softid;
				$result9 = mysql_query($sql9) or die(mysql_error());
				if(!$result9){
					unlink($file_newname);
				}
			}
		}else{
			echo "<script language='javascript'>alert('上传的图标只能是jpg，gif或png格式！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
			break;
		}
	}
	
	$folder_name ="../../cd-resource/$oldterm/";
	$folder_name_new ="../../cd-resource/$term/";
	if(!file_exists($folder_name_new)){
		mkdir($folder_name_new, 0777); 
	}
	if($folder_name == $folder_name_new){
		if(strlen($softexitend[2])!=19){
			rename($folder_name.$softtruename2[2],$folder_name.$_POST['softname']);
		}
		$sql = "UPDATE `cd_softs` SET soft_name = '$softname',soft_size = $soft_size,soft_url = '$soft_url',soft_os = '$os',term_id = $term,tag_id = $tag,soft_description = '$d' WHERE ID = ".$softid;
	    mysql_query('set names utf8');
	    $result = mysql_query($sql) or die(mysql_error());
	}else{
		$sql6 = "SELECT soft_img as softimg FROM `cd_softs` WHERE ID =".$softid;
		$result6 = mysql_query($sql6) or die(mysql_error());
		$row6 = mysql_fetch_assoc($result6);
		$softimg = $row6['softimg'];
		$imgtruename = split("/",$row6['softimg']);
		if(file_exists('../../'.$softimg)&&$softimg != ''){
			$copy_soft2 = copy('../../'.$softimg,$folder_name_new.$imgtruename[2]);
	        $del_soft2 = unlink('../../'.$softimg);
			if($copy_soft2&&$del_soft2){
				$newsoftimg = "cd-resource/$term/$imgtruename[2]";
				$sql5 = "update `cd_softs` set soft_img = '$newsoftimg' where ID =".$softid;
				$result5 = mysql_query($sql5) or die(mysql_error());
			}else{
				echo "<script language=\"javascript\">alert('缩略图移动失败！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
				break;
			}
		}
		if(file_exists('../../'.$softname2)){
			$copy_soft = copy('../../'.$softname2,$folder_name_new.$softtruename2[2]);
	        $del_soft = unlink('../../'.$softname2);
			if(strlen($softexitend[2])!=17){
				$rename = rename($folder_name_new.$softtruename2[2],$folder_name_new.$_POST['softname']);
			}
			if($copy_soft && $del_soft){
				$sql4 = "UPDATE `cd_softs` SET soft_name = '$softname',soft_size = $soft_size,soft_os = '$os',soft_url = '$soft_url',term_id = $term,tag_id = $tag,soft_description = '$d' WHERE ID = ".$softid;
			    mysql_query('set names utf8');
			    $result4 = mysql_query($sql4) or die(mysql_error());
			}else{
				echo "<script language=\"javascript\">alert('软件移动或修改软件名失败，没有修改数据库记录！');location.href='../index.php?title=soft&list=edit&softid=$softid';</script>";
			}
		}else{
			$sql3 = "UPDATE `cd_softs` SET soft_name = '$softname',soft_size = $soft_size,soft_os = '$os',soft_url = '$soft_url',term_id = $term,tag_id = $tag,soft_description = '$d' WHERE ID = ".$softid;
			mysql_query('set names utf8');
			$result3 = mysql_query($sql3) or die(mysql_error());
			echo "<script language=\"javascript\">alert('软件不存在，仅修改了数据库记录！');location.href='../index.php?title=soft&list=view';</script>";
		}
	}
	echo "<script language=\"javascript\">alert('修改成功！');location.href='../index.php?title=soft&list=view';</script>";
?>