<?php

  get_header();
?>
<main id="main-content">
  <div class="container">
<?php
  while(have_posts()) {
   the_post(); ?>
    <div class="the-project">
      <h1 class="project-title">
        <?php the_title(); ?>

      </h1>
    </div>
    <small><?php echo get_the_date( LAMBROS_DATE_FORMAT ); ?></small>
  <?php the_content(); ?>

</div>
</main>
<?php
  }
  get_footer();
