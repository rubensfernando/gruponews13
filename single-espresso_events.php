<?php
/**
 * Template Name: Event Details
 *
 * This is a Genesis-ready template that will display a single event
 *
 * Event Registration and Management Plugin for WordPress
 *
 * @ package		Event Espresso
 * @ author			Seth Shoultes
 * @ copyright		(c) 2008-2013 Event Espresso  All Rights Reserved.
 * @ license		http://eventespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link			http://www.eventespresso.com
 * @ version		4+
 */

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'event_details_custom_loop');

function event_details_custom_loop() {

?>
	<main class="content" role="main" itemscope itemtype="http://schema.org/Event">
		<div id="espresso-event-details-wrap-dv" class="">
			<div id="espresso-event-details-dv" class="" >
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post();?>
				<?php
				global $post;
				$wrap_class = '';
				if (has_excerpt( $post->ID )){ $wrap_class .= ' has-excerpt';}
				?>
				<?php do_action( 'AHEE_event_details_before_post', $post ); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('espresso-event-details entry-content'); ?>>
					<?php do_action( 'AHEE_event_details_before_featured_img', $post ); ?>
					<?php
					if ( has_post_thumbnail( $post->ID )) :
						if ( $img_ID = get_post_thumbnail_id( $post->ID )) :
							if ( $featured_img = wp_get_attachment_image_src( $img_ID, 'large' )) :
								$caption = esc_attr( get_post( get_post( $img_ID ))->post_excerpt );
								$wrap_class .= ' has-img';
								?>
					<div id="ee-event-img-dv-<?php echo $post->ID; ?>" class="ee-event-img-dv">
						<img class="ee-event-img" src="<?php echo $featured_img[0]; ?>" width="<?php echo $featured_img[1]; ?>" height="<?php echo $featured_img[2]; ?>" alt="<?php echo $caption; ?>"/>
					</div>
					<?php
							endif;
						endif;
					endif;
					?>
					<?php do_action( 'AHEE_event_details_after_featured_img', $post );?>
					<header class="event-header<?php echo $wrap_class;?>">
						<h1 id="event-details-h1">
							<?php the_title(); ?>
						</h1>
						<?php if (has_excerpt( $post->ID )): the_excerpt(); endif;?>
						<p id="event-date-p">
							<?php echo $post->EE_Event->primary_datetime()->start_date_and_time(); ?>
						</p>
					</header>
					<!-- .event-header -->

          <?php do_action( 'AHEE_event_details_before_event_date', $post ); ?>
            <div class="event-datetimes">
              <h3 class="event-datetimes-h3 ee-event-h3">
                <span class="dashicons dashicons-calendar"></span>Data, horário e local
              </h3>
              <?php espresso_list_of_event_dates();?>
              <?php do_action( 'AHEE_event_details_after_event_date', $post ); ?>
            </div>
            <!-- .event-datetimes -->

					<div class="espresso-event-wrapper-dv">
						<div class="event-content">
              <?php if ( espresso_display_ticket_selector( $post->ID ) && ( is_single() || ( is_archive() && espresso_display_ticket_selector_in_event_list() ))) : ?>
							<h3 class="ticket-selector-h3 ee-event-h3">
								<span class="ee-icon ee-icon-tickets"></span>Opções de inscrição
							</h3>
							<?php espresso_ticket_selector( $post ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'event_espresso' ), 'after' => '</div>' ) ); ?>
							<?php if ( espresso_event_phone() != '' ) : ?>
							<p> <strong>
								Telefone:
								</strong> <?php echo espresso_event_phone(); ?> </p>
							<?php endif; ?>
            <?php endif; ?>
              <h3 class="about-event-h3 ee-event-h3">
                <?php _e( 'Details', 'event_espresso' ); ?>
              </h3>
              <?php do_action( 'AHEE_event_details_before_the_content', $post ); ?>
              <?php the_content(); ?>
              <?php do_action( 'AHEE_event_details_after_the_content', $post ); ?>
						</div>
						<!-- .event-content -->



						<?php if (( is_single() && espresso_display_venue_in_event_details() ) || is_archive() && espresso_display_venue_in_event_list() ) : ?>
						<?php do_action( 'AHEE_event_details_before_venue_details', $post ); ?>
						<div class="espresso-venue-dv">
							<strong><span class="ee-icon ee-icon-venue"></span><?php _e( 'Venue:', 'event_espresso' ); ?></strong>&nbsp;&nbsp;
							<strong> <?php espresso_venue_name(); ?></strong><br/>
							<span class="smaller-text tags-links"><?php echo espresso_venue_categories(); ?></span>
							<br/><br/>
							<strong><span class="dashicons dashicons-location-alt"></span><?php _e( 'Address:', 'event_espresso' ); ?></strong>
							<?php espresso_venue_address( 'inline' ); ?>
							<?php espresso_venue_gmap( $post->ID ); ?>
							<div class="clear"><br/>
							</div>
							<p>
								<strong><?php _e( 'Description:', 'event_espresso' ); ?></strong><br/>
								<?php echo espresso_venue_description(); ?>
							</p>
							<p> <strong>
								<?php _e( 'Phone:', 'event_espresso' ); ?>
								</strong> <?php echo espresso_venue_phone(); ?> </p>
						</div>
						<!-- .espresso-venue-dv -->
						<?php do_action( 'AHEE_event_details_after_venue_details', $post ); ?>
						<?php endif; ?>
						<footer class="event-meta">
							<?php do_action( 'AHEE_event_details_footer_top', $post ); ?>
							<?php espresso_edit_event_link(); ?>
							<?php do_action( 'AHEE_event_details_footer_bottom', $post ); ?>
						</footer>
						<!-- .entry-meta -->

					</div>
				</article>
				<!-- #post -->
				<?php do_action( 'AHEE_event_details_after_post', $post );
				endwhile;

				//No events found
				else :?>
				<article id="post-0" class="post no-results not-found">
					<header class="event-header">
						<h1 class="event-title">
							<?php _e( 'The Event you were looking for could not be found...', 'event_espresso' ); ?>
						</h1>
						<br/>
					</header>
					<div class="event-content">
						<p>
							<?php _e( 'Perhaps searching will help find a related event.', 'event_espresso' ); ?>
						</p>
						<?php get_search_form(); ?>
					</div>
					<!-- .event-content -->

				</article>
				<!-- #post-0 -->

				<?php endif; // end have_posts() check ?>
			</div>
		</div>
	</main>

<?php
}

genesis();
