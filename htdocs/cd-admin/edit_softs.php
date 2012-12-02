<?php
require_once ('./includes/mysql_connect.php');
logincheck();
header("content-type:text/html; charset=utf-8");
if (isset($_GET['softid'])){
	$softid = $_GET['softid'];
}
if (isset($_POST['submit'])){
	$softname = escape_data(trim($_POST['softnameedit']));
	$oldterm = $_POST['oldterm'];
	$softname2 = $_POST['softname2'];
	$softtruename2 = split("/",$_POST['softname2']);
	$softexitend = split("\.|/",$_POST['softname2']);
	$term = $_POST['yijilanmu'];
	$tag = $_POST['erjilanmu'];
	$soft_url = 'cd-resource/'.$term.'/'.$_POST['softname'];
	$d = $_POST['textfield'];
	$os = $_POST['softos'];
	$soft_size = trim($_POST['softsize']).$_POST['softsizeliangji'];
	//将人工填写的软件大小转换成以B为单位的值，以便可以存储在数据库
	if (strpos($soft_size,"GB")){
		$soft_size = str_replace("GB","","$soft_size");	
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1073741824;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='edit_softs.php?softid=$softid';</script>";
			break;
		}
	}elseif(strpos($soft_size,"MB")){
		$soft_size = str_replace("MB","","$soft_size");	
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1048576;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='edit_softs.php?softid=$softid';</script>";
			break;
		}
	}elseif(strpos($soft_size,"KB")){
		$soft_size = str_replace("KB","","$soft_size");	
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1024;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='edit_softs.php?softid=$softid';</script>";
			break;
		}
	}elseif(strpos($soft_size,"B")){
		$soft_size = str_replace("B","","$soft_size");
		if(is_numeric($soft_size)){
			$soft_size = $soft_size*1;
		}else{
			echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='edit_softs.php?softid=$softid';</script>";
			break;
		}
	}elseif(is_numeric($soft_size)){
		$soft_size = $soft_size*1;
	}else{
		echo "<script language=\"javascript\">alert('软件大小填写错误！');location.href='edit_softs.php?softid=$softid';</script>";
		break;
	}
	
	$sql7 = 'select term_id from `cd_softs` where ID = '.$softid;
	$result7 = mysql_query($sql7) or die(mysql_error());
	$row7 = mysql_fetch_assoc($result7);
	$dest_dir = '../cd-resource/'.$row7['term_id'];   //设定上传目录
	$dest_dir2 = 'cd-resource/'.$row7['term_id'];
	
	$sql8 = "select soft_img from `cd_softs` where ID =".$softid;
	$result8 = mysql_query($sql8) or die(mysql_error());
	$num8 = mysql_num_rows($result8);
	$row8 = mysql_fetch_assoc($result8);
	if($_FILES['upload']['tmp_name']!=''){
		$arr = explode('.',$_FILES['upload']['name']); //分割文件名
        $file_extend = end($arr); //取数组中的最后一个值
		$newimg = split("\.",$_POST['softname']);
		$newname = $newimg[0].'.'.$file_extend;
		$file_newname = $dest_dir.'/'.$newname;
		$file_newname2 = $dest_dir2.'/'.$newname;
		
		if($_FILES['upload']['type'] == 'image/jpeg'||$_FILES['upload']['type'] == 'image/pjpeg'||$_FILES['upload']['type'] == 'image/png'||$_FILES['upload']['type'] == 'image/gif'){
			if($num8 !=0 && file_exists('../'.$row8['soft_img']) && $row8['soft_img']!=''){
				unlink('../'.$row8['soft_img']);
			}
			if (move_uploaded_file($_FILES['upload']['tmp_name'], $file_newname)){
				$sql9 = "update `cd_softs` set soft_img = '$file_newname2' where ID = ".$softid;
				$result9 = mysql_query($sql9) or die(mysql_error());
				if(!$result9){
					unlink($file_newname);
				}
			}
		}else{
			echo "<script language='javascript'>alert('上传的图标只能是jpg，gif或png格式！');location.href='edit_softs.php?softid=$softid';</script>";
			break;
		}
	}
	
	$folder_name ="../cd-resource/$oldterm/";
	$folder_name_new ="../cd-resource/$term/";
	if(!file_exists($folder_name_new)){
		mkdir($folder_name_new, 0777); 
	}
	if($folder_name == $folder_name_new){
		if(strlen($softexitend[2])!=19){
			rename($folder_name.$softtruename2[2],$folder_name.$_POST['softname']);
		}
		$sql = "UPDATE `cd_softs` SET soft_name = '$softname',soft_size = $soft_size,soft_url = '$soft_url',soft_os = '$os',term_id = $term,tag_id = $tag,soft_description = '$d' WHERE ID = ".$softid;
	    mysql_query('set names utf8');
	    $result = mysql_query($sql) or die(mysql_error());
	}else{
		$sql6 = "SELECT soft_img as softimg FROM `cd_softs` WHERE ID =".$softid;
		$result6 = mysql_query($sql6) or die(mysql_error());
		$row6 = mysql_fetch_assoc($result6);
		$softimg = $row6['softimg'];
		$imgtruename = split("/",$row6['softimg']);
		if(file_exists('../'.$softimg)&&$softimg != ''){
			$copy_soft2 = copy('../'.$softimg,$folder_name_new.$imgtruename[2]);
	        $del_soft2 = unlink('../'.$softimg);
			if($copy_soft2&&$del_soft2){
				$newsoftimg = "cd-resource/$term/$imgtruename[2]";
				$sql5 = "update `cd_softs` set soft_img = '$newsoftimg' where ID =".$softid;
				$result5 = mysql_query($sql5) or die(mysql_error());
			}else{
				echo "<script language=\"javascript\">alert('缩略图移动失败！');location.href='edit_softs.php?softid=$softid';</script>";
				break;
			}
		}
		if(file_exists('../'.$softname2)){
			$copy_soft = copy('../'.$softname2,$folder_name_new.$softtruename2[2]);
	        $del_soft = unlink('../'.$softname2);
			if(strlen($softexitend[2])!=17){
				$rename = rename($folder_name_new.$softtruename2[2],$folder_name_new.$_POST['softname']);
			}
			if($copy_soft && $del_soft){
				$sql4 = "UPDATE `cd_softs` SET soft_name = '$softname',soft_size = $soft_size,soft_os = '$os',soft_url = '$soft_url',term_id = $term,tag_id = $tag,soft_description = '$d' WHERE ID = ".$softid;
			    mysql_query('set names utf8');
			    $result4 = mysql_query($sql4) or die(mysql_error());
			}else{
				echo "<script language=\"javascript\">alert('软件移动或修改软件名失败，没有修改数据库记录！');location.href='edit_softs.php?softid=$softid';</script>";
			}
		}else{
			$sql3 = "UPDATE `cd_softs` SET soft_name = '$softname',soft_size = $soft_size,soft_os = '$os',soft_url = '$soft_url',term_id = $term,tag_id = $tag,soft_description = '$d' WHERE ID = ".$softid;
			mysql_query('set names utf8');
			$result3 = mysql_query($sql3) or die(mysql_error());
			echo "<script language=\"javascript\">alert('软件不存在，仅修改了数据库记录！');location.href='index.php?title=soft&list=view';</script>";
		}
	}
	//header('location:./index.php?title=soft&list=view');
	//exit;
	$url = "index.php?title=soft&list=view";
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>";
}else{
?>
<?php
include ('./includes/header.html');
?>
<script type="text/javascript">
var list_count;   //二级列表选项个数，初值设为0
list_count=0;   
erjilanmu = new Array();   //定义一个数组，该数组用来存放二级列表中的内容
<?php
$sql = "select * from `cd_tags` order by tag_rank ASC"; 
mysql_query('set names utf8');
$query = mysql_query($sql) or die(mysql_error());   
$count = 0;   
//为数组赋值
while($field = mysql_fetch_assoc($query))
{   
?>   
erjilanmu[<?php echo $count ?>] = new Array
(
"<?php echo $field['tag_parent']?>",
"<?php echo $field['tag_name']?>",
"<?php echo $field['tag_id']?>"
);   
<?php   
$count++;   
}   //赋值完毕
echo "list_count=$count;";   //将数组总行数赋给list_count——二级列表项数
?>   
 
//联动函数   
function change_erjilanmu(content_type)
{   
document.myform.erjilanmu.length = 0;
var ct=content_type;   
var i;
for (i=0;i<list_count; i++)   
 {   
   if (erjilanmu[i][0] == ct)   
   {   
      document.myform.erjilanmu.options[document.myform.erjilanmu.length] = new Option(erjilanmu[i][1],erjilanmu[i][2]);
   }
 }
  if (ct == '') 
   {
      document.myform.erjilanmu.options[document.myform.erjilanmu.length] = new Option('没有二级栏目');
   }   
}
</script>
<?php
require_once ('./includes/menu.php');
?>

<?php
$sql = 'SELECT s.soft_name,s.soft_img,s.soft_url as softname,s.soft_size,te.term_id,te.term_name,ta.tag_id,ta.tag_name,s.soft_description,s.soft_os FROM `cd_softs` s,`cd_terms` te,`cd_tags` ta WHERE s.term_id = te.term_id AND s.tag_id = ta.tag_id AND te.term_id = ta.tag_parent AND s.ID ='.$softid;
mysql_query('set names utf8');
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);
?>
<h3>修改软件信息</h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<script language="javascript">
function jiaodian(){
	var esrc = document.forms["myform"].elements["softnameedit"];
	if(navigator.userAgent.indexOf("MSIE")>0){
		if(esrc==null){
		esrc=event.srcElement;
		}
		var rtextRange =esrc.createTextRange();
		rtextRange.moveStart('character',esrc.value.length); 
        rtextRange.collapse(true); 
        rtextRange.select();
	}else{ 
		var rtextRange = esrc.setSelectionRange(esrc.value.length,esrc.value.length);
		esrc.focus();
	}
}
</script>
<div class="content-box-content">
<div class="tab-content default-tab" > <!-- This is the target div. id must match the href of this div's tab -->
<form method="post" action="edit_softs.php?softid=<?php echo $softid; ?>" name="myform" enctype='multipart/form-data'>
<div class="info" style="float:left; width:350px;">
<p><label>软件名称</label>
<input type="text" class="text-input small-input" id="softnameedit" name="softnameedit" value="<?php echo $row['soft_name']; ?>" style="width:190px !important;"/>
<input type="hidden" name="softname2" value="<?php echo $row['softname']; ?>" />
</p>

