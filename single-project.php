<?php

  get_header();
?>
<main>
  <div class="container">
<?php
  while(have_posts()) {
   the_post(); ?>
   <div class="the-project">
      <h3 class="project-title">
        <?php the_title(); ?>
        <small><?php echo get_the_date( 'l F j, Y' ); ?></small>
      </h3>
    </div>
   <?php the_content(); ?>

</div>
</main>
<?php
  }
  get_footer();
