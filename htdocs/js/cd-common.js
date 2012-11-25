/**
 * Use for ccun_download
 * 
 * @author	ichou
 * @version	v1.0 (2012-11-20)
 * @requires jQuery v1.6 or later
 * @requires jquery.blackbox.min
 */

(function(window, document, $, undefined){
	
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
	
	function like () {
		var url;
		$(".agree").click(function() {
			url = $(this).attr("href");
			$.get(url,function(result){
				$.alert(result);
			})
			return false;
		});
	}
	
	function unlike () {
		var url;
		$(".disagree").click(function() {
			url = $(this).attr("href");
			$.get(url,function(result){
				$.alert(result);
			})
			return false;
		});
	}
	
	function comment () {
		var url,name,text,id;
		var html;
		$("#comment").find("input:submit").click(function() {
			url = $("#comment").find("form").attr("action");
			id = $("#comment").find("input:hidden").val();
			text = $("#comment").find("textarea").val();
			name = $("#comment").find("input:text").val();
			
			if(url == "" || id == "") {
				$.alert("貌似这个网页有问题了，去联系管理员吧~");
				return false;
			}
			if(name == "") {
				$.alert("着什么急，名字还没填呢~");
				return false;
			}
			if(text == "") {
				$.alert("评论框有这么大块空白白，你确定不写点什么？");
				return false;
			}
			
			$.confirm("哟，这的评论好像有点营养，确认发布吗？",{
				onCancel:function(){$.alert("亲。。你居然点击了取消。。那么，拜拜，再见。。")},
				onConfirm:function(){
					$.post(url,{'soft-id':id,'content':text,'name':name},function(result){
						$.alert(result,function(){
							if(result.indexOf("OK") != -1){
								html = '<li style="display:none;"><span class="name">'+name+'</span>';
								html += '<span class="time">发表于 刚刚 </span>';
								html += '<p>'+text+'</p></li>'
								$("#soft-comment").find("ul").append(html);
								$("#comment").find("textarea").val("");
								$("#soft-comment").find("li:last").fadeIn(800);
							}
						});
					})
				}
			})
			
			return false;
		});
	}
	
	$(document).ready(function(){
		set_footer();
		show_needs();
		hover_often();
		search();
		like();
		unlike();
		comment();
	})
	
}(window,document,jQuery))
