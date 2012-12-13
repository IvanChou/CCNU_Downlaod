<h3><?php echo $title; ?></h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<div class="content-box-content">
<div class="tab-content default-tab" >
<form enctype='multipart/form-data' action="./soft/addsoft_process.php" method='post' id="myform" name="myform" onsubmit="return check();">
<p><img src="./resources/images/tip.gif" title="提示" /><span style="padding-left:15px;vertical-align:top;letter-spacing:1px;">提示: 带<span style="color:red;vertical-align:top;">*</span>的项目为必填信息.</span></p>
<fieldset><!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
<table>
<tr><td>上传方式<span style="color:red;vertical-align:top;">*</span></td><td><select style="width:270px;" id="add_type" name="add_type" onchange="getAddType();">
<option value="http" selected="selected">普通方式上传(软件小于200M)</option>
<option value="ftp">FTP方式上传(大软件)</option>
</select></td>
<td><span id="choose_soft">选择软件</span><span id="physical_name" style="display:none;">物理名称</span><span style="color:red;vertical-align:top;">*</span></td><td><input type="file" id="http_add" name="upload" /><input type="text" name="ftpsoftname" id="ftpsoftname" class="text-input small-input" style="width:270px !important;display:none;" value="<?php if(isset($_POST['ftpsoftname'])) echo $_POST['ftpsoftname']; ?>" /></td>
</tr>
<tr><td>软件类别<span style="color:red;vertical-align:top;">*</span></td>
<td>
<?php
$sql = "select * from `cd_terms` order by term_rank ASC";
mysql_query("set names utf8");
$result = mysql_query($sql) or die(mysql_error());
?>   
<select name="firstmenu" class="small-input" style="width:134px !important;" id="firstmenu" onchange="getSecondMenus();">
<option selected="selected" value="">请选择一级栏目</option>
<?php
while($row=mysql_fetch_assoc($result)){
	echo "<option value='".$row['term_id']."'>".$row['term_name']."</option>";
}
?>
</select>
<select name="secondmenu" class="small-input" style="width:134px !important;" id="secondmenu">
<option value="">未指定一级栏目</option>
</select>
</td>
<td>软件图标</td>
<td>
<input type="file" name="soft_pic" id="soft_pic" onchange="previewImage(this)"/>
<div id="preview"><img id="imghead" width='0' height='0' src='' /></div>
</td>
</tr>
<tr><td>
软件名称<span style="color:red;vertical-align:top;">*</span></td><td><input class="text-input small-input" type="text" id="soft_name" name="soft_name" style="width:258px !important;" value="<?php if(isset($_POST['soft_name'])) echo $_POST['soft_name']; ?>" /></td>
<td>运行平台<span style="color:red;vertical-align:top;">*</span></td>
<td>Win<input type="checkbox" value="1" name="soft_os[]" checked="checked"/>&nbsp;
Linux<input type="checkbox" value="2" name="soft_os[]"/>&nbsp;
Mac OS<input type="checkbox" value="3" name="soft_os[]"/>&nbsp;
Android<input type="checkbox" value="4" name="soft_os[]"/>
</td></tr>

<tr><td colspan='4'>
<?php
include('./FCKeditor/fckeditor.php');
$sBasePath = $_SERVER['PHP_SELF'] ;
$oFCKeditor = new FCKeditor('desc');//实例化 
$oFCKeditor->BasePath = './FCKeditor/';//这个路径一定要和上面那个引入路径一致
$oFCKeditor->Width = '100%'; 
$oFCKeditor->Height = '250';
$oFCKeditor->ToolbarSet = 'Default';//工具按钮
echo $oFCKeditor->Create();
?>
</td></tr>
<tr><td colspan='4'>
<input class="button" type="submit" name="submit" value="提交" style="margin-right:15px;"/><a href="index.php?title=soft&list=view" class="button" style="height:16px; line-height:16px;">取消</a></td></tr></table>
								
</fieldset>
							
<div class="clear"></div><!-- End .clear -->
</form>
</div> <!-- End #tab2 -->
<script type="text/javascript" src="./resources/scripts/previewImage.js"></script>
<script type="text/javascript" src="./resources/scripts/getAddType.js"></script>
<script type="text/javascript" src="./resources/scripts/getSecondSort.js"></script>
<script type="text/javascript" src="./resources/scripts/addCheck.js"></script>
<script language="javascript">
document.getElementById('soft_name').focus();
</script>	