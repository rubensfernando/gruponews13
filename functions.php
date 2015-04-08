<?php
/** Start the engine */
require_once(TEMPLATEPATH.'/lib/init.php');

//* Add HTML5 markup structure
add_theme_support( 'html5' );

/*-------------------------------------------------*/
// Admin
/*-------------------------------------------------*/
// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();
// Add the Style Dropdown Menu to the second row of visual editor buttons
function my_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');
function my_mce_before_init($init_array) {
	// Now we add classes with title and separate them with;
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => '.translation',
			'block' => 'blockquote',
			'classes' => 'translation',
			'wrapper' => true,

		),
		array(
			'title' => '⇠.rtl',
			'block' => 'blockquote',
			'classes' => 'rtl',
			'wrapper' => true,
		),
		array(
			'title' => '.ltr⇢',
			'block' => 'blockquote',
			'classes' => 'ltr',
			'wrapper' => true,
		),
	);
	$init_array['theme_advanced_styles'] = json_encode( $style_formats );
	return $init_array;
}
add_filter('tiny_mce_before_init', 'my_mce_before_init');

/*-------------------------------------------------*/
// Head and Footer
/*-------------------------------------------------*/
/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
add_action('genesis_before', 'facebook_sdk');

/** Load custom favicon to header */
add_filter( 'genesis_pre_load_favicon', 'custom_favicon_filter' );
function custom_favicon_filter( $favicon_url ) {
    return '/favicon.ico';
}
function add_viewport_meta_tag() {
	echo '<meta name="apple-mobile-web-app-capable" content="yes" />';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
    echo '<link href="http://fonts.googleapis.com/css?family=Lora:400,400italic,700" rel="stylesheet" type="text/css">';
    echo '<link rel="stylesheet" id="child-theme-css"  href='.get_stylesheet_uri().' type="text/css" media="all" />';
    echo '<link rel="stylesheet" id="theme-css"  href="'.get_stylesheet_directory_uri().'/css/main.css" type="text/css" media="all" />';
}
add_action( 'genesis_footer', 'add_javascript' );
function add_javascript() {
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/commons.js"></script>';
    echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/tinynav.min.js"></script>';
}
add_filter('genesis_footer_creds_text', 'footer_creds_filter');
function footer_creds_filter( $creds ) {
    $creds = '<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Licença Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" /></a><br />Todo o conteúdo do site do GrupoNews está licenciado sob a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Atribuição-NãoComercial-SemDerivações 4.0 Internacional</a>.';
    return $creds;
}
/*-------------------------------------------------*/
// Top and Home
/*-------------------------------------------------*/

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

//remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
/*add_action('genesis_before_loop', 'breadcrumb_new');
function breadcrumb_new() {
	if ( is_home() == false && function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
	}
}*/

/*-------------------------------------------------*/
// Posts
/*-------------------------------------------------*/

//Add featured images on posts
add_filter('genesis_entry_header', 'add_content_featured');

function add_content_featured() {
	if ( !is_archive()) {
		if ( has_post_thumbnail() ) {
			if ( in_category( 'publicacoes' ) === true || in_category( 'jornal' ) === true || in_category( 'cds' ) === true || in_category( 'livros' ) === true) {
				the_post_thumbnail('publicacoes');
			} else {
				the_post_thumbnail('materia');
			}
		}
	}
}


/** Customize the post info function */
//add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
	if ( !is_page() &&  !is_post_type_archive('event') ) {
    	$post_info = 'Por '.  get_the_term_list( $post->ID, 'autor', ' ' ,', ') .' [post_edit]';
    	return $post_info;
	} else {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	}

}
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
	if ( !is_page() &&  !is_post_type_archive('espresso_events') ) {
		$post_info = 'Por <span itemprop="author">'.  get_the_term_list( $post->ID, 'autor', ' ' ,', ') .'</span> [post_edit]';
		return $post_info;
	} else {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	}
}
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );



function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*-------------------------------------------------*/
// Archive page
/*-------------------------------------------------*/

//Add titles on page
/**
 * Auto-generate taxonomy title for archive pages
 *
 * Will say "[Term] Archives"
 *
 */
