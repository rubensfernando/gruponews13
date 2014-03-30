<?php /* 
Template Name: Single Page - Audio e video
*/ 

//remove_action( 'genesis_before_entry_content', 'genesis_post_info' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single' );

remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'loop_audioevideo_single');//add the special loop

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

function loop_audioevideo_single() {
	if (have_posts()) :
		while (have_posts()) : the_post();
		include (STYLESHEETPATH . '/functions-layout.php');
		
		$lnk_video = types_render_field("gn_audiovideo_video", array("raw" => "TRUE"));
		$lnk_annotations = types_render_field("gn_audiovideo_anotacoes", array("raw" => "TRUE"));
		$lnk_audio = types_render_field("gn_audiovideo_audio", array("raw" => "TRUE"));
	?>
	<div <?php post_class(); ?> >
		<div class="video-wrapper"> 
			<?php
				if ($lnk_video !="" ) {
			?>
				<div id='video'></div>
				<script type='text/javascript'>
					jwplayer('video').setup({
						file: '<?php echo(types_render_field("gn_audiovideo_video", array("raw" => "TRUE"))); ?>',
						width: "580",
						height: "326"
					});
				</script>
			<?php } else {
				if ( has_post_thumbnail() ) {
					the_post_thumbnail("materia");
				}?>
				
					<div id='audio'></div>
				<script type='text/javascript'>
					jwplayer('audio').setup({
						file: '<?php echo(types_render_field("gn_audiovideo_audio", array("raw" => "TRUE"))); ?>',
						width: "580",
						height: "15"
					});
				</script>
				<?php } 
										
					function add_post_content($content) {
							$linksContent = '';
							$linkAudio = '';
							$linkAnnotations = '';
							if ( $lnk_annotations != '' ) {
								$linkAnnotations = '<li><a href="'. $lnk_annotations .'">Anotação/Apresentação (PDF)</a></li>';
							};
							if ( $lnk_audio != '' ) {
								$linkAudio = '<li><a href="'. $lnk_audio .'">Download MP3</a></li>';
							}
							$content .= '<div class="details-link"><ul>'.$linkAnnotations.$lnk_audio.'</ul></div>'; ?>
						<?php   return $content;
					}
					add_filter('the_content', 'add_post_content');
					
				?>
		<div class="details-info">
			<h1 class="entry-title"><?php the_title(); ?></h1>	
			
			<div class="details-link">
			<ul>
			<?php
				if ($lnk_annotations != "" ) { ?>
					<li><a href='<?php echo($lnk_annotations); ?>'>Anotação/Apresentação (PDF)</a></li>
			<?php
				}
				if ($lnk_audio != "" ) { ?>
					<li><a href="<?php echo($lnk_audio); ?>">Download MP3</a></li>
			<?php
				}
			?>	
			</ul>
			<?php 
				//$post_info = '[post_date] ' . __( 'By', 'genesis' ) .' '.  get_the_term_list( $post->ID, 'autor', ' ' ,', ') . ' [post_comments] [post_edit]';
				//printf( '<div class="post-info">%s</div>', apply_filters( 'genesis_post_info', $post_info ) );
				the_content();
			?>
		</div>
		</div>
	</div>
	<?php
	 endwhile;
endif;
}

genesis();