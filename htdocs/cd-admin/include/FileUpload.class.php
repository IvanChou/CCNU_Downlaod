<?php
/*类名称：文件上传类
 *类功能：可以上传一个或多个文件，可自定义上传路径，大小，类型，是否重命名源文件，且参数的顺序及大小写不限
 *        上传多个文件时，有一个文件上传失败时，全部的文件均上传失败
 *时间：2012-07-27
 */


class FileUpload{
	private $filepath; //制定上传文件保存的路径
	private $allowtype = array('gif','jpg','png','jpeg');
	private $maxsize=209715200;
	private $israndname=true; //是否随机重命名文件
	private $originName;//源文件名称
	private $tmpFileName;//临时文件名
	private $fileType;
	private $fileSize;
	private $newFileName;//新文件名
	private $errorNum=0;//错误号
	private $errorMess="";//用来提供错误报告
	
	
	
    //对上传文件初始化
	function __construct($options=array()){
		foreach($options as $key=>$val){
			$key = strtolower($key);//将用户自定义的输入全部转换为小写
			if(!in_array($key,get_class_vars(get_class($this)))){
				continue;
			}
			$this->setOption($key,$val);
		}
	}
	
	
	
	private function setOption($key,$val){
		$this->$key=$val;
	}
	
	private function getError(){
		$str = "上传文件{$this->originName}时出错：";
		switch($this->errorNum){
			case 4: $str .='没有文件被上传！';break;
			case 3: $str .='文件只部分被上传！';break;
			case 2: $str .='上传文件超过了HTML表单规定的最大值！';break;
			case 1: $str .='上传文件超过了php.ini中upload_max_filesize选项的值！';break;
			case -1: $str .='未允许的类型！';break;
			case -2: $str .="文件过大，上传文件不能超过{$this->maxsize}个字节！";break;
			case -3: $str .='上传失败！';break;
			case -4: $str .='建立存放文件目录失败，请重新指定上传目录！';break;
			case -5: $str .='必须指定上传文件的路径！';break;
			
			default:$str .= '未知错误！';
		}
		return $str;
	}
	//检查文件上传路径
	private function checkFilePath(){
		if(empty($this->filepath)){
			$this->setOption('errorNum',-5);
			return false;
		}
		if(!file_exists($this->filepath)||!is_writable($this->filepath)){
			if(!@mkdir($this->filepath,0775)){
				$this->setOption('erroeNum',-4);
				return false;
			}
		}
		return true;
	}
	
	private function checkFileSize(){
		if($this->fileSize > $this->maxsize){
			$this->setOption('errorNum',-2);
			return false;
		}else{
			return true;
		}
	}
	
	private function checkFileType(){
		if(in_array(strtolower($this->fileType),$this->allowtype)){
			return true;
		}else{
			$this->setOption('errorNum',-1);
			return false;
		}
	}
	
	
	//设置上传后的文件名
	private function setNewFileName(){
		if($this->israndname){
			$this->setOption('newFileName',$this->proRandName());
		}else{
			$this->setOption('newFileName',$this->originName);
		}
	}
	
	
	
	//设置随机文件名称
	private function proRandName(){
		$fileName = date("YmdHis").'_'.rand(1000,9999);
		return $fileName.'.'.$this->fileType;
	}
	
	//用来上传一个文件
	function uploadFile($fileField){
		$return = true;
		//首先要检查文件路径
		if(!$this->checkFilePath()){
			$this->errorMess = $this->getError();
			return false;
		}
		
		
		$name = $_FILES[$fileField]['name'];
		$tmp_name = $_FILES[$fileField]['tmp_name'];
		$size = $_FILES[$fileField]['size'];
		$error = $_FILES[$fileField]['error'];
		
		
		if(is_Array($name)){
			$errors = array();
			
			for($i=0;$i<count($name);$i++){
				if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){
					if(!$this->checkFileSize()||!$this->checkFileType()){
						$errors[] = $this->getError();
						$return = false;
					}
				}else{
					$errors[] = $this->getError();
					$return = false;
				}
				if(!$return)
					$this->setFiles();
			}
			
			if($return){
				$fileNames = array();
				
				for($i=0;$i<count($name);$i++){
					if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){
						$this->setNewFileName();
						if(!$this->copyFile()){
							$errors[] = $this->getError();
							$return = false;
						}else{
							$fileNames[] = $this->newFileName;
						}
					}
				}
				$this->newFileName = $fileNames;
			}
			
			$this->errorMess = $errors;
			return $return;
		}else{
		
			if($this->setFiles($name,$tmp_name,$size,$error)){
				if($this->checkFileSize()&&$this->checkFileType()){
					$this->setNewFileName();
				
					if($this->copyFile()){
						return true;
					}else{
						return false;
					}
				}else{
					$return = false;
				}
			}else{
				$return = false;
			}
		
			if(!$return)
				$this->errorMess=$this->getError();
			return $return;
		}
	}
	
	//移动临时文件
	private function copyFile(){
		if(!$this->errorNum){
			$filepath = rtrim($this->filepath,'/').'/';
			$filepath .= $this->newFileName;
			
			if(@move_uploaded_file($this->tmpFileName,$filepath)){
				return true;
			}else{
				$this->setOption('errorNum',-3);
				return false;
			}
		}else{
			return false;
		}
	}
	
	//设置和$_FILES有关的内容
	private function setFiles($name="",$tmp_name="",$size=0,$error=0){
		$this->setOption('errorNum',$error);
		
		if($error){
			return false;
		}
		$this->setOption('originName',$name);
		$this->setOption('tmpFileName',$tmp_name);
		
		$arrStr = explode('.',$name);
		$this->setOption('fileType',strtolower($arrStr[count($arrStr)-1]));
		$this->setOption('fileSize',$size);

		return true;
	}
	
	//用来获取上传后的文件名
	function getNewFileName(){
		return $this->newFileName;
	}
	
    //上传失败，调用这个方法，查看错误报告
	function getErrorMsg(){
		return $this->errorMess;
	}
	
	//获取上传后文件的大小
	function getFileSize(){
		return $this->fileSize;
	}
}








?>