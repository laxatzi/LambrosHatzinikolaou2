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
  <!-- Logo -->
    <div id="logo" class="site-branding">
      <!-- Upload a logo in Customizer (Appearance → Customize → Site Identity). No hard-coding image tags; users can swap logos without editing code. WordPress outputs proper img with alt, srcset, etc. -->
       <!-- If a custom logo exists, it appears first; otherwise the site name acts as the brand. -->
      <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php endif; ?>
   <!-- the homepage carries the primary <h1>. On inner pages, the page/post title is the <h1>, so the site title should not also be an H1 (avoid multiple H1s). -->
      <?php if ( is_front_page() && ! is_paged() ) : ?>
        <h1 class="site-title">
          <a class="<?php echo is_front_page() ? 'indicator' : ''; ?>"
             href="<?php echo esc_url( home_url( '/' ) ); ?>"
             rel="home">
             <!-- rel='home' for assistive tech -->
            <?php bloginfo( 'name' ); ?>
          </a>
        </h1>
      <?php else : ?>
        <p class="site-title">
          <a class="<?php echo is_front_page() ? 'indicator' : ''; ?>"
             href="<?php echo esc_url( home_url( '/' ) ); ?>"
             rel="home">
            <?php bloginfo( 'name' ); ?>
          </a>
        </p>
      <?php endif; ?>

      <?php
      $desc = get_bloginfo( 'description', 'display' );
      if ( $desc || is_customize_preview() ) :
      ?>
        <p class="site-description"><?php echo esc_html( $desc ); ?></p>
      <?php endif; ?>
      <!-- end #logo -->
    </div>
       
    <a class="skip-link screen-reader-text" href="#main-content">
      <?php echo esc_html__( 'Skip to content', 'LambrosPersonalTheme' ); ?>
    </a>
   

       <?php

        get_template_part('template-parts/menu-basic');
       ?>
    </header>