add_action( 'genesis_before_loop', 'ac_do_taxonomy_title_description', 20 );
function ac_do_taxonomy_title_description() {
	global $wp_query;
	if ( ! is_category() && ! is_tag() && ! is_tax() )
		return;
	if ( get_query_var( 'paged' ) >= 2 )
		return;
	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
	if ( ! $term || ! isset( $term->meta ) )
		return;
	$headline = '';
	// If we have a headline already, then return, otherwise auto-generate
	if ( $term->meta['headline'] )
		return;
	else {
		$headline = sprintf( '<h1>%s</h1>', single_term_title( '', false ) );
		$lead = sprintf( '<p class="lead">%s</p>', tag_description() );
		printf( '<div class="taxonomy-description">%s %s</div>', $headline, $lead);
	}
}


/*-------------------------------------------------*/
// RSS
/*-------------------------------------------------*/


// show post thumbnails in feeds
function diw_post_thumbnail_feeds($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<div>' . get_the_post_thumbnail($post->ID, 'materia') . '</div>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'diw_post_thumbnail_feeds');
add_filter('the_content_feed', 'diw_post_thumbnail_feeds');


//Change author names on RSS

add_filter('the_author', 'guest_author_name');
add_filter('get_the_author_display_name', 'guest_author_name');
add_filter('article_author_facebook', 'author_name_og');

function guest_author_name($name) {
	global $post;

	$name = get_the_term_list( $post->ID, 'autor', ' ' ,', ');

	return $name;
}
function author_name_og() {
	if ( ! is_singular() ) {
		return false;
	}

	global $post;
	/**
	 * Filter: 'wpseo_opengraph_author_facebook' - Allow developers to filter the WP SEO post authors facebook profile URL
	 *
	 * @api bool|string $unsigned The Facebook author URL, return false to disable
	 */
	//$facebook = apply_filters( 'wpseo_opengraph_author_facebook', get_the_author_meta( 'facebook', $post->post_author ) );
	$facebook  = 'oi';
	if ( $facebook && ( is_string( $facebook ) && $facebook !== '' ) ) {
		$this->og_tag( 'article:author', $facebook );
		return true;
	}

	return false;
}
// Add custom post-types on RSS Feed
function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'audioevideo', 'event','espresso_events');
	return $qv;
}
add_filter('request', 'myfeed_request');

function gn_titlerss($content) {
	global $post, $EM_Category, $wp_query;

	$postid = $wp_query->post->ID;
	$posttype = $wp_query->post->post_type;

	//$events = EM_Events::get( array('limit'=>5, 'owner'=>false) );

	$events = get_the_terms( $post->ID, 'event-categories', ' ' ,', ') ;
	$out = array();

	if($posttype == "event") {
		foreach ( $events as $events ) $out[] = $events->name;
		if($events->term_id == 861){
			$content = 'Transmissão ao vivo '. $content;
		}
	} else {
		$content = $content;
	}
	return $content;
}
//add_filter('the_title_rss', 'gn_titlerss');

function changeUrlEvent($content) {
	global $post, $EM_Category, $wp_query;

	$posttype = $wp_query->post->post_type;
	$events = get_the_terms( $post->ID, 'event-categories', ' ' ,', ') ;

	if($posttype == "event") {
		foreach ( $events as $events ) $out[] = $events->name;
		if($events->term_id == 861){
			$content = 'http://www.gruponews.com.br/webtv';
		}
	} else {
		$content = $content;
	}
	return $content;
}
add_filter('the_permalink_rss', 'changeUrlEvent');
add_filter('comments_link_feed', 'changeUrlEvent');

function excludecatfeed($query) {
	if(is_feed()) {
		$query->set('event-categories','-861');
		$query->set('cat','-861');
		$query->set('term_id','-861');
		$query->set('tax_query',array(
				    'post_type' => 'event',
				    'tax_query' => array(
			            'taxonomy' => 'event-categories',
			            'field' => 'id',
			            'terms' => 861,
			        	'operator' => 'NOT IN' //you must set the operator to NOT IN
						)
					));
		return $query;
	}
}
//add_filter('pre_get_posts', 'excludecatfeed');

add_filter( 'FHEE__EE_Register_CPTs__register_CPT__rewrite', 'my_custom_event_slug', 10, 2 );
function my_custom_event_slug( $slug, $post_type ) {
	if ( $post_type == 'espresso_events' ) {
		$custom_slug = array( 'slug' => 'events' );
		return $custom_slug;
	}
	return $slug;
}

