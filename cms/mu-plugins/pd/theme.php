<?php

namespace PD\Theme;

function after_setup_theme () {
  add_theme_support( 'menus' );  
  register_nav_menus([
    'main' => 'Main',
    'mobile' => 'Mobile', 
    'social' => 'Social'
  ]);  
}

add_action('after_setup_theme', __NAMESPACE__ . '\\after_setup_theme', 102);