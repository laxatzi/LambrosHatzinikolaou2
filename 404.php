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
?>

<main id="main-content" class="site-main error-404 not-found" aria-labelledby="page-title">
  <div class="container">
  <?php
    /**
     * Fires before 404 page content.
     *
     * @since 1.0.0
     */
    do_action('lambros_before_404_content');
    ?>
   <!-- Error message header -->

    <header class="error-page-header">
      <h1 id="page-title">404</h1>
      <h2 class="page-subtitle">
   <?php
      printf(
          /* translators: %s: "Oops" or equivalent attention-getting word */
          esc_html__('%s, we haven\'t found what you\'re looking for.', 'LambrosPersonalTheme'),
          '<span class="subtitle-emphasis">' . esc_html__('Oops', 'LambrosPersonalTheme') . '</span>'
      );
      ?>
     </h2>
    </header>
    <?php
    /**
     * Fires after 404 page header.
     *
     * @since 1.0.0
     */
    do_action('lambros_after_404_header');
    ?>
<!-- Explanation text -->
    <p>
        <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'LambrosPersonalTheme'); ?>
    </p>

    <div class="back-to-home">
      <a class="button" href="<?php echo esc_url(home_url('/')); ?>">
      <span aria-hidden="true">←</span>
      <?php esc_html_e('Back to home page', 'LambrosPersonalTheme'); ?>
      </a>
    </div>

  <?php
    // Show a few recent posts to help users recover
    the_widget( 'WP_Widget_Recent_Posts', [ 'number' => 5 ], [ 'before_title' => '<h3>', 'after_title' => '</h3>' ] );
     /**
     * Fires after 404 page content.
     *
     * @since 1.0.0
     */
    do_action('lambros_after_404_content');  
  ?>

  </div>
</main>
<?php
get_footer();