<p><label>软件运行平台</label>
<input type="text" class="text-input small-input" name="softos" value="<?php echo $row['soft_os']; ?>" style="width:190px !important;"/>
</p>

<p>
<label>修改软件类别</label>
<select name="yijilanmu" onChange="change_erjilanmu(document.myform.yijilanmu.options[document.myform.yijilanmu.selectedIndex].value)">
<?php   
$sql = "select * from `cd_terms` where term_id !=".$row['term_id'];
$query = mysql_query($sql) or die(mysql_error());
$sql3 ="select term_name,term_id from `cd_terms` where term_id =".$row['term_id'];
$query3 = mysql_query($sql3) or die(mysql_error());
$row3 = mysql_fetch_assoc($query3);
echo "<option selected='selected' value='".$row3['term_id']."'>".$row3['term_name']."</option>";  
while($field = mysql_fetch_assoc($query)){
	$sql2 = 'select tag_id from `cd_tags` where tag_parent ='.$field['term_id'];
	$query2 = mysql_query($sql2);
?>   
<option value="<?php echo $field['term_id']; ?>"><?php echo $field['term_name']; ?></option>   
<?php
}
$sql5 = 'select tag_name,tag_id from `cd_tags` where tag_id = '.$row['tag_id'];
$query5 = mysql_query($sql5) or die(mysql_error());
$row5 = mysql_fetch_assoc($query5);
$sql4 = 'select tag_name,tag_id from `cd_tags` where tag_parent = '.$row['term_id'].' and tag_id != '.$row['tag_id'];
$query4 = mysql_query($sql4) or die(mysql_error());
?>
</select>
<select name="erjilanmu">
<option selected="selected" value="<?php echo $row5['tag_id']; ?>"><?php  echo $row5['tag_name']; ?></option>
<?php
while($row4 = mysql_fetch_assoc($query4)){
?>
<option value="<?php echo $row4['tag_id']; ?>"><?php  echo $row4['tag_name']; ?></option>
<?php
}
?>
</select>
<input type="hidden" value="<?php echo $row3['term_id']; ?>" name="oldterm" />
</p>

