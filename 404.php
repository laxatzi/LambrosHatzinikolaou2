<?php
  /**
   * 404 Error Page Template
   *
   * Displays when a requested page is not found.
   * Shows a helpful message and recent posts to aid navigation.
   *
   * @package LambrosPersonalTheme
   * @since 1.0.0
   */
  get_header();

// Ensure proper HTTP status.
// Set the 404 status and send no‑cache headers.
// This ensures browsers and crawlers treat the page correctly.
  status_header( 404 );
  nocache_headers();
?>

<main id="main-content" class="site-main error-404 not-found" aria-labelledby="page-title">
  <div class="container">
  <?php
    /**
     * Fires before 404 page content.
     *
     * @since 1.0.0
     */
    do_action( 'lambros_before_404_content' );
  ?>
  <?php get_template_part( 'template-parts/content', '404' ); ?>
  <?php
     /**
     * Fires after 404 page content.
     *
     * @since 1.0.0
     */
    do_action( 'lambros_after_404_content' );  
  ?>
  </div>
</main>
<?php
get_footer();
