<?php /* 
Template Name: Archive Page - espresso_events
*/ 

//* Add support for Genesis Grid Loop
remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'special_loop');//add the special loop

function special_loop() {
	global $post;
	$event_class = has_excerpt( $post->ID ) ? ' has-excerpt' : '';
	$event_class = apply_filters( 'FHEE__content_espresso_events__event_class', $event_class );
	echo "<h1>Eventos</h1>";
	echo "<h3>Próximos eventos</h3>";
	if (have_posts()) :
		while (have_posts()) : the_post();
		include (STYLESHEETPATH . '/functions-layout.php');
		?>
	<article <?php post_class('clearfix'); ?>  itemscope itemtype="http://schema.org/Event">
	<div id="espresso-event-list-header-dv-<?php echo $post->ID;?>" class="espresso-event-header-dv">
		<?php espresso_get_template_part( 'content', 'espresso_events-thumbnail' ); ?>
		<?php espresso_get_template_part( 'content', 'espresso_events-header' ); ?>
	</div>

	<div class="espresso-event-list-wrapper-dv">
		<?php espresso_get_template_part( 'content', 'espresso_events-datetimes' ); ?>
		<?php espresso_get_template_part( 'content', 'espresso_events-details' ); ?>
		<?php espresso_get_template_part( 'content', 'espresso_events-tickets' ); ?>
		<?php espresso_get_template_part( 'content', 'espresso_events-venues' ); ?>
	</div>
	</article>
	<?php
 	 endwhile;
 	 genesis_numeric_posts_nav();
endif;
}
//* Remove the post meta function for front page only
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
 
genesis();