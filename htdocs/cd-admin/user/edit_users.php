<?php
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
<form action="./user/transact_users.php" method="post">
<table><tr><td style="font-weight:bold;">管理员名称</td><td><?php echo $admin_name; ?></td></tr>
<tr><td style="font-weight:bold;">管理员密码</td><td><input style="color:#888;" type="password" id="password" name="pass" class="text-input small-input" /></td></tr>
<input type="hidden" name="ID" value="<?php echo $ID; ?>" />
<tr><td colspan='2'><input type="submit" name="action" value="提交" class="button" style="margin-right:12px;"/><input type="submit" name="action" value="取消" class="button"/></td></tr></table>
</form>
<?php
}
?>
</div> <!-- End #tab1 -->
<script language="javascript">
<!--
document.getElementById('password').focus();
-->
</script>