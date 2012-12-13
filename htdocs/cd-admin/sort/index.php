<?php
if (isset($_REQUEST['list'])){
	switch ($_REQUEST['list']){
		case 'view':
		require_once ('./sort/sorts_lists.php');
		break;
		
		case 'addtag';
		require_once ('./sort/add_tag.php');
		break;
		
		case 'editterm';
		require_once ('./sort/edit_term.php');
		break;
		
		case 'edittag';
		require_once ('./sort/edit_tag.php');
		break;
		
		default:
		require_once ('./sort/sorts_lists.php');
	}
} else {
	include ('./info.php');
}
?>