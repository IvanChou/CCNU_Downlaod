<?php
function AddUser($admin_name,$admin_pass){
	if (!empty($admin_name) && !empty($admin_pass)) {
	    $admin_pass = md5($admin_pass);
		$sql = "INSERT INTO `cd_admin` (admin_name,admin_pass) VALUES ('$admin_name','$admin_pass')";
		mysql_query("set names utf8");
		$result = mysql_query($sql) or die(mysql_error());
		if ($result){
			header('location:users.php?title=users&list=view');
		} else {
		    header("content-type:text/html; charset=utf-8");
			echo "<script language='javascript'>alert('添加管理员失败！');location.href='users.php?title=users&list=add';</script>";
		}
    } else {
	        header("content-type:text/html; charset=utf-8");
			echo "<script language='javascript'>alert('填写管理员信息错误！');location.href='users.php?title=users&list=add';</script>";
		}
}

function ChangePassWord($admin_ID,$admin_pass){
		if (!empty($admin_ID) && !empty($admin_pass)) {
			$sql = 'UPDATE `cd_admin` SET admin_pass = "'.md5($admin_pass).'" WHERE ID = '.$admin_ID;
			mysql_query("set names utf8");
		    $result= mysql_query($sql) or die (mysql_error());
		    if($result){
			    header("content-type:text/html; charset=utf-8");
				echo "<script language='javascript'>alert('密码修改成功！');location.href='users.php?title=users&list=view';</script>";
			}else{
			    header("content-type:text/html; charset=utf-8");
				echo "<script language='javascript'>alert('密码修改失败！');location.href='edit_users.php?id=$admin_ID';</script>";
			}
        }else{
		    header("content-type:text/html; charset=utf-8");
			echo "<script language='javascript'>alert('密码为空，修改失败！');location.href='edit_users.php?id=$admin_ID';</script>";
		}
}

function DeleteUser($admin_ID){
	if(!empty($admin_ID)){
		$sql = 'DELETE FROM `cd_admin` WHERE ID = '.$admin_ID;
		$result= mysql_query($sql) or die (mysql_error());
		if($result){
			header('location:users.php?title=users&list=view');
		}else{
		    header("content-type:text/html; charset=utf-8");
			echo "<script language='javascript'>alert('删除失败！');location.href='users.php?title=users&list=view';</script>";
		}
	}else{
	    header("content-type:text/html; charset=utf-8");
	    echo "<script language='javascript'>alert('删除失败！');location.href='users.php?title=users&list=view';</script>";
	}
}

?>