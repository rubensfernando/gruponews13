<?php /*
 Template Name: Page - Conferencia2008
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conferência 2008 | GrupoNews</title>
<link rel="stylesheet"
	href="<?php bloginfo('stylesheet_directory'); ?>/conferencia2008/css/style.css"
	type="text/css" media="all" />
<script type="text/javascript"
	src="<?php bloginfo('stylesheet_directory'); ?>/js/swfobject.js"></script>
<script type="text/javascript">
	var flashvars = {};
	var params = {};
	var attributes = {};
	swfobject.embedSWF("<?php bloginfo('stylesheet_directory'); ?>
		/conferencia2008/swf / topo.swf", "topoFlash", "950", "213", "10.0.0", "
		swf / expressInstall.swf", flashvars, params, attributes);

</script>
<?php wp_head(); ?>
</head>
<body>


	<div id="wrap">
		<div id="topo">
			<div id="topoFlash">
				<a href="http://www.adobe.com/go/getflashplayer"> <img
					src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif"
					alt="Get Adobe Flash player" />
				</a>
			</div>
			<div id="menu">


			<?php wp_nav_menu(array('menu' => 'conferencia-2008')); ?>
			</div>
		</div>
		<div id="container">
			<div id="conteudo">

			<?php if (have_posts()) : ?>


			<?php
	include (TEMPLATEPATH . '/funcoes.php');
 ?>


			<?php while (have_posts()) : the_post(); ?>
				<h2>
					
				<?php the_title(); ?></h2>
				
				
				
				
 		<?php the_content(); ?>
 		<?php endwhile; ?>
 		<?php endif; ?>
    </div>
		</div>
		<div id="rodape">© GrupoNews 2008</div>
	</div>
	<div id="w3counter">
		<!-- Begin W3Counter Tracking Code -->
		<script type="text/javascript"
			src="http://www.w3counter.com/tracker.js"></script>
		<script type="text/javascript">w3counter(17554);</script>
		<noscript>
			<div>
				<a href="http://www.w3counter.com"><img
					src="http://www.w3counter.com/tracker.php?id=17554"
					style="border: 0" alt="W3Counter" /> </a>
			</div>
		</noscript>
		<!-- End W3Counter Tracking Code-->
	</div>
<?php wp_footer(); ?>
</body>
</html>
