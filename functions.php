<?php
   function style_files() {
     wp_enqueue_style('main_styles', get_stylesheet_uri());
     wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=JetBrains+Mono&display=swap');

   }

  add_action('wp_enqueue_scripts', 'style_files');

  // import ion-icons
  function my_theme_load_ionicons_font() {
    // Load Ionicons font from CDN
    wp_enqueue_script( 'my-theme-ionicons', 'https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js', array(), '7.1.0', true );
  }

  add_action( 'wp_enqueue_scripts', 'my_theme_load_ionicons_font' );

  // Set the title tag automatically
    function theme_slug_setup() {
      add_theme_support( 'title-tag' );
    }

  add_action( 'after_setup_theme', 'theme_slug_setup' );