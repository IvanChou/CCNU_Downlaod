<?php
define('IN_TG',true);
require ('./include/mysql_connect.php');
logincheck();
include ('./include/header.html');
require ('./include/menu.php');
require ('./control.php');
include ('./include/footer.html');
?>