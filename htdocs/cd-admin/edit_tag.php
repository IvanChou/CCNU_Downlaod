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
if (isset($_GET['tag_id'])){
	$tag_id = $_GET['tag_id'];
}
$sql = 'SELECT ta.tag_name,ta.tag_rank,te.term_name,te.term_id FROM `cd_tags` ta,`cd_terms` te WHERE te.term_id = ta.tag_parent AND tag_id = '.$tag_id;
mysql_query('set names utf8');
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);

$sql2 = 'SELECT te.term_name,te.term_id FROM `cd_terms` te WHERE te.term_id !='.$row['term_id'];
$result2 = mysql_query($sql2) or die(mysql_error());
?>
<h3>修改二级栏目</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<script language="javascript">
function jiaodian(){
	var esrc = document.forms["form1"].elements["term"];
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
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<form method="post" action="transact_sorts.php" id="form1">
<p>一级栏目名称：
<select name="term_first">
<?php 
echo "<option value='".$row['term_id']."'>".$row['term_name']."</option>";
while($row2 = mysql_fetch_assoc($result2)){
	echo "<option value='".$row2['term_id']."'>".$row2['term_name']."</option>";
}
?>
</select>
</p>
<br/>
<p>二级栏目名称：<input type="text" name="term" class="" value ="<?php echo $row['tag_name']; ?>"/></p>
<br/>
<p><input type="submit" name="action" class="button" value="修改二级栏目" style="margin-right:8px;" /><input type="submit" name="action" class="button" value="取消" /></p>
<input type="hidden" name="tag_id" value="<?php echo $tag_id; ?>" />
</form>
</div> <!-- End #tab1 -->

<?php
include ('./includes/footer.html');
?>