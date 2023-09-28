<?php
  get_header();
  while(have_posts()) {
   the_post(); ?>
   <h1> <?php the_title(); ?></h1>
   <h3>Just a reg page</h3>
   <?php the_content(); ?>
   <?php
  }
    get_footer();
  ?>
