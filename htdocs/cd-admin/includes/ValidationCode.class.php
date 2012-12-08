<?php
/*类名称：验证码类
 *功能说明：可自定义验证码的宽、高，验证码长度，以及可以自定义字体（不自定义采用系统默认字体），干扰点会随着画布的增大自动增多
 *时间：2012-07-26
 */

class ValidationCode{
	private $width;
	private $height;
	private $codeNum;
	private $image;//图像资源
	private $disturbColorNum;
	private $checkCode;
	
	function __construct($width=80,$height=20,$codeNum=4){
		$this->width=$width;
		$this->height=$height;
		$this->codeNum=$codeNum;
		$this->checkCode=$this->createCheckCode();
		$number =floor($width*$height/15);
		
		if($number>240-$codeNum){
			$this->disturbColorNum=240-$codeNum;
		}else{
			$this->disturbColorNum=$number;
		}
	}
	
	//向浏览器输出图像
	function showImage($fontface=""){
		//1.创建图像背景
		$this->createImage();
		//2.设置干扰元素
		$this->setDisturbColor();
		//3.向图像中随机画出文本
		$this->outputText($fontface);
		//4.输出图像
		$this->outputImage();
	}
	//获取随机创建的验证码字符
	function getCheckCode(){
		return $this->checkCode;
	}
	
	private function createImage(){
		$this->image = imagecreatetruecolor($this->width,$this->height);
		$backColor = imagecolorallocate($this->image,rand(225,255),rand(225,255),rand(225,255));
		imagefill($this->image,0,0,$backColor);
		$border = imagecolorallocate($this->image,0,0,0);
		imagerectangle($this->image,0,0,$this->width-1,$this->height-1,$border);
	}
	
	private function setDisturbColor(){
		for($i=0;$i<$this->disturbColorNum;$i++){
			$color = imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($this->image,rand(1,$this->width-2),rand(1,$this->height-2),$color);
		}
		/*
		for($i=0;$i<5;$i++){
			$color = imagecolorallocate($this->image,rand(200,255),rand(200,255),rand(200,255));
			imagearc($this->image,rand(10,$this->width-10),rand(10,$this->height-10),rand(30,300),rand(20,200),55,44,$color);
		}*/
	}
	
	private function createCheckCode(){
		$code = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
		$string = '';
		for($i=0;$i<$this->codeNum;$i++){
			$char = $code{rand(0,strlen($code)-1)};
			$string .= $char;
		}
		return $string;
	}
	
	private function outputText($fontface=""){
		for($i=0;$i<$this->codeNum;$i++){
			$fontcolor = imagecolorallocate($this->image,rand(0,128),rand(0,128),rand(0,128));
			if($fontface==""){
				$fontsize = rand(12,16);
				$x = floor($this->width/$this->codeNum)*$i+3;
				$y = rand(0,$this->height-15);
				imagechar($this->image,$fontsize,$x,$y,$this->checkCode{$i},$fontcolor);
			}else{
				$fontsize = rand(14,16);
				$x = floor(($this->width-8)/$this->codeNum)*$i+8;
				$y = rand($fontsize+5,$this->height-4);
				imagettftext($this->image,$fontsize,rand(-30,30),$x,$y,$fontcolor,$fontface,$this->checkCode{$i});
			}
		}
	}
	
	private function outputImage(){
		if(imagetypes()&IMG_GIF){
			header("Content-Type:image/gif");
			imagegif($this->image);
		}else if(imagetypes()&IMG_JPG){
			header("Content-Type:image/jpeg");
			imagejpeg($this->image);
		}else if(imagetypes()&IMG_PNG){
			header("Content-Type:image/png");
			imagepng($this->image);
		}else if(imagetypes()&IMG_WBMP){
			header("Content-Type:image/vnd.wap.wbmp");
			imagewbmp($this->image);
		}else{
			die('PHP不支持图像创建！');
		}
	}
	
	function __destruct(){
		imagedestroy($this->image);
	}
}
?>