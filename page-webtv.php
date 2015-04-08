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
	// echo '<script src="'. get_stylesheet_directory_uri() .'/css/jquery.countdown.css"></script>';
	// echo '<script src="'. get_stylesheet_directory_uri() .'/js/jquery.countdown.min.js"></script>';
	// echo '<script src="'. get_stylesheet_directory_uri() .'/js/jquery.countdown-pt-BR.js"></script>';
	echo'<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>';
}

function add_javascript_webtv() {
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/jquery.fitvids.js"></script>';
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/videos.js"></script>';
	//echo do_shortcode('[events_list scope="future" category="861" limit="1"]<script type="text/javascript">var newYear = new Date(); newYear = new Date(#Y, #m -1, #j, #G, #i); jQuery(function($) { $.countdown.setDefaults($.countdown.regional["pt-BR"]); $("#contadorProximo").countdown({until: newYear})}); </script> [/events_list]');
    echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/jquery.jplayer.min.js"></script>';
    echo '<script type="text/javascript">var _sf_async_config = { uid: 56413, domain: "gruponews.com.br", useCanonical: true };(function() {function loadChartbeat() { window._sf_endpt = (new Date()).getTime();var e = document.createElement("script");e.setAttribute("language", "javascript");e.setAttribute("type", "text/javascript");e.setAttribute("src","//static.chartbeat.com/js/chartbeat.js");document.body.appendChild(e);};var oldonload = window.onload;window.onload = (typeof window.onload != "function") ?loadChartbeat : function() { oldonload(); loadChartbeat(); };})();</script>';
}

// function sibebar_webtv() {
// 	echo '<div id="next-live" class="widget"><h4>Próxima transmissão</h4>';
// 	echo '<span id="contadorProximo"></span></div>';
// 	echo '<div id="next-times" class="widget"><h4>Próximos horários</h4>';
// 	echo do_shortcode('<ul>[events_list_grouped mode="daily" scope="future" category="861" limit="20" date_format="j.M" ]<li><strong>#_24HSTARTTIME</strong> #_EVENTNAME</li>[/events_list_grouped]</ul>
// 	<p class="small" style="padding: 15px;">Os horários e as datas das atividades podem ser alterados sem aviso prévio.</p></div>');
// }

function sibebar_webtv() {
	genesis_widget_area( 'sidebar-webtv', array(
			'before' => '<div class="after-post widget-area">',
			'after' => '</div>',
	) );
}

add_action('wp_footer', 'codetrack', 100);

function codetrack(){
	//echo ''<!-- Begin W3Counter Pulse Real-Time Heartbeat Code --><script type='text/javascript'>(function(){var ps = document.createElement('script');ps.type = 'text/javascript'; ps.async = true; ps.src = '//pulse.w3counter.com/pulse.js?id=41004'; (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(ps);})();</script><!-- End W3Counter Pulse Real-Time Heartbeat Code-->";
}

function loop_webtv_single() {
	if (have_posts()) :
		while (have_posts()) : the_post();
		include (STYLESHEETPATH . '/functions-layout.php');

		$title = urlencode("Transmissão ".$webtv_palestra." - GrupoNews");
		$title_chat = urlencode($webtv_palestra);
		$url = urlencode('http://www.gruponews.com.br/webtv');
		$summary = urlencode('Estou assistindo "'.$webtv_palestra.'"');

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
										src : "/files_media/player_tv.swf"
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

			<?php the_content(); ?>

			<div id="social-share">
				<p>Você quer contar para alguem sobre essa transmissão</p>
				<p><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&amp;','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="facebook"><i class="icon icon-social" >&#62222;</i> Facebook</a> | <a href="https://twitter.com/share?url=http://www.gruponews.com.br/webtv&via=gruponews&text=<?php echo 'Estou acompanhando "'.$webtv_palestra.'"' ?>" class="twitter"><i class="icon icon-social" >&#62217;</i> Twitter</a></p>
			</div>
			<div id="chat">
				<h2>Comentários</h2>
				<!-- <div class="fb-comments" data-href="http://www.gruponews.com.br/webtv?<?php echo $title_chat;?>" data-numposts="10"></div> -->
				    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'gruponews'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
			</div>

			<!-- Begin W3Counter Pulse Real-Time Heartbeat Code 
<script type="text/javascript">
(function(){
  var ps = document.createElement('script');
	 ps.type = 'text/javascript';
	 ps.async = true;
	 ps.src = '//pulse.w3counter.com/pulse.js?id=41004';
  (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(ps);
})();
</script>

<script type="text/javascript" src="https://www.w3counter.com/securetracker.js"></script>
<script type="text/javascript">
w3counter(41004);
</script>-->
<noscript>
</noscript>
<!-- End W3Counter Tracking Code -->
<!-- Piwik Image Tracker -->
<img src="http://stats.gruponews.com.br/piwik.php?idsite=2&amp;rec=1" style="border:0" alt="" />
<!-- End Piwik -->

		<?php endwhile;
				endif;
				}
				genesis();