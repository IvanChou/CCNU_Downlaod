<?php
if (isset($_REQUEST['list'])){
	switch ($_REQUEST['list']){
		case 'edit':
		$title = '修改软件信息';
		require ('./soft/edit_softs.php');
		break;
		
		case 'softadd':
		$title = '软件上传';
		require ('./soft/soft_upload.php');
		break;
		
		case 'view':
		$title = '软件管理';
		require ('./soft/view_softs.php');
		break;
		
		default:
		$title = '软件管理';
		require ('./soft/view_softs.php');
	}
} else {
	include ('../info.php');
}
?>
