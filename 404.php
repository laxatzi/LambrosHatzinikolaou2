<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" >
  <?php  wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<main id="error-message">
  <div class="container">

    <h1>404</h1>
    <h2><span>Oops</span>, haven't found what you looking for?</h2>
    <p>The page you are looking for might have been removed, had its
              name changed, or is temporally unavailable.</p>

    <div class="back-to-home">
      <a href="<?php echo site_url(); ?>"><span>&#8592;</span> Back to home page</a>
    </div>
  </div>
</main>
</body>
</html>