function check(){
	var soft_name = document.getElementById('soft_name').value;
	var firstmenu = document.getElementById('firstmenu').value;
	if (firstmenu==""){
		alert("请选择软件类别！");
		document.getElementById('firstmenu').focus();
		return false;
	}
	if (soft_name==""){
		alert("请填写软件名称！");
		document.getElementById('soft_name').focus();
		return false;
	}
}