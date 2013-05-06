<?php /*
 Template Name: Padrao da Conferencia2010
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GrupoNews | Conferência 2010 - Cristo, O Reino e A Igreja</title>
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/blueprint/src/typography.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/conferencia2010/css/style.css" rel="stylesheet" type="text/css" />
<link
	href="<?php bloginfo('stylesheet_directory'); ?>/css/calendario.css"
	rel="stylesheet" type="text/css" />
<link rel="stylesheet"
	href="<?php bloginfo('stylesheet_directory'); ?>/js/fancybox/jquery.fancybox-1.2.5.css"
	type="text/css" media="screen, projection" />
<script
	src="<?php bloginfo('stylesheet_directory'); ?>/conferencia2010/js/cufon-yui.js"
	type="text/javascript"></script>
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php bloginfo('stylesheet_directory'); ?>/js/fancybox/jquery.fancybox-1.2.5.pack.js"></script>
<script type="text/javascript">$(document).ready(function() {
			$("a.zoom").fancybox({
				'overlayOpacity' : 0.7,
				'overlayColor' : '#FFF',
				'zoomSpeedIn' : 500,
				'zoomSpeedOut' : 500
			});
		});</script>
<script
	src="<?php bloginfo('stylesheet_directory'); ?>/conferencia2010/js/penumbra.font.js"
	type="text/javascript"></script>
<script type="text/javascript">
	Cufon.replace('#menu a', {
		hover : {
			color : '#aa8866'
		}
	});
	// Works without a selector engine

		</script>
<?php wp_head(); ?>
</head>
<body>


<?php
include ('site/wp-content/themes/gruponews10/master/cabecalho.php');
 ?>
	<div id="wrap">
		<div id="topo"></div>
		<div id="container">
			<div id="menu">


			<?php wp_nav_menu(array('menu' => 'conferencia-2010')); ?>
			</div>
			<div id="conteudo">


			<?php if (have_posts()) : ?>


			<?php while (have_posts()) : the_post(); ?>
				<h2>
					
				<?php the_title(); ?></h2>
				
	      		<?php the_content(); ?>
	     <?php endwhile; ?>
     <?php endif; ?>
    </div>
			<div id="rodape">© GrupoNews | www.gruponews.com.br</div>
		</div>
	</div>
	<script type="text/javascript">
		Cufon.now();
 </script>
	
<?php wp_footer(); ?>
</body>
</html>