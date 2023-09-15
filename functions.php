<?php
   function style_files() {
     wp_enqueue_style('main_styles', get_stylesheet_uri());
     wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=JetBrains+Mono&display=swap');

   }

  add_action('wp_enqueue_scripts', 'style_files');