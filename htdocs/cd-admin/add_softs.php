<?php
//header("content-type:text/html; charset=utf-8");
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
if (isset($_POST['submit'])) {
	$soft_name = (isset($_POST['small-input'])) ? $_POST['small-input'] : '';
	$term = (isset($_POST['yijilanmu'])) ? $_POST['yijilanmu'] : 0;
	$tag = (isset($_POST['erjilanmu'])) ? $_POST['erjilanmu'] : 0;
	$d = (isset($_POST['textfield'])) ? $_POST['textfield'] : '';
	$OS =(isset($_POST['softos'])) ? $_POST['softos'] : '';
	
	if($_FILES['upload']['tmp_name']!=''){
		if(!empty($soft_name)&&!empty($d)&&!empty($OS)&&($term != 0)&&($tag != 0)){
			require_once ('./includes/class.HttpUpload.php');
			$upload = new Upload(array('uploadPath'=>'../cd-resource/'.$term.''));
	        $upload->fileUpload($_FILES['upload'],$soft_name,$OS,$d,$term,$tag);
	        $error = $upload->getStatus();
	        $upload_id = $upload->getId();
	
	        $dest_dir = '../cd-resource/'.$term;   //设定上传目录
	        $dest_dir2 = 'cd-resource/'.$term;
			
			if($_FILES['uploadpic']['tmp_name']!=''){
				$arr = explode('.',$_FILES['uploadpic']['name']); //分割文件名
                $file_extend = end($arr); //取数组中的最后一个值
		        $sql4 = 'select soft_url from `cd_softs` where ID = '.$upload_id;
		        $result4 = mysql_query($sql4) or die(mysql_error());
		        $row4 = mysql_fetch_assoc($result4);
		        $imgnewname = split("\.|/",$row4['soft_url']);
		
		        $file_newname = $dest_dir.'/'.$imgnewname[2].'.'.$file_extend;
		        $file_newname2 = $dest_dir2.'/'.$imgnewname[2].'.'.$file_extend;
				if($_FILES['uploadpic']['type'] == 'image/jpeg'||$_FILES['uploadpic']['type'] == 'image/pjpeg'||$_FILES['uploadpic']['type'] == 'image/png'||$_FILES['uploadpic']['type'] == 'image/gif'){
					if (move_uploaded_file($_FILES['uploadpic']['tmp_name'], $file_newname)){
						$sql3 = "update `cd_softs` set soft_img = '$file_newname2' where ID = ".$upload_id;
						$result3 = mysql_query($sql3) or die(mysql_error());
						if(!$result3){
							@unlink($file_newname);
						}
					}
				}else{
					echo "<script language='javascript'>alert('上传的图标只能是jpg，gif或png格式！');location.href='index.php?title=soft&list=ftpadd';</script>";
					break;
				}
			}
		}
	}else{
		echo "<script language='javascript'>alert(\"请选择上传的软件！\");location.href='index.php?title=soft&list=httpadd';</script>";
		break;
	}
	foreach($error as $key =>$value){
		echo "<script language='javascript'>alert(\"$value\");location.href='index.php?title=soft&list=view';</script>";
	}
	
}
?>
 
<h3><?php echo $title; ?></h3>			
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<div class="content-box-content">

<div class="tab-content default-tab">
<script language="javascript">
function check(){
	var name = document.forms["myform"].elements["small-input"].value;
	var os = document.forms["myform"].elements["softos"].value;
	var textarea = document.forms["myform"].elements["textarea"].value;
	var yijilanmu = document.forms["myform"].elements["yijilanmu"].value;
	if(name == ''){
		alert("请填写软件名！");
		document.forms["myform"].elements["small-input"].focus();
		return false;
	}
	if(os == ''){
		alert("请填写软件运行平台！");
		document.forms["myform"].elements["softos"].focus();
		return false;
	}
	if(yijilanmu == 0){
		alert("请选择软件一级栏目分类！");
		document.forms["myform"].elements["yijilanmu"].focus();
		return false;
	}
	if(textarea == ''){
		alert("请填写软件介绍！");
		document.forms["myform"].elements["textarea"].focus();
		return false;
	}
}
function jiaodian(){
	document.forms["myform"].elements["small-input"].focus();
}
</script>
<form enctype='multipart/form-data' action="index.php?title=soft&list=httpadd" method='post' id="myform" name="myform" onsubmit="return check();">
<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

<p>
<label>软件名称</label>
<input class="text-input small-input" type="text" id="small-input" name="small-input" value="<?php if(isset($_POST['small-input'])) echo $_POST['small-input']; ?>" />
</p>

<p>
<label>软件运行平台(Windows XP·Windows 7·Linux)</label>
<input class="text-input small-input" type="text" id="softos" name="softos" value="<?php if(isset($_POST['softos'])) echo $_POST['softos']; ?>" />
</p>

<p>
<label>软件类别</label>
<select name="yijilanmu" id="yijilanmu" onChange="change_erjilanmu(document.myform.yijilanmu.options[document.myform.yijilanmu.selectedIndex].value)">
<?php   
$sql = "select * from `cd_terms` order by term_rank ASC";   
$query = mysql_query($sql) or die(mysql_error());
$num1 = mysql_num_rows($query);
if($num1 == 0){
	echo "<option value=''>没有一级栏目</option>";
}else{
	echo '<option selected value="">请选择一级栏目</option>';  
	while($field = mysql_fetch_assoc($query)){
		$sql2 = 'select tag_id from `cd_tags` where tag_parent ='.$field['term_id'];
	    $query2 = mysql_query($sql2) or die(mysql_error());
	    $num = mysql_num_rows($query2);
	    if($num>=1){
?>   
<option value="<?php echo $field['term_id']; ?>"><?php echo $field['term_name']; ?></option>   
<?php
       }
	   if($num == 0){
		   echo "<option value=''>".$field['term_name']."</option>";
	   }
	}
} 
?>
</select>
<select name="erjilanmu">  
<option>未选择一级栏目</option>
</select>
</p>			

<p>
<label>选择本地软件</label>
<input type="file" name="upload" />
</p>

<p>
<label>上传软件图标（可选）</label>
<input type="file" name="uploadpic" />
</p>

<p>
<label>软件介绍</label>
<textarea class="text-input textarea wysiwyg" id="textarea" name="textfield" cols="79" rows="15"><?php if(isset($_POST['textfield'])) echo $_POST['textfield']; ?></textarea>
</p>

<!--<input type="hidden" name="submitted" value="TRUE" />	-->						
<p>
<input class="button" type="submit" name="submit" value="提交" style="margin-right:15px;"/>
<a href="index.php?title=soft&list=view" class="button" style="height:16px; line-height:16px;">取消</a>
</p>
								
</fieldset>
							
<div class="clear"></div><!-- End .clear -->
</form>
</div> <!-- End #tab2 -->    