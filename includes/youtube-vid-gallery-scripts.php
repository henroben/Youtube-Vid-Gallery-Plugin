<?php
// Check if admin
if(is_admin()){
	// Add Scripts
	function yvg_add_admin_scripts(){
		wp_enqueue_style('yvg-admin-style', plugins_url().'/youtube-vid-gallery/css/style-admin.css');
	}

	add_action('admin_init', 'yvg_add_admin_scripts');
}

// Add Scripts
function yvg_add_scripts(){
	wp_enqueue_style('yvg-main-style', plugins_url().'/youtube-vid-gallery/css/style.css');
	wp_enqueue_script('yvg-main-scripts', plugins_url().'/youtube-vid-gallery/js/main.js');
}

add_action('wp_enqueue_scripts', 'yvg_add_scripts');