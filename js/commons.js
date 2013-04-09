jQuery(function($) {
	$(document).ready(function(){
		$(".menu").tinyNav({
			active:	'current-menu-item', // String: Set the "active" class
			header:	'Menu', // String: Specify text for "header" and show header instead of the active item
			label:	'' // String: Sets the <label> text for the <select> (if not set, no label will be added)
		});
	});
});