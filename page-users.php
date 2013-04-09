<?php /* 
Template Name: Page - Users
*/ 

function jquery_validate() {
	wp_enqueue_script(
		'jquery_validate',
		get_stylesheet_directory_uri() .'/js/jquery.validate.js',
		array( 'jquery' )
	);
	wp_enqueue_script(
		'jquery_validate_ptbr',
		get_stylesheet_directory_uri() .'/js/jquery.validate.pt-br.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'jquery_validate' );

add_action( 'wp_footer', 'wp29r01_print_scripts');
function wp29r01_print_scripts() {
    ?>
<link rel='stylesheet'  href='/wp-content/plugins/events-manager/includes/css/ui-lightness.css' type='text/css' media='all' />
<script type="text/javascript">
    jQuery(document).ready(function($) {
    	// Change formatDate
    	var d = $.datepicker.parseDate("yy-mm-dd", jQuery('#dbem_bday').val() );
    	var newDate = $.datepicker.formatDate( "dd\/mm\/yy", d );
    	jQuery('#dbem_bday').val(newDate);
    	
    	//Setting Datepicler
        jQuery('#dbem_bday').datepicker({ 	
        	dateFormat: "dd\/mm\/yy",
			altFormat: "yy-mm-dd", 
			changeMonth: true,
			changeYear: true
		});
		
		jQuery('#username').keypress(function (e) {
	     //if the letter is not digit then display error and don't type anything
	     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	     	 return false;
	    }
	   });
	   jQuery("#wpmem_reg form").validate({
	   	rules:	{
	   		username: {
	   			required: true
	   		},
	   		log: {
	   			required: true
	   		},
	   		first_name:{
	   			required: true
	   		},
	   		last_name:{
	   			required: true
	   		},
	   		dbem_sexo:{
	   			required: true
	   		},
	   		dbem_city:{
	   			required: true
	   		},
	   		dbem_state:{
	   			required: true
	   		},
	   		dbem_country:{
	   			required: true
	   		},
	   		dbem_bday:{
	   			required: true
	   		},
	   		password:{
	   			minlength: 6,
	   			required: true
	   		},
	   		password2: {
	   			equalTo: "#password"
	   		},
	   		user_email: {
	   			required: true,
	   			email: true
	   		}
	   	},
	   	message: {
	   		password_confirm:"As senhas não coincidirem"
	   	}
	   });
		
    })
</script>
    <?php
}

genesis();