<?php
/* Plugin Name: GrupoNews Notice
Description: Widget para mostrar aviso na home do GrupoNews
Version: 1.0
Author: Rubens Fernando
Author URI: http://www.rubensfernando.com
*/

add_action( 'widgets_init', 'gn_notices' );


function gn_notices() {
	register_widget( 'gn_notices' );
}

class gn_notices extends WP_Widget {

	function gn_notices() {
		$widget_ops = array( 'classname' => 'example', 'description' => __('Widget para mostrar aviso na home do GrupoNews', 'example') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'example-widget' );
		
		$this->WP_Widget( 'example-widget', __('Avisos GrupoNews', 'example'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$kicker= $instance['kicker'];
		$title = $instance['title'];
		$date = $instance['date'];
		$link = $instance['link'];
		$textLink = $instance['textLink'];
		$image = $instance['image'];
		$lead = $instance['lead'];

		$linkBtn;
		$linkImage;		
		
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;
		
		if ($link != "") {
			$linkBtn = '<p><a class="bannerBtn" href="'. $link.'">'. $textLink .'</a></p>';
			$linkImage = '<a href="'. $link.'"><img src="'. $image .'" /></a>';
		} else {
			$linkImage = '<img src="'. $image .'" />';
		}
		
		if ( $show_info ){?>
			<div id="topslide">
				<div class="container_16">
					<div class="topslide-content">
						<div class="grid_8 alpha">
							<h2><?php printf($kicker)?></h2>
							<h3><?php printf($title)?></h3>
							<p class="date"><?php printf($date)?></p>
							<p><?php printf($lead); ?></p>
							<?php printf($linkBtn); ?>
						</div>
						<div class="grid_8 omega image">
							<?php printf($linkImage); ?>
						</div>
					</div>
					<p><a class="toggle close" href="#">Fechar Aviso</a></p>
				</div>
			</div>
		<?php }

	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
		
				//Strip tags from title and name to remove HTML 
				$instance['show_info'] = $new_instance['show_info'];
				$instance['kicker'] = strip_tags( $new_instance['kicker'] );
				$instance['title'] = strip_tags( $new_instance['title'] );
				$instance['date'] = strip_tags( $new_instance['date'] );
				$instance['link'] = strip_tags( $new_instance['link'] );
				$instance['textLink'] = strip_tags( $new_instance['textLink'] );
				$instance['image'] = strip_tags( $new_instance['image'] );
				$instance['lead'] = strip_tags( $new_instance['lead'] );
		
				return $instance;
			}

	
	function form( $instance ) {

		$defaults = array( 
          				'show_info' => true,
          				'kicker' => __('Agora ao vivo', 'example'),
          				'title' => __('Encontro...', 'example'),
          				'date' => __('4 e 5 de agosto', 'example'),
          				'link' => __('http://www.gruponews.com.br/webtv', 'example'),
          				'textLink' => __('Clique para acompanhar', 'example'),
          				'image' => __('http://www.gruponews.com.br/', 'example'),
          				'lead' => __('Texto até 225 caracteres', 'example'),
          			);
          			$instance = wp_parse_args( (array) $instance, $defaults );
          			 ?>
          			 <p>
						<input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" /> 
						<label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Mostrar aviso?', 'example'); ?></label>
					</p>
          			 <p>
						<label for="<?php echo $this->get_field_id( 'kicker' ); ?>"><?php _e('Chapéu:', 'example'); ?></label>
						<input id="<?php echo $this->get_field_id( 'kicker' ); ?>" name="<?php echo $this->get_field_name( 'kicker' ); ?>" value="<?php echo $instance['kicker']; ?>" style="width:100%;" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Título:', 'example'); ?></label>
						<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e('Data:', 'example'); ?></label>
						<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" value="<?php echo $instance['date']; ?>" style="width:100%;" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Link:', 'example'); ?></label>
						<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" style="width:100%;" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'textLink' ); ?>"><?php _e('Texto do link:', 'example'); ?></label>
						<input id="<?php echo $this->get_field_id( 'textLink' ); ?>" name="<?php echo $this->get_field_name( 'textLink' ); ?>" value="<?php echo $instance['textLink']; ?>" style="width:100%;" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Url da imagem:', 'example'); ?></label>
						<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" style="width:100%;" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'lead' ); ?>"><?php _e('Texto curto sobre:', 'example'); ?></label>
						<textarea id="<?php echo $this->get_field_id( 'lead' ); ?>" name="<?php echo $this->get_field_name( 'lead' ); ?>" style="width:100%;"><?php echo $instance['lead']; ?></textarea>
					</p>
					
					<?php
	}
}

?>