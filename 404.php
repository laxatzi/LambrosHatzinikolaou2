<?php
get_header();
?>

<main id="main-content" class="site-main error-404 not-found" aria-labelledby="page-title">
  <div class="container">
    <header class="error-page-header">
      <h1 id="page-title">404</h1>
      <h2 class="page-subtitle"><span><?php esc_html_e('Oops', 'LambrosPersonalTheme'); ?></span>, <?php esc_html_e("we haven't found what you're looking for.", 'LambrosPersonalTheme'); ?></h2>
    </header>
    <p>
        <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'LambrosPersonalTheme'); ?>
    </p>

    <p class="back-to-home">
      <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span aria-hidden="true">←</span>
        <?php esc_html_e('Back to home page', 'LambrosPersonalTheme'); ?>
      </a>
    </p>
  </div>
</main>
</body>
</html>
