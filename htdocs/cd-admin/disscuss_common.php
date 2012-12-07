<?php
if (isset($_REQUEST['list'])){
	switch ($_REQUEST['list']){
		case 'discuss':
		$title = '评论管理';
		require ('view_discuss.php');
		break;
		
		default:
		$title = '评论管理';
		require ('view_disscuss.php');
	}
} else {
	include ('./info.php');
}
?>
