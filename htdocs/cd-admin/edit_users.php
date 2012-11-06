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
//require_once ("./includes/mysql_connect.php");
if (isset($_GET['id'])){
	$ID = $_GET['id'];
}
?>
<h3>修改管理员密码</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
				
<div class="content-box-content">
<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
<?php
//if ($_SESSION['USERNAME']=='cd-admin'){
//	$sql = 'SELECT * FROM `cd_admin`;';
//} else{
//	$sql = 'SELECT * FROM `cd_admin` WHERE ID = '.$_SESSION['USERID'];
//}
$sql = 'SELECT * FROM `cd_admin` WHERE ID = '.$ID;
$result = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_assoc($result)){
	extract($row);
?>

<form action="transact_users.php" method="post">
<p>管理员名称：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $admin_name; ?></p>
<p>管理员密码：&nbsp;&nbsp;&nbsp;&nbsp;<input style="color:#888;" type="text" name="pass" value="请输入新的密码…" onclick="this.value='';" onblur = "this.value = this.value =='' ? '请输入新的密码…' : this.value" /></p>
<input type="hidden" name="ID" value="<?php echo $ID; ?>" />
<p><input type="submit" name="action" value="提交" class="button" style="margin-right:12px;"/><input type="submit" name="action" value="取消" class="button"/></p>
</form>
<?php
}
?>
</div> <!-- End #tab1 -->
<?php
include ('./includes/footer.html');
?>