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
<!-- Error message header -->

    <header class="error-page-header">
      <h1 id="page-title">404</h1>
      <h2 class="page-subtitle">
  <!-- Span allows styling "Oops" differently via CSS -->
        <span class="subtitle-emphasis"><?php esc_html_e('Oops', 'LambrosPersonalTheme'); ?></span>, 
        <?php esc_html_e("we haven't found what you're looking for.", 'LambrosPersonalTheme'); ?>
     </h2>
    </header>
<!-- Explanation text -->
    <p>
        <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'LambrosPersonalTheme'); ?>
    </p>

    <p class="back-to-home">
      <a class="button" href="<?php echo esc_url( home_url('/') ); ?>">
        <span aria-hidden="true">←</span>
        <?php esc_html_e('Back to home page', 'LambrosPersonalTheme'); ?>
      </a>
    </p>

  <?php
    // Show a few recent posts to help users recover
    the_widget( 'WP_Widget_Recent_Posts', [ 'number' => 5 ], [ 'before_title' => '<h3>', 'after_title' => '</h3>' ] );
    ?>

  </div>
</main>
<?php
get_footer();
