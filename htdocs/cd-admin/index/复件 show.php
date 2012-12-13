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
</td></tr>
<tr style="background:#fff;"><td style="font-weight:bold;background:#f3f3f3;">装机必备</td>
<td>
<table style="white-space:nowrap;">
<thead>
<tr>
<th><input class="check-all" type="checkbox" /></th>
<th>序号</th>
<th>一级栏目</th>
<th colspan='2'>软件</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT  te.term_id,te.term_name,te.term_rank FROM `cd_terms` te ORDER BY term_rank ASC,term_id DESC;";
mysql_query("set names utf8");
$result = mysql_query($sql) or die(mysql_error());
$y = 1;
while ($row = mysql_fetch_assoc($result)) {
	extract($row);
	echo "<tr style='"?><?php if($y%2==0) echo 'background:#fff;';echo "'"; echo ">";?>
	<?php
	if($home['need_title'][0]==$term_name||$home['need_title'][1]==$term_name||$home['need_title'][2]==$term_name||$home['need_title'][3]==$term_name||$home['need_title'][4]==$term_name||$home['need_title'][5]==$term_name){
		echo '<td><input type="checkbox" name="check2[]" checked="checked" value="'.$term_id.'"/></td>';
	}else{
		echo '<td><input type="checkbox" name="check2[]" value="'.$term_id.'"/></td>';
	}
	echo '<td>'.$term_id.'</td>';
	$i=0;
	//判断一级栏目下面是否有软件（当软件和数据库记录配对时才会显示"有"，仅数据有记录或是文件有软件时都会显示"无"）
	$softname = "SELECT soft_url as softname FROM `cd_softs` WHERE term_id =".$row['term_id'];
	$softresult = mysql_query($softname) or die(mysql_error());
	$num = mysql_num_rows($softresult);
	while($softrow = mysql_fetch_assoc($softresult)){
		if($num != 0 && file_exists('../'.$softrow['softname'])&&$softrow['softname']!=''){
			$i++;
		}
	}
	if($i==0){
		$status = '<span style="color:red;">无</span>';
	}else{
		$status = '<span>有</span>';
	}
	if($i==0){
		echo '<td colspan="2">'.'<span style="font-weight:bold;">'.$term_name.'</span></td>';
	}else{
		echo '<td>'.'<span style="font-weight:bold;">'.$term_name.'</span></td>';
	}
	if($i!=0){
		$sql2 = 'SELECT ID,soft_name FROM cd_softs WHERE term_id ='.$row['term_id'];
		mysql_query("set names utf8");
		$result2 = mysql_query($sql2) or die(mysql_error());
		echo '<td>';
		$t=1;
		while($row2=mysql_fetch_assoc($result2)){
			if($home['need'][0][0]==$row2['ID']||$home['need'][0][1]==$row2['ID']||$home['need'][0][2]==$row2['ID']||$home['need'][0][3]==$row2['ID']||$home['need'][0][4]==$row2['ID']||$home['need'][1][0]==$row2['ID']||$home['need'][1][1]==$row2['ID']||$home['need'][1][2]==$row2['ID']||$home['need'][1][3]==$row2['ID']||$home['need'][1][4]==$row2['ID']||$home['need'][2][0]==$row2['ID']||$home['need'][2][1]==$row2['ID']||$home['need'][2][2]==$row2['ID']||$home['need'][2][3]==$row2['ID']||$home['need'][2][4]==$row2['ID']||$home['need'][3][0]==$row2['ID']||$home['need'][3][1]==$row2['ID']||$home['need'][3][2]==$row2['ID']||$home['need'][3][3]==$row2['ID']||$home['need'][3][4]==$row2['ID']||$home['need'][4][0]==$row2['ID']||$home['need'][4][1]==$row2['ID']||$home['need'][4][2]==$row2['ID']||$home['need'][4][3]==$row2['ID']||$home['need'][4][4]==$row2['ID']||$home['need'][5][0]==$row2['ID']||$home['need'][5][1]==$row2['ID']||$home['need'][5][2]==$row2['ID']||$home['need'][5][3]==$row2['ID']||$home['need'][5][4]==$row2['ID']){
				echo '<input type="checkbox" name="check3[]" checked="checked" value="'.$row2['ID'].'"/>';
				echo $row2['soft_name'].'&nbsp;&nbsp;&nbsp;';
			}else{
				echo '<input type="checkbox" name="check3[]" value="'.$row2['ID'].'"/>';
				echo $row2['soft_name'].'&nbsp;&nbsp;&nbsp;';
			}
			if($t%3==0){
				echo '<br />';
			}
			$t++;
		}
		echo '</td>';
	}
	echo "<td>$status</td></tr>";
	$y++;
}
?>
</tbody>
</table>
</td></tr>
<tr><td colspan='2'><input type="submit" value="修改" class="button" style="margin-right:8px;"/><input type="reset" value="取消" class="button" /></td></tr>
</table>
</form>
</div> <!-- End #tab1 -->