<script language="JavaScript" type="text/JavaScript">
function HTMerDel()
{
	if(confirm("确定删除该管理员？"))
    return true;
    else
    return false;
}
</script>
<h3><?php echo $title; ?></h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
				
<div class="content-box-content">
<div class="tab-content default-tab"> <!-- This is the target div. id must match the href of this div's tab -->
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
<td colspan="6">
<div class="bulk-actions align-left">
<?php
//仅cd-admin可以添加管理员
if ($_SESSION['USERNAME']=='cd-admin'){
	echo '<a href="users.php?title=users&list=add" class="button">添加管理员</a>';
}
?>
</div>
<div class="pagination">
<?php
//仅cd-admin登录可以查看所有管理员
require_once ('./includes/mysql_connect.php');
if ($_SESSION['USERNAME']=='cd-admin'){
	$sql = 'SELECT ID, admin_name FROM `cd_admin`';
}else{
	$sql = 'SELECT ID, admin_name FROM `cd_admin` WHERE ID = '.$_SESSION['USERID'];
}

mysql_query("set names utf8");
$result = mysql_query($sql) or die(mysql_error());
	
if (isset($_GET["page"]))
$page = $_GET["page"];
else
$page = 1;

//管理员超过8个时分页
$records_per_page = 8;
$total_records = mysql_num_rows($result);
$total_pages = ceil($total_records / $records_per_page);
//计算本页第一条记录的序号
$started_redcord = $records_per_page * ($page - 1);
//将记录指标移至本页第一条记录的序号
if($total_records>=1){
	mysql_data_seek($result, $started_redcord);
}

if ($page > 1)
echo "<a href='users.php?title=users&list=view&page=". ($page - 1) . "'>&laquo上一页</a> ";
for ($i = 1; $i <= $total_pages; $i++){
	if ($i == $page)
	echo "<a href ='users.php?title=users&list=view&page=$i' class='number current'>$i</a> ";
	else
	echo "<a href='users.php?title=users&list=view&page=$i' class='number'>$i</a> ";
	}
if ($page < $total_pages)
echo "<a href='users.php?title=users&list=view&page=". ($page + 1) . "'>下一页&raquo;</a> ";

echo $html =<<<HTML
</div> <!-- End .pagination -->
<div class="clear"></div>
</td>
</tr>
</tfoot>
<tbody>
HTML;
$j =1;
while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page) {
	extract($row);
	echo '<tr>';
    echo '<td>' . htmlspecialchars($ID) . '</td>';
    echo '<td>' . htmlspecialchars($admin_name) . '</td>';
	if ($_SESSION['USERNAME']=='cd-admin'){
		echo '<td style="text-align:right;padding-right:50px;">'.'<a href="edit_users.php?id='.$ID.'">修改密码</a>'.' <a href="transact_users.php?action=del&id='.$ID.'" onClick="return HTMerDel();">删除</a>'; 
	}else{
		echo '<td style="text-align:right;padding-right:80px;">'.'<a href="edit_users.php?id='.$ID.'">修改密码</a>'; 
	}
    echo '</td></tr>';
	$j++;
} 
mysql_free_result($result);
?>
</tbody>
</table>
</div> <!-- End #tab1 -->