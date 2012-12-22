<?php
session_start();
define('IN_TG',true);
//header告诉浏览器采用utf8形式编码，否则在ie下alert对话框弹不出来
header("content-type:text/html; charset=utf-8");
require_once ("./include/mysql_connect.php");
if(isset($_POST['submit'])){
	$name = escape_data(trim($_POST['name']));
	$password = md5(escape_data(trim($_POST['password'])));  
	$imgcode = trim($_POST['imgcode']); // 接收从登录页面输入框提交过来的验证码
	$myimagecode = trim($_SESSION['code']); // 从sesion中取得验证码
	$sql = "SELECT * FROM `cd_admin` WHERE admin_name = '$name' AND admin_pass = '$password';";
	mysql_query("set names utf8");
	$result = mysql_query($sql) or die(mysql_error());
	if(!(empty($imgcode)||empty($name)||empty($password))){
		if(strtoupper($imgcode)==strtoupper($myimagecode)){
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
include_once ('./include/login_header.html');
?>
<script language="javascript">
<!--
function CheckPost(){
	var  username = document.getElementById('username').value;
	var  password = document.getElementById('password').value;
	var  code = document.getElementById('yanzhengma').value
	if (username==""){
		alert("请输入用户名！");
		document.getElementById('username').focus();
		return false;
	}
	if (password==""){
		alert("请输入密码！");
		document.getElementById('password').focus();
		return false;
	}
	if (code==""){
		alert("请输入验证码！");
		document.getElementById('yanzhengma').focus();
		return false;
	}
}
-->
</script>
<form id="login-form" name="formlogin" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" onsubmit="return CheckPost();">
<p>
<label>用户名</label>
<input class="text-input" id="username" type="text"  name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"/>
</p>
<div class="clear"></div>

<p>
<label>密码</label>
<input class="text-input" id="password" type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"/>
</p>
<div class="clear"></div>

<p>
<label>验证码</label>
<img src="./include/code.php" alt="看不清？请点一下！" onclick="this.src='./include/code.php?'+Math.random()" /><input type="text" name="imgcode" class="text-input" id="yanzhengma" value="<?php if (isset($_POST['imgcode'])) echo $_POST['imgcode']; ?>" onkeyup="if(this.value!=this.value.toUpperCase()) this.value=this.value.toUpperCase()"/>
</p>
<div class="clear"></div>

<p>
<input class="button" type="reset" name="reset" value="重&nbsp;置" />
<input class="button" type="submit" name="submit" value="登&nbsp;录" />
</p>
</form>

<?php
}
?>
<?php
include_once ('./include/login_footer.html');
?>