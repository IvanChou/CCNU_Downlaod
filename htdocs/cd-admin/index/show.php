<?php
define('BASEPATH',true);
require_once ('../../application/config/home.php');
?>
<h3>首页显示管理</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->

<div class="content-box-content">
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<form method="post" action="./index/index_Pro.php">
<table><tr><td style="font-weight:bold;width:100px;">信息公告栏</td><td>
<?php
include('./FCKeditor/fckeditor.php');
$sBasePath = $_SERVER['PHP_SELF'] ;
$oFCKeditor = new FCKeditor('info');//实例化 
$oFCKeditor->BasePath = './FCKeditor/';//这个路径一定要和上面那个引入路径一致
$oFCKeditor->Width = '100%'; 
$oFCKeditor->Height = '210';
$oFCKeditor->Value = "{$home['notice']}";
$oFCKeditor->ToolbarSet = 'Default';//工具按钮
echo $oFCKeditor->Create();
?>
</td></tr>
<tr><td style="font-weight:bold;">常用软件</td>
<td>	
<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
数据加载中……
</div> <!-- End #tab1 -->
<script type="text/javascript" src="./resources/scripts/ajax.js"></script>	
<script type="text/javascript" src="./resources/scripts/ajax.page.often.js"></script>
<table><tr>
<?php for($s=0;$s<3;$s++){ ?>
<td style="text-align:center;"><input type="text" name="often[]" value="<?php echo $home['often'][$s]; ?>" class="text-input small-input" style="width:50px !important;"/></td>
<?php } ?>
</tr></table>
</td></tr>
<tr style="background:#fff;"><td style="font-weight:bold;background:#f3f3f3;">装机必备</td>
<td>
<table style="white-space:nowrap;">
<tr>
<?php
for($i=0;$i<6;$i++){
?>
<td><input type="text" value="<?php echo $home['need_title'][$i];?>" name="title[]" class="text-input small-input" style="width:100px !important;" />
<?php
}
?>
</tr>
<tr>
<?php
for($j=0;$j<6;$j++){
?>
<td><?php for($n=0;$n<5;$n++){ ?><input type="text" value="<?php echo $home['need'][$j][$n]?>" name="need[]" class="text-input small-input" style="width:30px !important;margin-bottom:3px;"/><br /><?php } ?></td>
<?php
}
?>
</tr>
</table>
</td></tr>
<tr><td colspan='2'><input type="submit" value="修改" class="button" style="margin-right:8px;"/><input type="reset" value="重置" class="button" /></td></tr>
</table>
</form>
</div> <!-- End #tab1 -->