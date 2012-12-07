<h3><?php echo $title; ?></h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<script language="javascript">
function jiaodian(){
	var esrc = document.forms["form1"].elements["name"];
	if(navigator.userAgent.indexOf("MSIE")>0){
		if(esrc==null){
		esrc=event.srcElement;
		}
		var rtextRange =esrc.createTextRange();
		rtextRange.moveStart('character',esrc.value.length); 
        rtextRange.collapse(true); 
        rtextRange.select();
	}else{ 
		var rtextRange = esrc.setSelectionRange(esrc.value.length,esrc.value.length);
		esrc.focus();
	}
}
</script>		
<div class="content-box-content">
<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
<form action="transact_users.php" method="post" id="form1">
<table>
<tr>
<td>管理员名称&nbsp;<input type="text" name="name" id="name"/></td>
</tr>
<tr>
<td>管理员密码&nbsp;<input type="password" name="pass1"/></td>
</tr>
<tr>
<td><span style="letter-spacing:4px;">确认密码</span><input type="password" name="pass2"/></td>
</tr>
<tr>
<td><input type="submit" name="action" value="添加" class="button" style="margin-right:15px;"/><input type="submit" name="action" value="取消" class="button"/></td>
</tr>
</table>
</form>
</div> <!-- End #tab1 -->