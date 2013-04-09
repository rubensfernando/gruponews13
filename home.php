<?php /* 
Template Name: Nova Home
*/ 


remove_action('genesis_loop', 'genesis_do_loop');
/**
 * Example function that replaces the default loop
 * with a custom loop querying 'PostType' CPT.
*/
//add_action('genesis_loop', 'loopMedio');
add_action( 'genesis_before_loop', 'loopMedio' ); // Adds your custom page code/content
add_action('genesis_after_loop', 'loopNovidades');
add_action('genesis_after_loop', 'loopAudioVideos');
function loopMedio() {

		echo '<div id="second-featured">';

		$Posts_Destaques2 = new WP_Query();
		$Posts_Destaques2->query( array(
			'post_type' => array(
				'post',
				'event',
				'audioevideo'
				),
			'meta_key'=>'wpcf-gn_post_destaques',
			'meta_value'=>'destaque_medio',
			'posts_per_page'=>'2'
			)
		);

		while ($Posts_Destaques2->have_posts()) : $Posts_Destaques2->the_post();
		

		include (STYLESHEETPATH . '/functions-layout.php');
		?>
		<div <?php post_class(); ?>>
				<?php echo the_post_thumbnail('home-destaque-medio');?>
				<div class="entry">
					<h2><a href="<?php echo get_permalink();?>"> <?php the_title();?></a></h2>
						<?php the_content_limit(339);?>
				</div>
			</div>
		<?php endwhile;
		echo '</div>';
}

function loopNovidades() {
	global $paged;

	echo '<div id="third-featured">';
	echo '<h3 class="title">Novidades</h3>';
	
	$Posts_Outros = new WP_Query();
		$Posts_Outros->query( array(
			'post_type' => array(
				'post',
				'event',
				'audioevideo'
				),
			'meta_key'=>'wpcf-gn_post_destaques',
			'meta_value'=>'destaque_medio',
			'posts_per_page'=>'5'
			)
		);
		while ($Posts_Outros->have_posts()) : $Posts_Outros->the_post();
		include (STYLESHEETPATH . '/functions-layout.php');
		?>
		<div <?php post_class(); ?>>
				<div class="entry">
					<h4><a href="<?php echo get_permalink();?>"> <?php the_title();?></a></h4>
						<?php the_content_limit(150);?>
				</div>
			</div>
		<?php endwhile;
	echo '</div>';
}

function loopAudioVideos() {
	global $paged;

	echo '<div id="audiovideo-featured">';
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
		<div <?php post_class(); ?>>
				<div class="entry">
					<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('video-thumb');
						} 
					?>
					<h4><a href="<?php echo get_permalink();?>"> <?php the_title();?></a></h4>
				</div>
			</div>
		<?php endwhile;
	echo '</div>';
}

genesis();