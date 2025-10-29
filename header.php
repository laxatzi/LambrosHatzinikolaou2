<!-- ©Lambros Hatzinikolaou 2023 -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" >

  <?php  wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<button
  id="top-button"
  class="back-to-top"
  type="button"
  title="<?php echo esc_attr__( 'Go to top', 'LambrosPersonalTheme' ); ?>"
  aria-label="<?php echo esc_attr__( 'Back to top', 'LambrosPersonalTheme' ); ?>"
  hidden
>
  ↑
</button>
 <div id="wrapper">
     <header class="site-header" role="banner">
      <div id="logo">
        <a <?php if (is_front_page()) echo 'class="indicator"'?> href="<?php echo site_url(); ?>">Lambros Hatzinikolaou</a>
      </div>
        <div
          class="toggle-menu"
          id="toggle-menu-button"
          aria-label="Toggle main menu"
          tabindex="0"
        >
          <ion-icon name="menu" class="show"></ion-icon>
          <ion-icon name="close" class="close"></ion-icon>
      </div>
       <?php

        get_template_part('template-parts/menu-basic');
       ?>
    </header>
