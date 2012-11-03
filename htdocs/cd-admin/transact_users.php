<?php
require_once ("./includes/mysql_connect.php");
require('users_functions.php');
//header("content-type:text/html; charset=utf-8");
if (isset($_REQUEST['action'])) {

    switch ($_REQUEST['action']) {
    case 'logout':
        session_start();
        session_unset();
        session_destroy();
        //header("location:./login.php");
		$url = "login.php";
        echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
        break;

    case '添加':
        $admin_name = (isset($_POST['name'])) ? ($_POST['name']) : '';
		$admin_pass1 = (isset($_POST['pass1'])) ? ($_POST['pass1']) : '';
		$admin_pass2 = (isset($_POST['pass2'])) ? ($_POST['pass2']) : '';
		if($admin_pass1==$admin_pass2){
			AddUser($admin_name,$admin_pass1);
		}else{
		    header("content-type:text/html; charset=utf-8");
			echo "<script language='javascript'>alert('两次输入的密码不一致！');location.href='users.php?title=users&list=add';</script>";
		}
        break;

    case 'del':
	    session_start();
		$ID = (isset($_GET['id'])) ? ($_GET['id']) : '';
		if($_SESSION['USERNAME'] =='cd_admin'&& $ID != 1){
			$admin_ID = $ID;
			DeleteUser($admin_ID);
		} if( $ID ==1 ){
		    header("content-type:text/html; charset=utf-8");
			echo "<script language='javascript'>alert('删除无效！');location.href='users.php?title=users&list=view';</script>";
		}
        break;

    case '提交':
        session_start();
        $admin_pass = (isset($_POST['pass'])) ? trim($_POST['pass']) : '';
		$ID = (isset($_POST['ID'])) ? ($_POST['ID']) : '';
		ChangePassWord($ID,$admin_pass);
        break;
		
	case '取消':
	    header('location:./users.php?title=users&list=view');
        break;
		
   default:
       header('location:users.php?title=users&list=view');
    }
}
?>