<?php
if (isset($_REQUEST['list'])){
	if ($_SESSION['USERNAME']=='cd-admin'){
		switch ($_REQUEST['list']){
		case 'view':
		$title = '用户管理';
		require ('./user/view_users.php');
		break;
		
		case 'add':
		$title = '管理员添加';
		require ('./user/add_users.php');
		break;
		
		case 'edit':
		$title = '管理员密码修改';
		require ('./user/edit_users.php');
		break;
		
		default:
		$title = '用户管理';
		require ('./user/view_users.php');
		}
	}else{
		switch ($_REQUEST['list']){
		case 'view':
		$title = '用户管理';
		require ('./user/view_users.php');
		break;
		
		case 'edit':
		$title = '管理员密码修改';
		require ('./user/edit_users.php');
		break;
		
		case 'add':
		echo '<span style="color:red;">请求错误！</span>';
		break;
		
		default:
		$title = '用户管理';
		require ('./user/view_users.php');
		}
	}
}else{
	include ('./info.php');
}
?>