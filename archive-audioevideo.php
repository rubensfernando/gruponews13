<?php /* 
Template Name: Archive Page - Audio e video
*/ 

//remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );

remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'special_loop');//add the special loop

add_action( 'genesis_meta', 'add_javascript_video_head' );
add_action( 'genesis_after_footer', 'add_javascript_video' );

function add_javascript_video_head() {
	echo '<script src="'. get_stylesheet_directory_uri() .'/js/jwplayer.js"></script>';
	echo '<script>jwplayer.key="XAUG+uaHco6ekMS25hfNDbPRrRlqCMnLA7mXCw=="</script>';
}

function add_javascript_video() {
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/jquery.fitvids.js"></script>';
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/videos.js"></script>';

    echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/jquery.jplayer.min.js"></script>';
}

function special_loop() {?>
	
	<h1 class="post"><?php post_type_archive_title(); ?></h1>

	<?php
	if (have_posts()) :
		while (have_posts()) : the_post();
		include (STYLESHEETPATH . '/functions-layout.php');
	?>
	<div <?php post_class('clearfix'); ?> >
		<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('video-thumb');
			} 
		?>
		<div class="details-info">
			<h3 class="entry-title"><a href="<?php echo post_permalink(); ?>"> <?php the_title(); ?></a></h3>	
			<?php 
				the_excerpt();	
				$post_info = __( 'By', 'genesis' ) .' '.  get_the_term_list( $post->ID, 'autor', ' ' ,', ') .' | '.  get_the_term_list( $post->ID, 'tipo', ' ' ,', ') . ' [post_edit]';
				printf( '<div class="post-info">%s</div>', apply_filters( 'genesis_post_info', $post_info ) );
				
			?>
		</div>
	</div>
	<?php
	 endwhile;
	 genesis_numeric_posts_nav();
endif;
}

genesis();