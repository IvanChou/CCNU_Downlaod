<?php
header('Content-Type:text/html;Charset=utf-8');
define('IN_TG',true);
require '../include/mysql_connect.php';
include '../include/Page.class.php';
?>
<form method="post" action="./discuss/del_selected.php">
<table>
<thead>
<tr>
<th><input class="check-all" type="checkbox" /></th>
<th>软件名称</th>
<th>用户名</th>
<th>评论</th>
<th style="text-align:right; padding-right:80px;">操作</th>
</tr>
</thead>
						 
<tfoot>
<tr>
<td colspan="5">
<div class="bulk-actions align-left">
<input type="submit" class="button" name="submit" value="删除" onclick="return HTMerDel2();"/>
</div>
<div class="pagination">
<?php
$query = "SELECT s.soft_name,com.com_id,com.user_name,com.com_text FROM `cd_softs` s ,`cd_comments` com WHERE s.ID = com.soft_id order by com.com_id;";
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
$sql2 = "SELECT s.soft_name,com.com_id,com.user_name,com.com_text FROM `cd_softs` s ,`cd_comments` com WHERE s.ID = com.soft_id order by com.com_id {$page->limit};";
mysql_query("set names utf8");
$result2 = mysql_query($sql2) or die(mysql_error());
$i=1;
while ($row = mysql_fetch_assoc($result2)) {
	$Com_Id = $row['com_id'];
	$Com_Text = $row['com_text'];
	extract($row);
	echo "<tr class='"?><?php if($i%2==1) echo 'alt-row';echo "'"; echo ">";?>
	<?php
	echo '<td><input type="checkbox" name="check[]" value="'.$Com_Id.'"/></td>';
	echo '<td>'.htmlspecialchars($soft_name).'</td>';
	echo '<td>'.htmlspecialchars($user_name).'</td>';
	echo '<td width="350px">'.$Com_Text.'</td>';
	echo '<td style="text-align:center;">'." <a href='./discuss/del_discuss.php?com_id=$Com_Id' onClick='return HTMerDel();'>删除</a>"; 
	echo '</td></tr>';
	$i++;
} 
?>
</tbody>
</table>
</form>
