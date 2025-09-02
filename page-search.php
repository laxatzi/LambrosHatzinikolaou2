<?php
  get_header();
  while(have_posts()) {
   the_post(); ?>
   <h1> <?php the_title(); ?></h1>

   <?php
   get_search_form();
  }
   get_template_part('template-parts/search-overlay');
    get_footer();
  
