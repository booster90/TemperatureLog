<?php

function register_my_menu() {
    register_nav_menu('main-menu', __('Main menu'));
}
//inicjujemy
add_action('init', 'register_my_menu');

//add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
//set_post_thumbnail_size(500, 500);