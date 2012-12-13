<?php
if (isset($_GET['softid'])){
	$softid = $_GET['softid'];
}
$sql = 'SELECT s.soft_name,s.soft_img,s.soft_url as softname,s.soft_size,te.term_id,te.term_name,ta.tag_id,ta.tag_name,s.soft_description,s.soft_os FROM `cd_softs` s,`cd_terms` te,`cd_tags` ta WHERE s.term_id = te.term_id AND s.tag_id = ta.tag_id AND te.term_id = ta.tag_parent AND s.ID ='.$softid;
mysql_query('set names utf8');
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);
?>
<h3><?php echo $title;?></h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<script language="javascript">
<!--
function jiaodian(){
	var esrc = document.forms["myform"].elements["softnameedit"];
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
-->
</script>
<div class="content-box-content">
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<form method="post" action="./soft/edit_softsPro.php?softid=<?php echo $softid; ?>" name="myform" enctype='multipart/form-data'>
<table><tr><td>软件名称</td><td colspan='3'>
<input type="text" class="text-input small-input" id="softnameedit" name="softnameedit" value="<?php echo $row['soft_name']; ?>" style="width:250px !important;"/>
<input type="hidden" name="softname2" value="<?php echo $row['softname']; ?>" />
</td>

<td>运行平台</td>
<td colspan='3'><input type="text" class="text-input small-input" name="softos" value="<?php echo $row['soft_os']; ?>" style="width:190px !important;"/>
</td></tr>

<tr><td>软件类别</td>
<td colspan='3'>
<?php
$sql = "select * from `cd_terms` where term_id !=".$row['term_id'];
$query = mysql_query($sql) or die(mysql_error());
$sql3 ="select term_name,term_id from `cd_terms` where term_id =".$row['term_id'];
$query3 = mysql_query($sql3) or die(mysql_error());
$row3 = mysql_fetch_assoc($query3);
?>   
<select name="firstmenu" class="small-input" style="width:134px !important;" id="firstmenu" onchange="getSecondMenus();">
<option selected="selected" value="<?php echo $row3['term_id'];?>"><?php echo $row3['term_name'];?></option>
<?php
while($field=mysql_fetch_assoc($query)){
	$sql2 = 'select tag_id from `cd_tags` where tag_parent ='.$field['term_id'];
	$query2 = mysql_query($sql2);
	echo "<option value='".$field['term_id']."'>".$field['term_name']."</option>";
}
$sql5 = 'select tag_name,tag_id from `cd_tags` where tag_id = '.$row['tag_id'];
$query5 = mysql_query($sql5) or die(mysql_error());
$row5 = mysql_fetch_assoc($query5);
$sql4 = 'select tag_name,tag_id from `cd_tags` where tag_parent = '.$row['term_id'].' and tag_id != '.$row['tag_id'];
$query4 = mysql_query($sql4) or die(mysql_error());
?>
</select>
<select name="secondmenu" class="small-input" style="width:134px !important;" id="secondmenu">
<option value="<?php echo $row5['tag_id'];?>" selected="selected"><?php  echo $row5['tag_name']; ?></option>
<?php
while($row4 = mysql_fetch_assoc($query4)){
?>
<option value="<?php echo $row4['tag_id']; ?>"><?php  echo $row4['tag_name']; ?></option>
<?php
}
?>
</select>
<input type="hidden" value="<?php echo $row3['term_id']; ?>" name="oldterm" />
</td>

<td>物理名称</td>
<td colspan='3'>
<?php
$truesoftname = split("/",$row['softname']);
$file_extend = split("\.|/",$row['softname']);
if (strlen($file_extend[2])==19){
	echo $truesoftname[2];
	echo "<input type='hidden' value='".$truesoftname[2]."' name='softname' />";
}else{
?>
<input type="text" class="text-input small-input" value="<?php echo date("YmdHis").'_'.rand(1000,9999).'.'.$file_extend[3]; ?>" name="softname" style="width:190px !important;" />
<?php	
}
?>
</td></tr>

<tr><td>软件图标</td><td>
<?php
if(file_exists('../'.$row['soft_img'])&&$row['soft_img']!=''){
?>
<img src="<?php echo '../'.$row['soft_img']; ?>" width="90" height="90" alt="缩略图" style="border:1px solid #CC9;"/>
<?php
}else{
	echo "<span style='color:red;border:1px solid #CC9;line-height:34px;letter-spacing:3px;'>无缩略图</span>";
}
?>
</td>
<td>
<?php
$sql10 = "select soft_img from `cd_softs` where ID =".$softid;
$result10 = mysql_query($sql10) or die(mysql_error());
$row10 = mysql_fetch_assoc($result10);
if(file_exists('../'.$row10['soft_img'])&&$row10['soft_img']!=''){
	echo '更改图标';
}else{
	echo '上传图标';
}
?></td><td style="width:230px;">
<input type="file" name="upload" onchange="previewImage(this)"/>
<div id="preview" style="float:right;"><img id="imghead" width='0' height='0' src='' /></div>
</td>
<td>软件大小</td><td>
<?php
if ($row['soft_size']>=1024&&$row['soft_size']<=1048576){
		$row['soft_size'] = $row['soft_size'] /1024;
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'KB.B.MB.GB';
	}
	elseif($row['soft_size']>1048576&&$row['soft_size']<1073741824){
		$row['soft_size'] = $row['soft_size'] /1048576;
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'MB.B.KB.GB';
	}
	elseif($row['soft_size']<1024){
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'B.KB.MB.GB';
	}
	else{
		$row['soft_size'] = $row['soft_size'] /1073741824;
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'GB.B.KB.MB';
	}
?>
<input type="text" class="text-input small-input" name="softsize" value="<?php echo $row['soft_size']; ?>" style="width:80px !important;"/>
<?php
$liangji2 = split("\.",$liangji);
echo '<select name="softsizeliangji">';
while (list($key,$value) = each ($liangji2)){
echo "<option value='$value'>$value</option>";
}
echo '</select>';
?>
</td></tr>

<tr><td colspan='6'>
<?php
include('./FCKeditor/fckeditor.php');
$sBasePath = $_SERVER['PHP_SELF'] ;
$oFCKeditor = new FCKeditor('desc');//实例化 
$oFCKeditor->BasePath = './FCKeditor/';//这个路径一定要和上面那个引入路径一致
$oFCKeditor->Width = '100%'; 
$oFCKeditor->Height = '250';
$oFCKeditor->Value = "{$row['soft_description']}";
$oFCKeditor->ToolbarSet = 'Default';//工具按钮
echo $oFCKeditor->Create();
?>
</td></tr>

<tr><td colspan='6'><input type="submit" name="submit" class="button" value="修改" style="margin-right:15px;"/><a href="index.php?title=soft&list=view" class="button" style="height:16px; line-height:16px;">取消</a></td></tr></table>
<input type="hidden" value="<?php echo $softid; ?>" name="soft_id" />
</form>
</div> <!-- End #tab1 -->
<script type="text/javascript" src="./resources/scripts/previewImage.js"></script>
<script type="text/javascript" src="./resources/scripts/getSecondSort.js"></script>