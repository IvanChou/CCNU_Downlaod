/**
 * Use for ccun_download
 * 
 * @author	ichou
 * @version	v1.0 (2012-11-20)
 * @requires jQuery v1.6 or later
 */

(function(window, document, $, undefined){
	
	function set_footer () {
		var window_height = window.innerHeight;
		var body_height = document.body.clientHeight;
		window_height>body_height && (footer_top = window_height - body_height +10);
		$(".footer").css('margin-top',footer_top);
	  
	}
	
	$(document).ready(function(){
		set_footer();
	})
	
}(window,document,jQuery))
