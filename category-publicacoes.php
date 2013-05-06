<?php /* 
Template Name: Archive Page - Publicações
*/ 

//remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );

remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'special_loop');//add the special loop

function special_loop() {?>
	
	<h1 class="post"><?php single_cat_title(); ?></h1>

	<?php
	if (have_posts()) :
		while (have_posts()) : the_post();
		include (STYLESHEETPATH . '/functions-layout.php');
	?>
	<div <?php post_class('clearfix'); ?> >
		<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('publicacoes');
			} 
		?>
		<div class="details-info">
			<h3 class="entry-title"><a href="<?php echo post_permalink(); ?>"> <?php the_title(); ?></a></h3>	
			<?php 
				$post_info =  '[post_edit]';
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