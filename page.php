<?php
  get_header();
  while(have_posts()) {
   the_post(); ?>
   <h2> <?php the_title(); ?></h2>
   <h3>Just a reg page</h3>
   <?php the_content(); ?>
   <?php
  }
    get_footer();
  ?>
