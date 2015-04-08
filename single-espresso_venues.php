<?php /* 
Template Name: Single page - espresso_venues
*/ 

remove_action( 'genesis_before_post_content', 'genesis_post_info' );

//add_filter( 'genesis_post_info', 'sp_post_info_filter' );
// function sp_post_info_filter($post_info) {
// 	$post_info = ' ';
// 	return $post_info;
// }
genesis();