<?php
require_once ('./includes/mysql_connect.php');
logincheck();
?>

<?php
include ('./includes/header.html');
?>

<?php
require_once ('./includes/menu.php');
?>

<?php
if (isset($_REQUEST['list'])){
	switch ($_REQUEST['list']){
		case 'view':
		require_once ('./sorts_lists.php');
		break;
		
		default:
		require_once ('./sorts_lists.php');
	}
} else {
	include ('./info.php');
}
?>

<?php
include ('./includes/footer.html');
?>