//AJAX无刷新分页
var cache=new Array();
function setPage(url){
	var obj=document.getElementById("tab1");
	if(typeof(cache[url])=="undefined"){
		var ajax=Ajax();
		ajax.get(url,function(data){
			obj.innerHTML=data;
			cache[url]=data;	
		});
	}else{
		obj.innerHTML=cache[url];	
	}	
}
setPage("./discuss/list.php?page=1");