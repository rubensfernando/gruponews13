<?php
/** Start the engine */
require_once(TEMPLATEPATH.'/lib/init.php');


/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
add_action('genesis_before', 'facebook_sdk');
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
add_action('genesis_before_loop', 'breadcrumb_new');
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

function breadcrumb_new() {
	if ( is_home() == false && function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
	}
}
add_action( 'genesis_footer', 'add_javascript' );
function add_javascript() {
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/commons.js"></script>';
    echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/tinynav.min.js"></script>';
}
/** Reposition the secondary navigation menu */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

add_action('genesis_after_header','themedy_post_carousel');
function themedy_post_carousel() {
		if (is_home()) {
			if ( is_active_sidebar('top-featured-area') ) : ?>
				<div id="featured_area">
					<div class="wrap">
						<?php dynamic_sidebar('Top Featured Area') ; ?> 
					</div>
				</div>
				<?php 
			endif;
		} 
	}

//Registration Users
add_action( 'wpmem_post_register_data', 'changeFields');
add_action( 'wpmem_post_update_data', 'changeFields');

function changeFields( $fields )
{
	$id = $fields['ID'];
	$newDate = datasql($fields['dbem_bday']);
	
	update_user_meta( $id, 'dbem_bday', $newDate );
}
function datasql($databr) {
	if (!empty($databr)){
	$p_dt = explode('/',$databr);
	$data_sql = $p_dt[2].'-'.$p_dt[1].'-'.$p_dt[0];
	return $data_sql;
	}
}


//Events
// remove_action( 'show_user_profile', array('EM_User_Fields','show_profile_fields'), 1 );
// remove_action( 'edit_user_profile', array('EM_User_Fields','show_profile_fields'), 1 );
// remove_action( 'personal_options_update', array('EM_User_Fields','save_profile_fields') );
// remove_action( 'edit_user_profile_update', array('EM_User_Fields','save_profile_fields') );


//Commerce
add_theme_support( 'genesis-connect-woocommerce' );


/*-------------------------------------------------*/
// Shortcodes
/*-------------------------------------------------*/

	//include(OF_FILEPATH . '/admin/shortcode.php');


function facebook_sdk() {
	echo '<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=386896871405591";
fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>';
}

/*-------------------------------------------------*/
// Additional Stylesheets
/*-------------------------------------------------*/

	//add_action( 'wp_print_styles', 'of_print_styles' );

	function of_print_styles() {
		wp_register_style( 'custom-editor-style-css', get_stylesheet_directory_uri().'/admin/formatting-buttons/custom-editor-style.css' );
		wp_enqueue_style( 'custom-editor-style-css' );	
	}

/*-------------------------------------------------*/
// Enable Shortcode in the Widget Area
/*-------------------------------------------------*/

	add_filter('widget_text', 'do_shortcode');

/*-------------------------------------------------*/
// Shortcode CSS
/*-------------------------------------------------*/

	add_action('admin_enqueue_scripts', 'codes_admin_init');  

	function codes_admin_init(){

		global $current_screen;



		if($current_screen->base=='post'){

		//enqueue the script and CSS files for the TinyMCE editor formatting buttons

			wp_enqueue_script('jquery');

			wp_enqueue_script('jquery-ui-dialog');

			wp_enqueue_script('jquery-ui-core');

			wp_enqueue_script('jquery-ui-sortable');



		//set the style files

			add_editor_style('admin/formatting-buttons/custom-editor-style.css');

			wp_enqueue_style('page-style',get_stylesheet_directory_uri().'/css/page_style.css');

			wp_enqueue_style('jquery_ui_css',get_stylesheet_directory_uri().'/css/jquery-ui.css');



		}

	}


/*-------------------------------------------------*/
// Thumbs
/*-------------------------------------------------*/

genesis_add_image_size('home-destaque-maior', 960, 353, true);
genesis_add_image_size('home-destaque-medio', 191, 185, true);
genesis_add_image_size('video-thumb', 185, 104, true);
genesis_add_image_size('materia', 580, 213, true);


/*-------------------------------------------------*/
// Control Excerpt Length
/*-------------------------------------------------*/

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*-------------------------------------------------*/
// Widgets
/*-------------------------------------------------*/
genesis_register_sidebar(array(
	'name' 			=> 'Top Featured Area', 
	'id' 			=> 'top-featured-area',
	'description' 	=> 'This is the top featured area above all content.', 
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>',
	'before_title' 	=> '<h3>', 
	'after_title' 	=> '</h3>'
	));

