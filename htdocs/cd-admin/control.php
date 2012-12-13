<?php
if (!defined('IN_TG')) {
	exit('Access Defined!');
}
if (isset($_REQUEST['title'])){
	switch ($_REQUEST['title']){
		case 'soft':
			require './soft/index.php';
		break;
		
		case 'sorts':
			require './sort/index.php';
		break;
		
		case 'users':
			require './user/index.php';
		break;
		
		case 'discuss':
			require './discuss/index.php';
		break;
		
		case 'index':
			require './index/index.php';
		break;
	}
} else {
	include './info.php';
}
?>