<?php
function AddTerm($term_name,$term_rank){
	$sql = "INSERT INTO `cd_terms` (term_name,term_rank) VALUES ('$term_name',$term_rank);";
	mysql_query('set names utf8');
	$result = mysql_query($sql) or die(mysql_error());
	header('location:./sorts.php?title=sorts&list=view');
}
function AddTag($tag_name,$tag_rank,$tag_father){
	$sql = "INSERT INTO `cd_tags` (tag_name,tag_rank,tag_parent) VALUES ('$tag_name',$tag_rank,$tag_father)";
	mysql_query('set names utf8');
	$result = mysql_query($sql) or die(mysql_error());
	header('location:./sorts.php?title=sorts&list=view');
}
function DeleteTerm($term_ID){
	$flag = false;
	$folder_name ="../cd-resource/$term_ID/";
	$softname = "SELECT soft_url as softname FROM `cd_softs` WHERE term_id =".$term_ID;
	$softresult = mysql_query($softname);
	$num = mysql_num_rows($softresult);
	if($num == 0){
		$flag = true;
	}
	while($softrow = mysql_fetch_assoc($softresult)){
	    //若有缩略图，同步将缩略图删除
		$sql4 ="SELECT soft_img as softimg FROM `cd_softs` WHERE term_id =".$term_ID;
        $result4 = mysql_query($sql4) or die(mysql_error());
        $row4 = mysql_fetch_assoc($result4);
        $softimg = $row4['softimg'];
        if(file_exists('../'.$softimg)&&$softimg != ''){
            $del_img = unlink('../'.$softimg);
        }
		if(unlink('../'.$softrow['softname'])||!file_exists('../'.$softrow['softname'])){
			$flag = true;
		}
	}
	if ($flag == true){
		$deldir = rmdir($folder_name);
	}else{
		$deldir = 0;
	}
	
	if($deldir || !file_exists($folder_name)){
		$sql ='DELETE FROM `cd_softs` WHERE term_id =' .$term_ID;
	    $result = mysql_query($sql) or die(mysql_error());
	    $sql2 = 'DELETE FROM `cd_tags` WHERE tag_parent =' .$term_ID;
	    $result2 = mysql_query($sql2) or die (mysql_error());
	    $sql3 = 'DELETE FROM `cd_terms` WHERE term_id =' .$term_ID;
	    $result3 = mysql_query($sql3) or die(mysql_error());
		if($result&&$result2&&$result3){
			header('location:./sorts.php?title=sorts&list=view');
		}else{
			echo "<script language='javascript'>alert('删除一级栏目失败！');location.href='sorts.php?title=sorts&list=view';</script>";
		}
	}else{
		echo "<script language='javascript'>alert('删除文件失败！');location.href='sorts.php?title=sorts&list=view';</script>";
	}
}
function DeleteTag($tag_ID){
	$flag = false;
	$softname = "SELECT soft_url as softname,term_id FROM `cd_softs` WHERE tag_id =".$tag_ID;
	$softresult = mysql_query($softname) or die(mysql_error());
	$num = mysql_num_rows($softresult);
	if($num == 0){
		$flag = true;
	}
	while($softrow = mysql_fetch_assoc($softresult)){
		$folder_name ="../cd-resource/".$softrow['term_id']."/";
		//若有缩略图，同步将缩略图删除
		$sql3 ="SELECT soft_img as softimg FROM `cd_softs` WHERE tag_id =".$tag_ID;
        $result3 = mysql_query($sql3) or die(mysql_error());
        $row3 = mysql_fetch_assoc($result3);
        $softimg = $row3['softimg'];
        if(file_exists('../'.$softimg)&&$softimg != ''){
            $del_soft = unlink('../'.$softimg);
        }

		if(unlink('../'.$softrow['softname']) || !file_exists('../'.$softrow['softname'])){
			$flag = true;
		}
	}
	if ($flag == true){
		$sql = 'DELETE FROM `cd_softs` WHERE tag_id ='.$tag_ID;
		mysql_query($sql) or die(mysql_error());
		$sql2 = 'DELETE FROM `cd_tags` WHERE tag_id ='.$tag_ID;
	    mysql_query($sql2) or die(mysql_error());
	    header('location:./sorts.php?title=sorts&list=view');
	}else{
		echo "<script language='javascript'>alert('删除文件失败！');location.href='sorts.php?title=sorts&list=view';</script>";
	}
}
function ChangeTag($tag_ID,$tag_name,$tag_rank,$tag_father){
	$flag = false;
	$sql = "SELECT ID,term_id,soft_url as softname FROM `cd_softs` WHERE tag_id =".$tag_ID;
	mysql_query('set names utf8');
	$result = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($result);
	if($num == 0){
		$flag = true;
	}
	while($row = mysql_fetch_assoc($result)){
		$folder_name ="../cd-resource/".$row['term_id']."/";
		$folder_name_new ="../cd-resource/$tag_father/";
		if(!file_exists($folder_name_new)){
			mkdir($folder_name_new, 0777); 
		}
		$softtruename3 = split("/",$row['softname']);
		if($folder_name != $folder_name_new){
			$copy_soft = copy('../'.$row['softname'],$folder_name_new.$softtruename3[2]);
	        $del_soft = unlink('../'.$row['softname']);
			//若有缩略图，将缩略图一起移动
			$sql4 = "SELECT soft_img as softimg FROM `cd_softs` WHERE ID =".$row['ID'];
		    $result4 = mysql_query($sql4) or die(mysql_error());
		    $row4 = mysql_fetch_assoc($result4);
		    $softimg = $row4['softimg'];
			$imgtruename3 = split("/", $softimg);
			if(file_exists('../'.$softimg)&&$softimg != ''){
			    $copy_soft2 = copy('../'.$softimg,$folder_name_new.$imgtruename3[2]);
	            $del_soft2 = unlink('../'.$softimg);
			    if($copy_soft2&&$del_soft2){
				    $newsoftimg = "cd-resource/$tag_father/$imgtruename3[2]";
				    $sql5 = "update `cd_softs` set soft_img = '$newsoftimg' where ID =".$row['ID'];
				    $result5 = mysql_query($sql5) or die(mysql_error());
				    $flag = true;
			    }else{
				    echo "<script language=\"javascript\">alert('缩略图移动失败！');location.href='edit_tag.php?tag_id=$tag_ID';</script>";
			    }
		    }
		}
		//软件移动后，将相应的url也更改
		//$url = '218.199.196.7'.":".$_SERVER["SERVER_PORT"];
		//$url = "http://$url/cd-resource/$tag_father/".$row['softname'];
		$url = "cd-resource/$tag_father/".$softtruename3[2];
		$sql3 = "UPDATE `cd_softs` SET soft_url = '$url', term_id =".$tag_father." WHERE ID =".$row['ID'].";";
		$result3 = mysql_query($sql3) or die(mysql_error()); 
		$flag = true;
	}
	
	if($flag == true){
		$sql2 = "UPDATE `cd_tags` SET tag_name = '$tag_name',tag_parent = $tag_father,tag_rank = $tag_rank WHERE tag_id =".$tag_ID;
		$result2 = mysql_query($sql2) or die(mysql_error());
		header('location:./sorts.php?title=sorts&list=view');
	}else{
		echo "<script language='javascript'>alert('二级栏目修改失败！');location.href='sorts.php?title=sorts&list=view';</script>";
	}
}

