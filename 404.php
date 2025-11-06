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

    <div class="back-to-home">
      <a href="<?php echo site_url(); ?>"><span>&#8592;</span> Back to home page</a>
    </div>
  </div>
</main>
</body>
</html>
