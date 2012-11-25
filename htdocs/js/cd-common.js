/**
 * Use for ccun_download
 * 
 * @author	ichou
 * @version	v1.0 (2012-11-20)
 * @requires jQuery v1.6 or later
 */

(function(window, document, $, undefined){
	
	function search () {
		var key,url;
		var str_1 = "请输入搜索关键字";
		var str_2 = "搜索怎能漫无目的~"
		
		$("#keywords").focus(function() {
			$(this).val() == str_1 && $(this).val("");
			$(this).val() == str_2 && $(this).val("");
		});
		
		$("#keywords").blur(function() {
			$(this).val() == "" && $(this).val(str_1);
		});
		
		$("#keywords").keyup(function(){
        	if(event.keyCode == 13) $("#button").click();
        });
		
		$("#button").click(function() {
			key = $("#keywords").val();
			if(key == str_1 || key == str_2) key = "";
			key && (url = "http://"+window.location.host+"/index.php/search/"+key);
			if(url){
				window.location.href = url;
			}else{
				$("#keywords").val(str_2);
			}
		});
	}
	
	function show_needs () {
		$("#need").find("dl").hover(
			function() {
				$("#need").find("dl").removeClass('current');
				$(this).addClass('current');
			}
		)
	}
	
	function hover_often () {
		$("#often").find("li:first").addClass('first');
		var t;
		
		$("#often").find("li").hover(
			function() {
				clearTimeout(t);
				$("#often").find("li").removeClass('first');
				$(this).addClass('first');
			},
			function() {
				t = setTimeout(function(){
					$("#often").find("li").removeClass('first');
			  		$("#often").find("li:first").addClass('first');
				},400)
			}
		)
	}
	
	function set_footer () {
		var window_height = window.innerHeight;
		var body_height = document.body.clientHeight;
		if(window_height>body_height){
			footer_top = window_height - body_height +10;
			$(".footer").css('margin-top',footer_top);
		}
	}
	
	$(document).ready(function(){
		set_footer();
		show_needs();
		hover_often();
		search();
	})
	
}(window,document,jQuery))
