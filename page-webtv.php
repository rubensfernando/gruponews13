<?php /* 
Template Name: Page - webtv
*/ 
remove_action('genesis_sidebar', 'genesis_do_sidebar');//remove genesis sidebar
add_action('genesis_sidebar', 'sibebar_webtv');//add the special genesis sidebar

remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'loop_webtv_single');//add the special loop

add_action( 'wp_head', 'add_javascript_webtv_head' );
add_action( 'genesis_after_footer', 'add_javascript_webtv' );

function add_javascript_webtv_head() {
	echo '<script src="'. get_stylesheet_directory_uri() .'/js/jwplayer.js"></script>';
	echo '<script src="'. get_stylesheet_directory_uri() .'/css/jquery.countdown.css"></script>';
	echo '<script src="'. get_stylesheet_directory_uri() .'/js/jquery.countdown.min.js"></script>';
	echo '<script src="'. get_stylesheet_directory_uri() .'/js/jquery.countdown-pt-BR.js"></script>';
	echo '<script>jwplayer.key="XAUG+uaHco6ekMS25hfNDbPRrRlqCMnLA7mXCw=="</script>';
}
	
function add_javascript_webtv() {
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/jquery.fitvids.js"></script>';
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/videos.js"></script>';
	echo do_shortcode('[events_list scope="future" category="35" limit="1"]<script type="text/javascript">var newYear = new Date(); newYear = new Date(#Y, #m -1, #j, #G, #i); jQuery(function($) { $.countdown.setDefaults($.countdown.regional["pt-BR"]); $("#contadorProximo").countdown({until: newYear})}); </script> [/events_list]');
    echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/jquery.jplayer.min.js"></script>';
}

function sibebar_webtv() {
	echo '<div id="next-live" class="widget"><h4>Próxima transmissão</h4>';
	echo '<span id="contadorProximo"></span></div>';
	echo '<div id="next-times" class="widget"><h4>Próximos horários</h4>';
	echo do_shortcode('<ul>[events_list_grouped mode="daily" scope="future" category="35" limit="5" date_format="j.M" ]<li><strong>#_24HSTARTTIME</strong> #_EVENTNAME</li>[/events_list_grouped]</ul>
	<p class="small" style="padding: 15px;">Os horários e as datas das atividades podem ser alterados sem aviso prévio.</p></div>');
}




function loop_webtv_single() {
	if (have_posts()) :
		while (have_posts()) : the_post();
		include (STYLESHEETPATH . '/functions-layout.php');

		$title=urlencode("Transmissão ".$webtv_palestra." - GrupoNews");
		$url=urlencode('http://www.gruponews.com.br/webtv');
		$summary=urlencode('Estou assistindo "'.$webtv_palestra.'"');
		
		?>
			<h1 class="entry-title"><?php echo($webtv_palestra); ?></h1>
			<div id='video'></div>
						 <?php
						 	$fileFlash;
							$fileIos;
							
						 	if ($webtv_sistema == 0) {
						 		if ($webtv_qualidade == 0){
						 			$fileFlash = "flash-mbr.xml";
									$fileIos = "ios-mbr.xml";
						 		} else if ($webtv_qualidade == 1) {
									$fileFlash = "flash.xml";
									$fileIos = "ios.xml";
								 }

						?>

						<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jwplayer_old.js"></script>
						<script type="text/javascript">
							jwplayer("video").setup({
								id : "playerID",
								width : "580",
								height : "326",
								file : "/files_media/<?php echo $fileFlash; ?>",
									modes : [{
										type : "flash",
										src : "/files_media/player.swf"
									}, {
										type : "html5",
										config : {
										file : "/files_media/<?php echo $fileIos; ?>"
									}
								}]
							});
						</script>
						<?php } elseif ($webtv_sistema == 1) {; ?>
			
						<iframe src="http://www.ustream.tv/embed/677618" width="580" height="326" scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>
						<?php } ?>
			<p class="small">Se você está tendo problemas de visualização da transmissão ao vivo, por favor, atualize a página e tente novamente.</p>
			<div id="social-share">
				<p>Você quer contar para alguem sobre essa transmissão</p>
				<p><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&amp;','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="facebook">Facebook</a> | <a href="https://twitter.com/share?url=http://www.gruponews.com.br/webtv&via=gruponews&text=<?php echo 'Estou acompanhando "'.$webtv_palestra.'"' ?>" class="twitter">twitter</a></p>
			</div>
			<div id="chat">		
				<h2>Chat</h2>		
				<div class="fb-comments" data-href="//www.gruponews.com.br/webtv" data-width="580" data-num-posts="10"></div>
			</div>
			
			
		<?php endwhile;
				endif;
				}
				genesis();
			