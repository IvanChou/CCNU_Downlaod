<?php
define('IN_TG',true);
require_once ("../include/mysql_connect.php");
require ('sorts_functions.php');
header("content-type:text/html; charset=utf-8");
if(!isset($_REQUEST['action'])) return;
if (isset($_REQUEST['action'])) {
	switch ($_REQUEST['action']) {
		
		case '添加':
		$term_name = (isset($_POST['term'])) ? ($_POST['term']) : '';
		$term_rank = (isset($term_rank)) ? $term_rank : 1;
		$down_count = (isset($down_count)) ? $down_count : 0;
		if(!empty($term_name)){
			AddTerm($term_name,$term_rank,$down_count);
		}else{
			echo "<script language='javascript'>alert('栏目名称为空！');location.href='../index.php?title=sorts&list=view';</script>";
		}
        break;
		
		case '添 加':
	    $tag_rank = (isset($tag_rank)) ? $tag_rank : 1;
		$tag_father = (isset($_POST['tag_parent'])) ? ($_POST['tag_parent']) : '';
		$tag_name = (isset($_POST['term'])) ? ($_POST['term']) : '';
		$down_count = (isset($down_count)) ? $down_count : 0;
		if (!empty($tag_father)&&!empty($tag_name)){
			AddTag($tag_name,$tag_rank,$tag_father,$down_count);
		}else{
			echo "<script language='javascript'>alert('二级栏目名称为空，添加失败！');location.href='../index.php?title=sorts&list=addtag&term_id=$tag_father';</script>";
		}
        break;
		
		case 'deltag':
		$tag_id = (isset($_GET['tag_id'])) ? ($_GET['tag_id']) : '';
		if(!empty($tag_id)){
			DeleteTag($tag_id);
		} else {
			echo "<script language='javascript'>alert('删除出错！');location.href='../index.php?title=sorts&list=view';</script>";
		}
        break;
		
		case '修改二级栏目':
		$tag_id = (isset($_POST['tag_id'])) ? ($_POST['tag_id']) : '';
		$tag_father = (isset($_POST['term_first'])) ? ($_POST['term_first']) : '';
		$tag_name = (isset($_POST['term'])) ? ($_POST['term']) : '';
		$tag_rank = (isset($tag_rank)) ? $tag_rank : 1;
		if(!empty($tag_id)&&!empty($tag_father)&&!empty($tag_name)){
			ChangeTag($tag_id,$tag_name,$tag_rank,$tag_father);
		}else {
			echo "<script language='javascript'>alert('修改失败！');location.href='../index.php?title=sorts&list=view';</script>";
		}
		break;
		
		case '修改一级栏目':
		$term_id = (isset($_POST['term_id'])) ? ($_POST['term_id']) : '';
		$term_name = (isset($_POST['term'])) ? ($_POST['term']) : '';
		if(!empty($term_id)&&!empty($term_name)){
			ChangeTerm($term_id,$term_name);
		}else{
			echo "<script language='javascript'>alert('修改失败！');location.href='../index.php?title=sorts&list=view';</script>";
		}
		break;
		
		case 'delterm':
		$term_id = (isset($_GET['term_id'])) ? ($_GET['term_id']) : '';
		if(!empty($term_id)){
			DeleteTerm($term_id);
		} else {
			echo "<script language='javascript'>alert('删除出错！');location.href='../index.php?title=sorts&list=view';</script>";
		}
        break;
		
		case '修 改':
		$term_rank = (isset($_POST['rank'])) ? ($_POST['rank']) : 1;
		$term_id = $_POST['term_idforrank'];
		RankTermByNum($term_rank,$term_id);
		break;
		
		case '修改':
		$tag_rank = (isset($_POST['tag_rank'])) ? ($_POST['tag_rank']) : 1;
		$tag_id = $_POST['tag_idforrank'];
		RankTagByNum($tag_rank,$tag_id);
		break;
		
		case '取消':
		header('location:../index.php?title=sorts&list=view');
		break;
		 
   default:
       header('location:../index.php?title=sorts&list=view');
    }
}
?>