<p>
<label>物理文件名</label>
<?php
$truesoftname = split("/",$row['softname']);
$file_extend = split("\.|/",$row['softname']);
if (strlen($file_extend[2])==19){
	echo $truesoftname[2];
	echo "<input type='hidden' value='".$truesoftname[2]."' name='softname' />";
}else{
?>
<input type="text" class="text-input small-input" value="<?php echo date("YmdHis").'_'.rand(1000,9999).'.'.$file_extend[3]; ?>" name="softname" style="width:190px !important;" />
<?php	
}
?>
</p>
</div><!--end info-->

<div class="pic" style="float:left;">
<p style="margin-top:10px; margin-bottom:15px;"><label>软件图标</label>
<?php
if(file_exists('../'.$row['soft_img'])&&$row['soft_img']!=''){
?>
<img src="<?php echo '../'.$row['soft_img']; ?>" width="90" height="90" alt="缩略图" style="border:1px solid #CC9;"/>
<?php
}else{
	echo "<span style='color:red;border:1px solid #CC9;line-height:34px;letter-spacing:3px;'>无缩略图</span>";
}
?>
</p>

<p>
<?php
$sql10 = "select soft_img from `cd_softs` where ID =".$softid;
$result10 = mysql_query($sql10) or die(mysql_error());
$row10 = mysql_fetch_assoc($result10);
if(file_exists('../'.$row10['soft_img'])&&$row10['soft_img']!=''){
	echo '<label>更改图标</label>';
}else{
	echo '<label>上传图标</label>';
}
?>
<input type="file" name="upload" />
</p>

