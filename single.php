<?php /* 
Template Name: Single
*/ 
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
	$post_info = 'Por [post_author_posts_link]';
	return $post_info;
}
genesis();