<h3><?php echo $title; ?></h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->	
<div class="content-box-content">
<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
<form action="./user/transact_users.php" method="post" id="form1">
<table>
<tr>
<td style="width:100px;font-weight:bold;">管理员名称</td><td><input type="text" name="name" id="name" class="text-input small-input" /></td>
</tr>
<tr>
<td style="width:100px;font-weight:bold;">管理员密码</td><td><input type="password" name="pass1" class="text-input small-input" /></td>
</tr>
<tr>
<td style="width:100px;font-weight:bold;">确认密码</td><td><input type="password" name="pass2" class="text-input small-input" /></td>
</tr>
<tr>
<td colspan='2'><input type="submit" name="action" value="添加" class="button" style="margin-right:15px;"/><input type="submit" name="action" value="取消" class="button"/></td>
</tr>
</table>
</form>
</div> <!-- End #tab1 -->
<script language="javascript">
document.getElementById('name').focus();
</script>	