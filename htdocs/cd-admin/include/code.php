<?php
	session_start();
	include './ValidationCode.class.php';
	$code=new ValidationCode(88, 27, 4);
	$code->showImage('../resources/fonts/msyh.ttf');   //输出到页面中供 注册或登录使用
	$_SESSION["code"]=$code->getCheckCode();  //将验证码保存到服务器中
?> 