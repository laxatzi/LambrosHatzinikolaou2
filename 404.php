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
  /*
  Sends HTTP headers that tell browsers and proxies not to cache this page. 
  Important for 404s — you don't want a "not found" response to be cached and served later when the page might exist.
  */
  nocache_headers();
?>

<main id="main-content" class="layout__content layout__main error-404 not-found" aria-labelledby="page-title">
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
     * A custom action hook that fires before the 404 content. Enables coder (or a plugin) to inject content before the main message without editing this file directly — for example, a banner or breadcrumb.
     *
     * @since 1.0.0
     */
    do_action( 'lambros_after_404_content' );  
  ?>
  </div>
</main>
<?php
get_footer();
