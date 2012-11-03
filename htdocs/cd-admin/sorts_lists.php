<script language="JavaScript" type="text/JavaScript">
function HTMerDel()
{
	if(confirm("将删除一级栏目下的所有软件，确定删除？"))
    return true;
    else
    return false;
}
function HTMerDel2()
{
	if(confirm("将删除该二级栏目下的所有软件，确定删除？"))
    return true;
    else
    return false;
}
function jiaodian(){
	document.form1.term.focus();
}
</script>
<h3 style="text-align:center;float:none;">添加一级栏目</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->

<div class="content-box-content" style="margin-bottom:20px;">
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<form method="post" action="transact_sorts.php" style="text-align:center; float:none;" name="form1">
<p>一级栏目名称：<input type="text" name="term" class="" /></p>
<input type="submit" name="action" class="button" value="添加" style="margin-left:29px;"/>
<input type="submit" name="action" class="button" value="重置" style="margin-left:10px;"/>
</form>
</div> <!-- End #tab1 -->
</div> <!-- End .content-box-content -->

<div class="content-box-header">
<h3 style="text-align:center;float:none;">栏目列表</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<div class="content-box-content">
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<table style="white-space:nowrap;">
<thead>
<tr>
<th>一级栏目</th>
<th>二级栏目</th>
<th>添加栏目</th>
<th>软件</th>
<th>操作</th>
<th style="text-align:center;">排序</th>
</tr>
</thead>
						 
<tfoot>
<tr>
<td colspan="6">						
<div class="pagination">
<?php
require_once ('./includes/mysql_connect.php');
$query = "SELECT  te.term_id,te.term_name,te.term_rank FROM `cd_terms` te ORDER BY term_rank ASC,term_id DESC;";
mysql_query("set names utf8");
$result = mysql_query($query) or die(mysql_error());

//$sql3 = "SELECT tag_id FROM `cd_tags`";
//$result3 = mysql_query($sql3) or die(mysql_error());
if (isset($_GET["page"]))
$page = $_GET["page"];
else
$page = 1;

//一个页面的一级栏目数超过10时分页
$records_per_page = 10;
$total_records = mysql_num_rows($result);
$total_pages = ceil($total_records / $records_per_page);
//计算本页第一条记录的序号
$started_redcord = $records_per_page * ($page - 1);
//将记录指标移至本页第一条记录的序号
if($total_records>=1){
	mysql_data_seek($result, $started_redcord);
}
if ($page > 1)
echo "<a href='sorts.php?title=sorts&list=view&page=". ($page - 1) . "'>&laquo上一页</a> ";
for ($i = 1; $i <= $total_pages; $i++){
	if ($i == $page)
	echo "<a href ='sorts.php?title=sorts&list=view&page=$i' class='number current'>$i</a> ";
	else
	echo "<a href='sorts.php?title=sorts&list=view&page=$i' class='number'>$i</a> ";
	}
if ($page < $total_pages)
echo "<a href='sorts.php?title=sorts&list=view&page=". ($page + 1) . "'>下一页&raquo;</a> ";

echo $html = <<<HTML
</div> <!-- End .pagination -->
<div class="clear"></div>
</td>
</tr>
</tfoot>
<tbody>
HTML;

$j=1;
while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page) {
	extract($row);
	echo '<tr>';
	echo '<td style="width:20%;">'.$term_name.'</td>';
	
	$query2 = "SELECT ta.tag_id,ta.tag_name,ta.tag_rank FROM `cd_tags` ta WHERE ta.tag_parent = ".$term_id." ORDER BY tag_rank ASC,tag_id DESC;";
	$result2 = mysql_query($query2) or die(mysql_error());
	$total = mysql_num_rows($result2);
	
	if($total == 0){;
		$sta = '无二级栏目';
	}else{
		$sta = '';
	}
	echo "<td style='width:20%;'>$sta</td>";
	echo '<td style="width:20%;">'."<a href='add_tag.php?term_id=$term_id'>添加二级栏目</a>".'</td>';
	echo "<td style='width:10%;'>&nbsp;</td>";
	echo '<td style="width:15%;">'."<a href='edit_term.php?term_id=$term_id'>修改</a>  "."  <a href='transact_sorts.php?action=delterm&term_id=$term_id' onClick='return HTMerDel();'>删除</a>"; 
	echo '<td style="text-align:right;width:15%;">'.'<form method="post" action="transact_sorts.php"><input type="text" name="rank" value="'.$term_rank.'" style="width:20px;margin-right:50px;text-align:center;" />';
	echo '<input type="submit" name="action" value="修 改" style="width:42px;text-align:left;" class="button" /><input type="hidden" name="term_idforrank" value="'.$term_id.'" /></form>';
	echo '</td></tr>';
	if($sta == ''){
		while($row2 = mysql_fetch_assoc($result2)){
			//判断二级栏目下面是否有软件（当软件和数据库记录配对时才会显示"有"，仅数据有记录或是文件有软件时都会显示"无"）
	        $softname = "SELECT soft_url as softname FROM `cd_softs` WHERE tag_id =".$row2['tag_id'];
			$softresult = mysql_query($softname) or die(mysql_error());
			$num = mysql_num_rows($softresult);
		    $softrow = mysql_fetch_assoc($softresult);
	        if($num != 0 && file_exists('../'.$softrow['softname'])&&$softrow['softname']!=''){
				$status = '<span>有</span>';
			}else{
				$status = '<span style="color:red;">无</span>';
			}
		echo '<tr>';
		echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;|---------</td>';
		echo '<td>'.$row2['tag_name'].'</td>';
		echo '<td>&nbsp;</td>';
		echo "<td>$status</td>";
		echo '<td>'."<a href='edit_tag.php?tag_id=".$row2['tag_id']."'>修改</a> "."<a href='transact_sorts.php?action=deltag&tag_id=".$row2['tag_id']."' onClick='return HTMerDel2();'>删除</a>".'</td>';
		echo '<td style="text-align:right;"><form method="post" action="transact_sorts.php"><input type="text" name="tag_rank" value="'.$row2['tag_rank'].'" style="width:20px;text-align:center;margin-right:5px;"/>';
		echo '<input type="submit" name="action" value="修改" style="width:42px;" class="button" /><input type="hidden" name="tag_idforrank" value="'.$row2['tag_id'].'" /></form>';
		echo '</td></tr>';
		}
	}
	$j++;
} 
?>
</tbody>
</table>
</div> <!-- End #tab1 -->