<?php /*Template Name: Page - Conferencia 2009*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		GrupoNews | Conferência 2009 - Por que você não quer mais ir àigreja?</title>
		<link rel="stylesheet"href="<?php bloginfo('stylesheet_directory'); ?>/conferencia2009/css/style.css"type="text/css" media="all" />
		<?php wp_head(); ?>
	</head>
	<body>
		<div id="wrap">
			<div id="topo">
			</div>
			<div id="container">
				<div id="menu">
					<?php wp_nav_menu(array('menu' => 'conferencia-2009')); ?>
				</div>
				<div id="conteudo">
					<imgsrc="<?php bloginfo('stylesheet_directory'); ?>/conferencia2009/images/grafismo.jpg"border="0" />
					<br />
					<br />
					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
					<h2>
						<?php the_title(); ?>
					</h2>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div id="rodape">
			© GrupoNews | www.gruponews.com.br</div>
		</div>
	</div>
	<div id="w3counter">
		<!-- Begin W3Counter Tracking Code -->
		<script type="text/javascript"src="http://www.w3counter.com/tracker.js">
		</script>
		<script type="text/javascript">
		w3counter(17554);</script>
		<noscript>
			<div>
				<a href="http://www.w3counter.com">
					<imgsrc="http://www.w3counter.com/tracker.php?id=17554"style="border: 0" alt="W3Counter" />
				</a>
			</div>
		</noscript>
		<!-- End W3Counter Tracking Code-->
	</div>
	<?php wp_footer(); ?>
</body>
</html>
