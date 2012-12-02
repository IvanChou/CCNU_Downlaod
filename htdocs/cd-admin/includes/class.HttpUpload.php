<?php
class Upload
{
    private $allowTypes     = array('gif','jpg','png','bmp','exe','wmv','txt','avi','rmvb','psd','doc','rar','zip','7z','msi','lzh');
    private $uploadPath     = null;
    private $maxSize        = 419430400;
    private $msgCode        = null;

    public function __construct($options = array())
    {
        //取类内的所有变量
        $vars = get_class_vars(get_class($this));
        //设置类内变量
        foreach ($options as $key=>$value) {
            if (array_key_exists($key, $vars)) {
                $this->$key = $value;
            }
        }
    }
    
    public function fileUpload($myfile,$soft_name,$os,$description,$term,$tag)
    {
        $name       = $myfile['name'];
        $tmpName    = $myfile['tmp_name'];
        $error      = $myfile['error'];
        $size       = $myfile['size'];
		//$MIMEtype   = $myfile['type'];
		
	    if (!empty($description)) {
			$d = trim($description);
		} else {
			$d = 'NULL';
		}
	   
	   if (!empty($soft_name)) {
			$name2 = trim($soft_name);
		} else {
			$name2 = 'NULL';
		}
		
		if(!empty($os)){
			$os = trim($os);
		}else{
			$os ='NULL';
		}
        //检查上传软件的大小 or 类型 and 上传的目录
        if ($error > 0) {
            $this->msgCode = $error;
            return false;
        } 
		elseif (!$this->checkType($name)) {
            return false;
        } 
		elseif (!$this->checkSize($size)) {
            return false;
        } 
		elseif (!$this->checkUploadFolder()) {
            return false;
        }
		//向数据库添加记录
		$file_rename = $this->randFileName($name);
		$url = "cd-resource/$term/$file_rename";
		$query = $this->insertTable($name2,$os,$url,$size,$d,$term,$tag);
		
		if($query == '软件类别选择错误'){
			$this->msgCode = -6;
			return false;
		}else if($query == '数据添加失败'){
			$this->msgCode = -7;
			return false;
		}else{
			$newFile = $this->uploadPath . '/' . $file_rename;
		    $upload_id = mysql_insert_id();
			$this->var = $upload_id;
		}
		
        //复制软件到上传目录
        if (!is_uploaded_file($tmpName)) {
            $this->msgCode = -3;
			$this->deleteTable($upload_id);
            return false;
        } elseif(move_uploaded_file($tmpName, $newFile)) {
            $this->msgCode = 0;
            return true;
        } else {
            $this->msgCode = -3;
			$this->deleteTable($upload_id);
            return false;
        }
    }

    /*
    * 检查上传软件的大小有没有超过限制
    */
    private function checkSize($size)
    {
        if ($size > $this->maxSize) {
            $this->msgCode = -2;
            return false;
        } else {
            return true;
        }
    }

    /*
    * 检查上传软件的类型
    */
    private function checkType($fileName)
    {
        $arr = explode(".", $fileName);
        $type = end($arr);
        if (in_array(strtolower($type), $this->allowTypes)) {
            return true;
        } else {
            $this->msgCode = -1;
            return false;
        }
    }
	/*
	* 开始上传前向数据库添加记录
	*/
	private function insertTable($name2,$os,$url,$size,$d,$term,$tag){
		//$this->status = false;
		if($term == 0){
			$this->status = '软件类别选择错误';
		}else{
			$query = "INSERT INTO `cd_softs` (soft_name, soft_os,soft_url,term_id,tag_id,soft_size,soft_description,post_time) VALUES ('$name2','$os','$url',$term,$tag,$size, '$d',now())";
		    mysql_query("set names utf8");
		    $result = mysql_query ($query) or die(mysql_error());
			if(!$result){
				$this->status = '数据添加失败';
			}else{
				$this->status = '向数据库添加记录成功';
			}
		}
		return $this->status;
	}
	
	/*
	*删除数据库的记录
	*/
	private function deleteTable($upload_id){
		$query = "DELETE FROM `cd_softs` WHERE ID = $upload_id";
		$result = mysql_query ($query) or die(mysql_error());
	}

	
    /*
    * 检查上传的目录是否存在,如不存在尝试创建
    */
    private function checkUploadFolder()
    {
        if (null === $this->uploadPath) {
            $this->msgCode = -5;
            return false;
        }

        $this->uploadPath = rtrim($this->uploadPath,'/');
        $this->uploadPath = rtrim($this->uploadPath,'\\');

        if (!file_exists($this->uploadPath)) {
            if (mkdir($this->uploadPath, 0755)) {
                return true;
            } else {
                $this->msgCode = -4;
                return false;
            }
        } elseif(!is_writable($this->uploadPath)) {
            $this->msgCode = -3;
            return false;
        } else {
            return true;
        }
    }

    /*
    * 生成随机软件名
    */
    private function randFileName($fileName)
    {
        $arr = explode(".",$fileName);
		$file_extend = end($arr);
        $newFile = date("YmdHis").'_'.rand(1000,9999);
        return $newFile . '.' . $file_extend;
    }

    /*
    * 取上传的结果和信息
    */
    public function getStatus()
    {
        $messages = array(
            4   => "没有软件被上传！",
            3   => "软件只被部分上传！",
            2   => "上传软件超过了HTML表单中MAX_FILE_SIZE选项指定的值！",
            1   => "上传软件超过了php.ini 中upload_max_filesize选项的值！",
            0   => "软件上传成功！",
            -1  => "末充许的类型！",
            -2  => "软件过大，上传软件不能超过{$this->maxSize}个字节！",
			-3  => "软件上传失败！",
            -4  => "建立存放上传软件目录失败，请重新指定上传目录！",
            -5  => "必须指定上传软件的路径！",
			-6  => "软件类别选择错误，上传失败！",
			-7  => "向数据库添加记录失败，软件没有上传！"
        );

        return array( 'message'=>$messages[$this->msgCode]);
    }
	
	/*
    * 返回`cd_softs`的ID值
    */
	public function getId(){
		return $this->var;
	}

}
?>