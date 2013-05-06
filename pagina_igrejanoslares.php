<?php /*
 Template Name: Pagina Igreja nos lares
 */
?>
<?php get_header(); ?>
<div id="containerConteudo" class="prepend-1 clear append-1">
	<div id="conteudo" class="span-16">
		<div id="breadCrumb" class="append-bottom">

			<?php
	include (TEMPLATEPATH . '/breadcrumb.php');
			?>
			<div class="clear"></div>
		</div>

		<?php if (have_posts()) :
		?>
		<?php
			include (TEMPLATEPATH . '/funcoes.php');
		?>
		<?php while (have_posts()) : the_post();
		?>
		<div id="post-<?php the_ID(); ?>" class="clear">
			<h2> <?php the_title(); ?> </h2>
			<div id="postMeta">
				<div class="span-14 append-bottom">
					<?php edit_post_link('Editar o tópico', ''); ?>
				</div>
				<div id="tamanhoFonte" class="span-2 last">
					<a title="Diminuir o tamanho da fonte" id="small" class="tamanho decreaseFont" href="javascript:ts('topico',-1);">A-</a><a title="Aumentar o tamanho da fonte" id="large" class="tamanho increaseFont" href="javascript:ts('topico',1);">A+</a>
				</div>
			</div>
			<div id="topico" class="clear">
				<div id="imagemTopico" class="append-bottom clear">
					<?php if($post_image !== '') {
					?><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<? echo $post_image; ?>&w=625&h=226&zc=1" alt="<?php the_title(); ?>" />
					<?php } else { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php bloginfo('stylesheet_directory'); ?>/images/sem_imagem.jpg&w=625&h=226&zc=1" alt="" />
					<?php } ?>
				</div>
				<?php the_content(); ?>
				<div id="compartilhar" class="append-bottom clearfix clear prepend-top">
					<h4>Compartilhe</h4>
					<ul class="prepend-1">
						<li class="compartilheTwitter">
							<a href="http://twitter.com/home?status=Estou Lendo &quot;<?php the_title(); ?>&quot;  <?php if (function_exists('simple_url_shortener')) { ?><?php echo simple_url_shortener(get_permalink() . '?utm_source=TwitterCompartilhe&utm_medium=Twitter&utm_campaign=Compartilhar', 'service=bit.ly+key&apikey=R_1368a8d2a5bf4a561f348d3b3ec1b6bd&login=gruponews'); ?><?php }//else{ the_permalink(); } ?> (via @gruponews)"> Twitter</a>
						</li>
						<li class="compartilheDelicious">
							<a href="http://delicious.com/save" onclick="window.open('http://delicious.com/save?v=5&amp;noui&amp;jump=close&amp;url='+encodeURIComponent('<?php the_permalink() ?>')+'&amp;title='+encodeURIComponent('<?php the_title() ?>'),'delicious', 'toolbar=no,width=550,height=550'); return false;">del.icio.us</a>
						</li>
						<li class="compartilheEmail">
							<?php
							if (function_exists('wp_email')) { email_link();
							}
							?>
						</li>
						<li class="compartilheImprimir">
							<a href="#print">Imprimir</a>
						</li>
					</ul>
				</div>
				<?php endwhile; ?>
				<?php endif; ?>
				<div id="topicosRelacionados" class="clear">
					<h5>Tópicos Relacionados</h5>
					<ul>
						<?php
query_posts('showposts=3&cat=296');
while(have_posts()) : the_post();
						?>
						<?php
							include (TEMPLATEPATH . '/funcoes.php');
						?>
						<li><a href="<?php the_permalink() ?>">-
						<?php the_title(); ?>
						</a></li>
						<?php endwhile; ?>
						<?php
query_posts('showposts=2&cat=295');
while(have_posts()) : the_post();
						?>
						<?php
							include (TEMPLATEPATH . '/funcoes.php');
						?>
						<li>
							<a href="<?php the_permalink() ?>">-
							<?php the_title(); ?> </a>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--BarraLateral-->

	<?php get_sidebar('pages'); ?>
	<!--Fim da BarraLateral-->
	<div class="clear"></div>
</div>
<?php get_footer(); ?>