<?php
define('IN_TG',true);
session_start();
require '../include/mysql_connect.php';
include '../include/Page.class.php';
?>
<table>
<thead>
<tr>
<th>管理员ID</th>
<th>管理员名称</th>
<th style="text-align:right; padding-right:80px;">操作</th>
</tr>
</thead>
						 
<tfoot>
<tr>
<td colspan="3">
<div class="bulk-actions align-left">
<?php
//仅cd-admin可以添加管理员
if ($_SESSION['USERNAME']=='cd-admin'){
	echo '<a href="index.php?title=users&list=add" class="button">添加管理员</a>';
}
?>
</div>
<div class="pagination">
<?php
//仅cd-admin登录可以查看所有管理员
if ($_SESSION['USERNAME']=='cd-admin'){
	$sql = 'SELECT ID, admin_name FROM `cd_admin`';
}else{
	$sql = 'SELECT ID, admin_name FROM `cd_admin` WHERE ID = '.$_SESSION['USERID'];
}
mysql_query("set names utf8");
$result = mysql_query($sql) or die(mysql_error());
$total=mysql_num_rows($result);
$num=5;
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
if ($_SESSION['USERNAME']=='cd-admin'){
	$sql2 = "SELECT ID, admin_name FROM `cd_admin` {$page->limit};";
}else{
	$sql2 = 'SELECT ID, admin_name FROM `cd_admin` WHERE ID = '.$_SESSION['USERID']." {$page->limit}";
}
mysql_query("set names utf8");
$result2 = mysql_query($sql2) or die(mysql_error());
$i=1;
while ($row = mysql_fetch_assoc($result2)) {
	extract($row);
	echo "<tr class='"?><?php if($i%2==1) echo 'alt-row';echo "'"; echo ">";?>
	<?php
    echo '<td>' . htmlspecialchars($ID) . '</td>';
    echo '<td>' . htmlspecialchars($admin_name) . '</td>';
	if ($_SESSION['USERNAME']=='cd-admin'){
		echo '<td style="text-align:right;padding-right:50px;">'.'<a href="index.php?title=users&list=edit&id='.$ID.'">修改密码</a>'.' <a href="./user/transact_users.php?action=del&id='.$ID.'" onClick="return HTMerDel();">删除</a>'; 
	}else{
		echo '<td style="text-align:right;padding-right:80px;">'.'<a href="index.php?title=users&list=edit&id='.$ID.'">修改密码</a>'; 
	}
    echo '</td></tr>';
	$i++;
} 
mysql_free_result($result);
?>
</tbody>
</table>
