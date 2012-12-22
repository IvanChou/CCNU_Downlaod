//创建Ajax引擎
function getXmlHttpObject(){
	var xmlHttpRequest;
	if(window.ActiveXObject){
		xmlHttpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		xmlHttpRequest = new XMLHttpRequest();
	}
	return xmlHttpRequest;
}

var myXmlHttpRequest = "";
function getSecondMenus(){
	myXmlHttpRequest = getXmlHttpObject();
	if(myXmlHttpRequest){
		var url = "/cd-admin/soft/show_typePro.php";
		var data = "firstmenu="+document.getElementById('firstmenu').value;
		
		myXmlHttpRequest.open("post",url,true);//异步方式
		myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		myXmlHttpRequest.onreadystatechange=chuli;
		myXmlHttpRequest.send(data);
	}
}
function chuli(){
	if(myXmlHttpRequest.readyState==4){
		if(myXmlHttpRequest.status==200){
			//取出服务器回送的数据
			var secondmenu_names = myXmlHttpRequest.responseXML.getElementsByTagName("menuname");
			var secondmenu_nums = myXmlHttpRequest.responseXML.getElementsByTagName("num");
			
			//清零以防重复添加
			document.getElementById('secondmenu').length = 0;
			
			//遍历并取出一级栏目
			for(var i=0;i<secondmenu_names.length;i++){
				var second_name = secondmenu_names[i].childNodes[0].nodeValue;
				
				var second_num = secondmenu_nums[i].childNodes[0].nodeValue;
				//创建新的元素option
				var myOption = document.createElement("option");
				myOption.value = second_num;
				myOption.innerHTML = second_name;
				//添加进id为secondmenu的select元素作为子节点
				document.getElementById('secondmenu').appendChild(myOption);
			}
		}
	}
}