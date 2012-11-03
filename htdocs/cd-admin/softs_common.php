<?php
if (isset($_REQUEST['list'])){
	switch ($_REQUEST['list']){
		case 'httpadd':
		$title = 'HTTP上传';
		require ('add_softs.php');
		break;
		
		case 'ftpadd':
		$title = 'FTP上传';
		require ('ftp_upload.php');
		break;
		
		case 'view':
		$title = '软件管理';
		require ('view_softs.php');
		break;
		
		default:
		$title = '软件管理';
		require ('view_softs.php');
	}
} else {
	include ('./info.php');
}
?>