function RankTermByNum($term_rank,$term_id){
	if(is_numeric($term_rank)&&$term_rank>=1&&$term_rank<=10){
		$sql = 'UPDATE `cd_terms` SET term_rank = '.$term_rank.' WHERE term_id = '.$term_id;
	    $result = mysql_query($sql) or die(mysql_error());
	    header('location:./sorts.php?title=sorts&list=view');
	}else{
		echo "<script language='javascript'>alert('填写的非数值或不在1到10之间！');location.href='sorts.php?title=sorts&list=view';</script>";
	}
}

function RankTagByNum($tag_rank,$tag_id){
	if(is_numeric($tag_rank)&&$tag_rank>=1&&$tag_rank<=15){
		$sql = 'UPDATE `cd_tags` SET tag_rank = '.$tag_rank.' WHERE tag_id = '.$tag_id;
		$result = mysql_query($sql) or die(mysql_error());
		header('location:./sorts.php?title=sorts&list=view');
	}else{
		echo "<script language='javascript'>alert('填写的非数值或不在1到15之间！');location.href='sorts.php?title=sorts&list=view';</script>";
	}
}
function ChangeTerm($term_ID,$term_name){
	$sql = "UPDATE `cd_terms` SET term_name = "."'$term_name'"." WHERE term_id = ".$term_ID;
	mysql_query('set names utf8');
	$result = mysql_query($sql) or die(mysql_error());
	header('location:./sorts.php?title=sorts&list=view');
}
?>