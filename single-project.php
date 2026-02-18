<?php
/**
 * Single Project Template
 *
 * Displays individual project pages from the portfolio.
 * Shows project title, date, and full content.
 *
 * @package LambrosPersonalTheme
 * @since 1.0.0
 */

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