/*-------------------------------------------------*/
// Users Registration and Login pages
/*-------------------------------------------------*/
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
/*
add_action('init','possibly_redirect');
function possibly_redirect(){
	global $pagenow;
	if( 'wp-login.php' == $pagenow ) {
		wp_redirect(site_url('login', 'login'));
		exit();
	}
}
//register url fix
add_filter('register','fix_register_url');
function fix_register_url($link){
    return str_replace(site_url('wp-login.php?action=register', 'login'),site_url('usuario/cadastro', 'login'),$link);
}

//login url fix
add_filter('login_url','fix_login_url');
function fix_login_url($link){
    return str_replace(site_url('wp-login.php', 'login'),site_url('login', 'login'),$link);

}

//forgot password url fix
add_filter('lostpassword_url','fix_lostpass_url');
function fix_lostpass_url($link){
    return str_replace('?action=lostpassword','',str_replace(network_site_url('wp-login.php', 'login'),site_url('recuperar-senha?a=pwdreset', 'login'),$link));
}

add_filter('site_url','fix_urls',10,3);
function fix_urls($url, $path, $orig_scheme){
    if ($orig_scheme !== 'login')
        return $url;
    if ($path == 'wp-login.php?action=register')
        return site_url('usuario/cadastro', 'login');

    return $url;
}
*/

/*-------------------------------------------------*/
// Events Pages
/*-------------------------------------------------*/
// remove_action( 'show_user_profile', array('EM_User_Fields','show_profile_fields'), 1 );
// remove_action( 'edit_user_profile', array('EM_User_Fields','show_profile_fields'), 1 );
// remove_action( 'personal_options_update', array('EM_User_Fields','save_profile_fields') );
// remove_action( 'edit_user_profile_update', array('EM_User_Fields','save_profile_fields') );


/*-------------------------------------------------*/
// E-commerce pages
/*-------------------------------------------------*/
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

/*
//First remove all JS loaded in the head section
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
//Load JS at the footer of the template
add_action('wp_footer', 'wp_print_scripts', 1);
add_action('wp_footer', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_head_scripts', 1);
*/

add_filter( 'genesis_attr_body', 'change_schema' );
function change_schema( $attributes ){

		$post_type = get_post_type( get_the_ID() );

        // if About page, use the AboutPage schema
        if( is_page( 'quem-somos' ) )
            $attributes['itemtype'] = 'http://schema.org/AboutPage';

        // if Services page, use the ContactPage schema
        if( is_page( 'contato' ) )
            $attributes['itemtype'] = 'http://schema.org/ContactPage';

        if (is_single() && !is_page()) {
        	$attributes['itemtype'] = 'http://schema.org/Article';
        }

        if ( 'event' === $post_type || 'espresso_events' === $post_type) {
        	//echo "teste: ".$post_type;
        	$attributes['itemtype'] = 'http://schema.org/Events';
        }

        return $attributes;

}

add_filter( 'genesis_attr_entry', 'change_schema_events' );

function change_schema_events( $attributes ) {
	global $post;
	if ( 'event' === $post->post_type || 'espresso_events' === $post->post_type) {
		$attributes['itemscope'] = 'itemscope2';
		$attributes['itemtype']  = 'http://schema.org/Events';

		add_filter( 'genesis_attr_entry-title', function ($attributes) {
			$attributes['itemprop'] = 'name';
			return $attributes;
		});
		add_filter( 'genesis_attr_entry-image', function ($attributes) {
			$attributes['itemprop'] = 'image';
			return $attributes;
		});
	}
	return $attributes;
}


//Making jQuery Google API
function modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3');
		wp_enqueue_script('jquery');

		wp_deregister_script('jquery-ui-core');
		wp_register_script('jquery-ui-core', '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js', false, '1.9.2');
		wp_enqueue_script('jquery-ui-core');
	}
}
add_action('init', 'modify_jquery');

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

add_image_size('home-destaque-maior', 960, 353, true);
add_image_size('home-destaque-medio', 191, 185, true);
add_image_size('video-thumb', 185, 104, true);
add_image_size('materia', 580, 213, true);
add_image_size('publicacoes', 185, 204);

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

genesis_register_sidebar(array(
	'name' 			=> 'Sidebar Home',
	'id' 			=> 'sidebar-home',
	'description' 	=> 'Sidebar just show in homepage',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>',
	'before_title' 	=> '<h3>',
	'after_title' 	=> '</h3>'
	));

genesis_register_sidebar(array(
	'name' 			=> 'Sidebar webtv',
	'id' 			=> 'sidebar-webtv',
	'description' 	=> 'Sidebar just show in homepage',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>',
	'before_title' 	=> '<h3>',
	'after_title' 	=> '</h3>'
	));
