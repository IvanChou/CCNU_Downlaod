<?php
define('IN_TG',true);
require '../include/mysql_connect.php';
include '../include/Page.class.php';
?>
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
$query = "SELECT  te.term_id,te.term_name,te.term_rank FROM `cd_terms` te ORDER BY term_rank ASC,term_id DESC;";
mysql_query("set names utf8");
$result = mysql_query($query) or die(mysql_error());
$total=mysql_num_rows($result);
$num=4;
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
$sql = "SELECT  te.term_id,te.term_name,te.term_rank FROM `cd_terms` te ORDER BY term_rank ASC,term_id DESC {$page->limit};";
mysql_query("set names utf8");
$result = mysql_query($sql) or die(mysql_error());
$j = 1;
while ($row = mysql_fetch_assoc($result)) {
	extract($row);
	echo "<tr class='"?><?php if($j%2==1) echo 'alt-row';echo "'"; echo ">";?>
	<?php
	echo '<td style="width:20%;font-weight:bold;">'.$term_name.'</td>';
	$query2 = "SELECT ta.tag_id,ta.tag_name,ta.tag_rank FROM `cd_tags` ta WHERE ta.tag_parent = ".$term_id." ORDER BY tag_rank ASC,tag_id DESC;";
	$result2 = mysql_query($query2) or die(mysql_error());
	$total = mysql_num_rows($result2);
	
	if($total == 0){;
		$sta = '无二级栏目';
	}else{
		$sta = '';
	}
	echo "<td style='width:20%;'>$sta</td>";
	echo '<td style="width:20%;">'."<a href='index.php?title=sorts&list=addtag&term_id=$term_id'>添加二级栏目</a>".'</td>';
	echo "<td style='width:10%;'>&nbsp;</td>";
	echo '<td style="width:15%;">'."<a href='index.php?title=sorts&list=editterm&term_id=$term_id'>修改</a>  "."  <a href='./sort/transact_sorts.php?action=delterm&term_id=$term_id' onClick='return HTMerDel();'>删除</a>"; 
	echo '<td style="text-align:right;width:15%;">'.'<form method="post" action="./sort/transact_sorts.php"><input type="text" name="rank" value="'.$term_rank.'" style="width:20px;margin-right:50px;text-align:center;" />';
	echo '<input type="submit" name="action" value="修 改" style="width:42px;text-align:left;" class="button" /><input type="hidden" name="term_idforrank" value="'.$term_id.'" /></form>';
	echo '</td></tr>';
	if($sta == ''){
		while($row2 = mysql_fetch_assoc($result2)){
			$i=0;
			//判断二级栏目下面是否有软件（当软件和数据库记录配对时才会显示"有"，仅数据有记录或是文件有软件时都会显示"无"）
	        $softname = "SELECT soft_url as softname FROM `cd_softs` WHERE tag_id =".$row2['tag_id'];
			$softresult = mysql_query($softname) or die(mysql_error());
			$num = mysql_num_rows($softresult);
		    while($softrow = mysql_fetch_assoc($softresult)){
				if($num != 0 && file_exists('../../'.$softrow['softname'])&&$softrow['softname']!=''){
					$i++;
				}
			}
			if($i==0){
				$status = '<span style="color:red;">无</span>';
			}else{
				$status = '<span>有</span>';
			}
		echo "<tr class='"?><?php if($j%2==1) echo 'alt-row';echo "'"; echo ">";?>
		<?php
		echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;|---------</td>';
		echo '<td>'.$row2['tag_name'].'</td>';
		echo '<td>&nbsp;</td>';
		echo "<td>$status</td>";
		echo '<td>'."<a href='index.php?title=sorts&list=edittag&tag_id=".$row2['tag_id']."'>修改</a> "."<a href='./sort/transact_sorts.php?action=deltag&tag_id=".$row2['tag_id']."' onClick='return HTMerDel2();'>删除</a>".'</td>';
		echo '<td style="text-align:right;"><form method="post" action="./sort/transact_sorts.php"><input type="text" name="tag_rank" value="'.$row2['tag_rank'].'" style="width:20px;text-align:center;margin-right:5px;"/>';
		echo '<input type="submit" name="action" value="修改" style="width:42px;" class="button" /><input type="hidden" name="tag_idforrank" value="'.$row2['tag_id'].'" /></form>';
		echo '</td></tr>';
		}
	}
	$j++;
}
?>
</tbody>
</table>