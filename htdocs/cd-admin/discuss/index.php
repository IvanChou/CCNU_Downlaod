<?php
if (isset($_REQUEST['list'])){
	switch ($_REQUEST['list']){
		case 'view':
		$title = '评论管理';
		require ('./discuss/view_discuss.php');
		break;
		
		default:
		$title = '评论管理';
		require ('./discuss/view_disscuss.php');
	}
} else {
	include ('./info.php');
}
?>
