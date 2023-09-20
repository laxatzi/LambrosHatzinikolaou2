<!-- ©Lambros Hatzinikolaou 2023 -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" >

  <?php  wp_head(); ?>

</head>
 <?php
    get_template_part('template-parts/container-loader');
  ?>
<body <?php body_class(); ?>>
<button onclick="topFunction()" id="top-button" title="Go to top">&#8593;</button>
 <div id="wrapper">
    <header>
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
      <menu class="nav" id="js--menu">
        <a <?php if (is_page('about')) echo 'class="indicator"' ?>   href="<?php echo site_url('/about') ?>">About</a>
        <a <?php if (get_post_type() == 'post') echo 'class="indicator"' ?> href="<?php  echo site_url('/blog') ?>">Articles</a>
        <a <?php if (get_post_type() == 'project') echo 'class="indicator"' ?> href="<?php  echo site_url('/projects') ?>">Projects</a>
          <!--
            <a href="#books">Books</a>
            <a href="#now">Now</a>
          -->
        <a <?php if (is_page('contact')) echo 'class="indicator"' ?> href="<?php echo site_url('/contact') ?>">Contact</a>

       <div tabindex="0" class="visible search-trigger" aria-description="You can search for your topic of interest either by clicking here or by clicking the keys s + alt">
         Search <ion-icon name="search" size="small" ></ion-icon> </div>
      </menu>
    </header>
