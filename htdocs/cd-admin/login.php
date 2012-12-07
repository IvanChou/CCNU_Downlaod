<?php
session_start();
//header告诉浏览器采用utf8形式编码，否则在ie下alert对话框弹不出来
header("content-type:text/html; charset=utf-8");
require_once ("./includes/mysql_connect.php");
if(isset($_POST['submit'])){
	$name = escape_data(trim($_POST['name']));
	$password = md5(escape_data(trim($_POST['password'])));  
	$imgcode = trim($_POST['imgcode']); // 接收从登录页面输入框提交过来的验证码
	$myimagecode = trim($_SESSION['randcode']); // 从sesion中取得验证码
	$sql = "SELECT * FROM `cd_admin` WHERE admin_name = '$name' AND admin_pass = '$password';";
	mysql_query("set names utf8");
	$result = mysql_query($sql) or die(mysql_error());
	if(!(empty($imgcode)||empty($name)||empty($password))){
		if($imgcode==$myimagecode){
			$numrows = mysql_num_rows($result);
			if($numrows==1){
				$row = mysql_fetch_assoc($result);
				$_SESSION['USERNAME'] = $row['admin_name'];
				$_SESSION['USERID'] = $row['ID'];
				mysql_free_result($result);
				header("location:./index.php");
				}
			else
			echo "<script language=\"javascript\">alert('用户名或密码错误！');location.href='login.php';</script>";
		}
		else{
			echo "<script language=\"javascript\">alert('验证码错误！');location.href='login.php';</script>";
			}
	}
}else{
?>
<?php
include_once ('./includes/login_header.html');
?>
<script language="javascript">
function CheckPost()
{
	var  name = document.forms["login-form"].elements["login"].value;
	var  password = document.forms["login-form"].elements["password"].value;
	var  imgcode = document.forms["login-form"].elements["yanzhengma"].value;
	if (name=="")
	{
		alert("请输入用户名！");
		document.forms["login-form"].elements["login"].focus();
		return false;
	}
	if (password=="")
	{
		alert("请输入密码！");
		document.forms["login-form"].elements["password"].focus();
		return false;
	}
	if (imgcode=="")
	{
		alert("请输入验证码！");
		document.forms["login-form"].elements["yanzhengma"].focus();
		return false;
	}
}
</script>
<form id="login-form" name="form1" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" onsubmit="return CheckPost();">
<p>
<label>用户名</label>
<input class="text-input" id="login" type="text"  name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"/>
</p>
<div class="clear"></div>

<p>
<label>密码</label>
<input class="text-input" id="password" type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"/>
</p>
<div class="clear"></div>

<p>
<label>验证码</label>
<img src="code.php" alt="验证码" /><input type="text" name="imgcode" class="text-input" id="yanzhengma" value="<?php if (isset($_POST['imgcode'])) echo $_POST['imgcode']; ?>" />
</p>
<div class="clear"></div>

<p>
<input class="button" type="submit" name="submit" value="登&nbsp;录" />
</p>
</form>

<?php
}
?>
<?php
include_once ('./includes/login_footer.html');
?>