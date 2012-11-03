<?php
if (isset($_REQUEST['list'])){
	if ($_SESSION['USERNAME']=='cd_admin'){
		switch ($_REQUEST['list']){
		case 'view':
		$title = '用户管理';
		require ('view_users.php');
		break;
		
		case 'add':
		$title = '管理员添加';
		require ('add_users.php');
		break;
		
		default:
		$title = '用户管理';
		require ('view_users.php');
		}
	}else{
		switch ($_REQUEST['list']){
		case 'view':
		$title = '用户管理';
		require ('view_users.php');
		break;
		
		case 'add':
		echo '<span style="color:red;">请求错误！</span>';
		break;
		
		default:
		$title = '用户管理';
		require ('view_users.php');
		}
	}
}else{
	include ('./info.php');
}
?>