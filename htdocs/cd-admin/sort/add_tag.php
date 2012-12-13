<?php
//require_once ('./include/mysql_connect.php');
//logincheck();
if (isset($_GET['term_id'])){
	$term_id = $_GET['term_id'];
}
$sql = 'SELECT term_name FROM `cd_terms` WHERE term_id = '.$term_id;
mysql_query('set names utf8');
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);
?>
<h3>添加二级栏目</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->

<div class="content-box-content">
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<script language="JavaScript" type="text/JavaScript">
function jiaodian(){
	document.form1.term.focus();
}
</script>
<form method="post" action="./sort/transact_sorts.php" name="form1">
<table><tr><td style="font-weight:bold;">一级栏目名称</td><td><?php echo $row['term_name']; ?></td></tr>
<tr><td style="font-weight:bold;">二级栏目名称</td><td><input type="text" name="term" class="text-input small-input" /></td></tr>
<tr><td colspan='2'><input type="submit" name="action" class="button" value="添 加" style="margin-right:15px;"/><a href="index.php?title=sorts&list=view" class="button" style="height:16px; line-height:16px;">取消</a></td></tr></table>
<input type="hidden" name="tag_parent" value="<?php echo $term_id; ?>" />
</form>
</div> <!-- End #tab1 -->