<?php
define('IN_TG',true);
define('BASEPATH',true);
require_once ('../../../application/config/home.php');
require '../include/mysql_connect.php';
include '../include/Page.class.php';
?>
<table style="white-space:nowrap;">
<thead>
<tr style="background:#f3f3f3;">
<th><input class="check-all" type="checkbox" /></th>
<th>序号</th>
<th>软件名称</th>
<th>有效</th>
<th>图标</th>
</tr>
</thead>
						 
<tfoot>
<tr>
<td colspan="5">								
<div class="pagination" style="text-align:center;">
<?php
$query = "SELECT s.ID,s.soft_name,s.term_id,s.soft_url,s.soft_size,s.downer_top_count,s.downer_down_count,te.term_name,ta.tag_name FROM `cd_softs` s,`cd_terms` te, `cd_tags` ta WHERE s.term_id = te.term_id AND s.tag_id = ta.tag_id AND te.term_id = ta.tag_parent order by ID;";
mysql_query("set names utf8");
$result = mysql_query($query) or die(mysql_error());
$total=mysql_num_rows($result);
$num=10;
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
	echo "<tr style='"?><?php if($i%2==1) echo 'background:#fff;';else echo 'background:#f3f3f3;';echo "'"; echo ">";?>
	<?php
	if($home['often'][0]==$ID||$home['often'][1]==$ID||$home['often'][2]==$ID){
		echo '<td><input type="checkbox" checked="checked" name="check[]" value="'.$ID.'"/></td>';
	}else{
		echo '<td><input type="checkbox" name="check[]" value="'.$ID.'"/></td>';
	}
	echo '<td>'.$ID.'</td>';
	echo '<td><a href="'.$soft_url.'">'.$soft_name.'</a></td>';
	echo '<td>'.$sta.'</td>';
	echo '<td>'.$imgsta.'</td></tr>';
	$i++;
} 
?>
</tbody>
</table>