<p><label>软件大小</label>
<?php
if ($row['soft_size']>=1024&&$row['soft_size']<=1048576){
		$row['soft_size'] = $row['soft_size'] /1024;
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'KB.B.MB.GB';
	}
	elseif($row['soft_size']>1048576&&$row['soft_size']<1073741824){
		$row['soft_size'] = $row['soft_size'] /1048576;
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'MB.B.KB.GB';
	}
	elseif($row['soft_size']<1024){
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'B.KB.MB.GB';
	}
	else{
		$row['soft_size'] = $row['soft_size'] /1073741824;
		$row['soft_size'] = round($row['soft_size'],1);
		$row['soft_size'] = $row['soft_size'];
		$liangji = 'GB.B.KB.MB';
	}
?>
<input type="text" class="text-input small-input" name="softsize" value="<?php echo $row['soft_size']; ?>" style="width:80px !important;"/>
<?php
$liangji2 = split("\.",$liangji);
echo '<select name="softsizeliangji">';
while (list($key,$value) = each ($liangji2)){
echo "<option value='$value'>$value</option>";
}
echo '</select>';
?>
</p>
</div>
<div style="clear:left;"></div>

<p><label>软件介绍</label><textarea class="text-input textarea wysiwyg" id="textarea" name="textfield" cols="79" rows="15"><?php echo $row['soft_description']; ?></textarea></p>

<p><input type="submit" name="submit" class="button" value="修改" style="margin-right:15px;"/><a href="index.php?title=soft&list=view" class="button" style="height:16px; line-height:16px;">取消</a></p>
</form>
</div> <!-- End #tab1 -->

<?php
include ('./includes/footer.html');
}
?>