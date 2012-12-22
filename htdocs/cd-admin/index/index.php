<?php
if (isset($_REQUEST['list'])){
	switch ($_REQUEST['list']){
		case 'view':
		require_once ('./index/show.php');
		break;
		
		default:
		require_once ('./index/show.php');
	}
} else {
	include ('./info.php');
}
?>