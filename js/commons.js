jQuery(function($) {
	$(document).ready(function(){
		$(".menu").tinyNav({
			active:	'current-menu-item', // String: Set the "active" class
			header:	'Menu', // String: Specify text for "header" and show header instead of the active item
			label:	'' // String: Sets the <label> text for the <select> (if not set, no label will be added)
		});
	});
	function hideAddressBar()
	{
	  if(!window.location.hash)
	  {
	      if(document.height < window.outerHeight)
	      {
	          document.body.style.height = (window.outerHeight + 50) + 'px';
	      }
	 
	      setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
	  }
	}
	 
	window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
	window.addEventListener("orientationchange", hideAddressBar );
});