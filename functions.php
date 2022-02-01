<?php

function load_files() {
	wp_enqueue_style('google-fonts-montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700,200');
	wp_enqueue_style('fontawesone-css', '//use.fontawesome.com/releases/v5.7.1/css/all.css');
	wp_enqueue_style('google-fonts-roboto', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700');
	wp_enqueue_style('nucleo-icons-css', get_theme_file_uri('/css/nucleo-icons.css'));
	wp_enqueue_style('nucleo-svg-css', get_theme_file_uri('/css/nucleo-svg.css'));

	wp_enqueue_style('material-icons', '//fonts.googleapis.com/icon?family=Material+Icons+Round');
	wp_enqueue_style('bootstrap-css', get_theme_file_uri('/css/bootstrap.min.css'));
	wp_enqueue_style('material-kit-css', get_theme_file_uri('/css/material-kit.css'));
	wp_enqueue_style('particle-css', get_theme_file_uri('/css/particle.css'));

	wp_enqueue_script('fontawesome-kit-js', '//kit.fontawesome.com/42d5adcbca.js');
	wp_enqueue_script('particle-js', get_theme_file_uri('/js/particle.js'));
	wp_enqueue_script('jquery-js', get_theme_file_uri('/js/core/jquery.min.js'));
	wp_enqueue_script('popper-js', get_theme_file_uri('/js/core/popper.min.js'));
	wp_enqueue_script('bootstrap-js', get_theme_file_uri('/js/core/bootstrap.min.js'));
	wp_enqueue_script('material-kit-js', get_theme_file_uri('/js/material-kit.js'));

	wp_enqueue_style('main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts','load_files');

?>