<?php /*
Template Name: Nova Home
*/


remove_action('genesis_loop', 'genesis_do_loop');
/**
 * Example function that replaces the default loop
 * with a custom loop querying 'PostType' CPT.
*/
//add_action('genesis_loop', 'loop_medio');
add_action( 'genesis_before_loop', 'loop_medio' ); // Adds your custom page code/content
add_action('genesis_after_loop', 'loop_novidades');
add_action('genesis_after_loop', 'loop_audio_videos');
function loop_medio() {

		echo '<section id="second-featured">';

		$Posts_Destaques2 = new WP_Query();
		$Posts_Destaques2->query( array(
			'post_type' => array(
				'post',
				'event',
				'audioevideo',
				'espresso_events'
				),
			'meta_key'=>'wpcf-gn_post_destaques',
			'meta_value'=>'destaque_medio',
			'posts_per_page'=>'2'
			)
		);

		while ($Posts_Destaques2->have_posts()) : $Posts_Destaques2->the_post();

		include (STYLESHEETPATH . '/functions-layout.php');
		?>
		<article <?php post_class(); ?>>
				<?php echo the_post_thumbnail('home-destaque-medio');?>
				<header>
					<h2><a href="<?php echo get_permalink();?>"> <?php the_title();?></a></h2>
				</header>
				<p class="entry-meta">Por <?php the_author(); ?></p>
				<div class="entry-content">
					<?php the_content_limit(339);?>
				</div>
			</article>
		<?php endwhile;
		echo '</section>';
}

function loop_novidades() {
	global $paged;

	echo '<section id="third-featured">';
	echo '<h3 class="title">Novidades</h3>';

	$Posts_Outros = new WP_Query();
		$Posts_Outros->query( array(
			'post_type' => array(
				'post',
				'event',
				'audioevideo',
				'espresso_events'
				),
			'meta_key'=>'wpcf-gn_post_destaques',
			'meta_value'=>'destaque_novidade',
			'posts_per_page'=>'5'
			)
		);
		while ($Posts_Outros->have_posts()) : $Posts_Outros->the_post();
		include (STYLESHEETPATH . '/functions-layout.php');
		?>
		<article <?php post_class(); ?>>
			<header>
				<h4><a href="<?php echo get_permalink();?>"> <?php the_title();?></a></h4>
			</header>
			<?php if (get_post_type($post)!== 'espresso_events' ) { ?><p class="entry-meta">Por <?php the_author(); ?></p><?php } ?>
				<div class="entry-content">
					<?php the_content_limit(150);?>
				</div>
			</article>
		<?php endwhile;
	echo '</section>';
}

function loop_audio_videos() {
	global $paged;

	echo '<section id="audiovideo-featured">';
	echo '<h3 class="title">Áudio e vídeo</h3>';

	$Posts_Outros = new WP_Query();
		$Posts_Outros->query( array(
			'post_type' => array(
				'audioevideo'
				),
			'posts_per_page'=>'3'
			)
		);
		while ($Posts_Outros->have_posts()) : $Posts_Outros->the_post();
		include (STYLESHEETPATH . '/functions-layout.php');
		?>
		<article <?php post_class(); ?>>
				<div class="entry">
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('video-thumb');
						}
					?>
					<p class="kicker"><?php $resource = get_the_term_list( $post->ID, 'audiosevideos', ' ' ,', '); echo $resource; ?></p>
					<h4><a href="<?php echo get_permalink();?>"> <?php the_title();?></a></h4>
					<p class="entry-meta">Por <?php the_author(); ?></p>
				</div>
			</article>
		<?php endwhile;
	echo '</section>';
}

genesis();