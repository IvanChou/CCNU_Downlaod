//AJAX无刷新分页
var cachef=new Array();
function setPage(url){
	var objf=document.getElementById("tab1");
	if(typeof(cachef[url])=="undefined"){
		var ajaxf=Ajax();
		ajaxf.get(url,function(data){
			objf.innerHTML=data;
			cachef[url]=data;
		});
	}else{
		objf.innerHTML=cachef[url];	
	}	
}
setPage("./index/often.php?page=1");