<?php /* 
Template Name: Archive Page
*/ 

//remove_action( 'genesis_before_entry_content', 'genesis_post_info' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single' );

genesis();