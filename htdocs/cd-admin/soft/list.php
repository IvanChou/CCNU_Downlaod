<?php
define('IN_TG',true);
require '../include/mysql_connect.php';
include '../include/Page.class.php';
?>
<form method="post" action="./soft/del_selected_softs.php" name="myform">
<table style="white-space:nowrap;">
<thead>
<tr>
<th><input class="check-all" type="checkbox" /></th>
<th>序号</th>
<th>软件名称</th>
<th>一级分类</th>
<th>二级分类</th>
<th>有效</th>
<th>图标</th>
<th>大小</th>
<th>顶</th>
<th>踩</th>
<th style="text-align:center;">操作</th>
</tr>
</thead>
						 
<tfoot>
<tr>
<td colspan="11">
<div class="bulk-actions align-left">
<input type="submit" class="button" name="submit" value="删除" onclick="return HTMerDel2();"/>
</div>
										
<div class="pagination">
<?php
$query = "SELECT s.ID,s.soft_name,s.term_id,s.soft_url,s.soft_size,s.downer_top_count,s.downer_down_count,te.term_name,ta.tag_name FROM `cd_softs` s,`cd_terms` te, `cd_tags` ta WHERE s.term_id = te.term_id AND s.tag_id = ta.tag_id AND te.term_id = ta.tag_parent order by ID;";
mysql_query("set names utf8");
$result = mysql_query($query) or die(mysql_error());
$total=mysql_num_rows($result);
$num=15;
$page=new Page($total, $num);
echo $page->fpage(array(3,4,5,6,7,0,1,2,8));
?>
</div> <!-- End .pagination -->

<div class="clear"></div>
</td>
</tr>
</tfoot>
<tbody>
<?php
$sql = "SELECT s.ID,s.soft_name,s.term_id,s.soft_url,s.soft_size,s.downer_top_count,s.downer_down_count,te.term_name,ta.tag_name FROM `cd_softs` s,`cd_terms` te, `cd_tags` ta WHERE s.term_id = te.term_id AND s.tag_id = ta.tag_id AND te.term_id = ta.tag_parent order by ID {$page->limit};";
mysql_query("set names utf8");
$i=1;
$result = mysql_query($sql) or die(mysql_error());
while ($row = mysql_fetch_assoc($result)) {
	extract($row);
	$folder_name = "../../";
	$softname = "SELECT soft_url as softname FROM `cd_softs` WHERE ID =".$ID;
	$softresult = mysql_query($softname) or die(mysql_error());
	$num = mysql_num_rows($softresult);
	$softrow = mysql_fetch_assoc($softresult);
	if($num != 0 && file_exists($folder_name.$softrow['softname'])){
		$sta = '<span style="padding-left:10px;">是</span>';
	}else{
		$sta = '<span style="color:red;padding-left:10px;">否</span>';
	}
	$softimg = "SELECT soft_img as softimg FROM `cd_softs` WHERE ID =" .$ID;
	$imgresult = mysql_query($softimg) or die(mysql_error());
	$num2 = mysql_num_rows($imgresult);
	$imgrow = mysql_fetch_assoc($imgresult);
	if($num2 != 0 && file_exists($folder_name.$imgrow['softimg'])&& $imgrow['softimg'] !=''){
		$imgsta = '<span style="padding-left:10px;">有</span>';
	}else{
		$imgsta = '<span style="color:red;padding-left:10px;">无</span>';
	}
	$url = $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
	$soft_url = 'http://'.$url.'/'.$soft_url;
	echo "<tr class='"?><?php if($i%2==1) echo 'alt-row';echo "'"; echo ">";?>
	<?php
	echo '<td><input type="checkbox" name="check[]" value="'.$ID.'"/></td>';
	echo '<td>'.$ID.'</td>';
	echo '<td><a href="'.$soft_url.'">'.$soft_name.'</a></td>';
	echo '<td>'.$term_name.'</td>';
	echo '<td>'.$tag_name.'</td>';
	echo '<td>'.$sta.'</td>';
	echo '<td>'.$imgsta.'</td>';
	if ($soft_size>=1024&&$soft_size<=1048576){
		$soft_size = $soft_size /1024;
		$soft_size = round($soft_size,1);
		$soft_size = $soft_size.'KB';
	}
	elseif($soft_size>1048576&&$soft_size<1073741824){
		$soft_size = $soft_size /1048576;
		$soft_size = round($soft_size,1);
		$soft_size = $soft_size.'MB';
	}
	elseif($soft_size<1024){
		$soft_size = round($soft_size,1);
		$soft_size = $soft_size.'B';
	}
	else{
		$soft_size = $soft_size /1073741824;
		$soft_size = round($soft_size,1);
		$soft_size = $soft_size.'GB';
	}
	echo '<td>'.$soft_size.'</td>';
	echo '<td>'.$downer_top_count.'</td>';
	if($downer_down_count>15){
		$downer_down_count = '<span style="color:red;">'.$downer_down_count.'</span>';
	}
	echo '<td>'.$downer_down_count.'</td>';
	echo '<td style="text-align:center;">'."<a href='./index.php?title=soft&amp;list=edit&amp;softid=$ID'>修改</a> "." <a href='./soft/del_softs.php?softid=$ID' onClick='return HTMerDel();'>删除</a>"; 
	echo '</td></tr>';
	$i++;
} 
?>
</tbody>
</table>
</form>