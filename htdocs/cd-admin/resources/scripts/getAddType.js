function getAddType(){
	var add_type = document.getElementById('add_type').value;
	var choose_soft = document.getElementById('choose_soft');
	var physical_name = document.getElementById('physical_name');
	var http_add = document.getElementById('http_add');
	var ftpsoftname = document.getElementById('ftpsoftname');
	if(add_type=='ftp'){
		choose_soft.setAttribute('style','display:none;');
		http_add.setAttribute('style','display:none;');
		physical_name.setAttribute('style','display:normal;');
		ftpsoftname.setAttribute('style','display:normal;width:160px !important;');
	}else{
		choose_soft.setAttribute('style','display:normal;');
		http_add.setAttribute('style','display:normal;');
		physical_name.setAttribute('style','display:none;');
		ftpsoftname.setAttribute('style','display:none;');
	}
}