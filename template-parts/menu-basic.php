<?php 
// Build link data
$links = [
  [
    'label'   => esc_html__( 'About', 'personaltheme' ),
    'url'     => esc_url( home_url( '/about' ) ),
    'current' => is_page( 'about' ),
  ],
  [
    'label'   => esc_html__( 'Articles', 'personaltheme' ),
    'url'     => esc_url( home_url( '/blog' ) ),
    // active on the posts index and on single posts
    'current' => is_home() || is_singular( 'post' ),
  ],
  [
    'label'   => esc_html__( 'Projects', 'personaltheme' ),
    'url'     => esc_url( get_post_type_archive_link( 'project' ) ?: home_url( '/projects' ) ),
    'current' => is_post_type_archive( 'project' ) || is_singular( 'project' ),
  ],
  [
    'label'   => esc_html__( 'Contact', 'personaltheme' ),
    'url'     => esc_url( home_url( '/contact' ) ),
    'current' => is_page( 'contact' ),
  ],
];
?>
<menu class="nav" id="js--menu">
  <a <?php if (is_page('about')) echo 'class="indicator"' ?>   href="<?php echo site_url('/about') ?>">About</a>
  <a <?php if (get_post_type() == 'post') echo 'class="indicator"' ?> href="<?php  echo site_url('/blog') ?>">Articles</a>
  <a <?php if (get_post_type() == 'project') echo 'class="indicator"' ?> href="<?php  echo site_url('/projects') ?>">Projects</a>
          <!--
            <a href="#books">Books</a>
            <a href="#now">Now</a>
          -->
  <a <?php if (is_page('contact')) echo 'class="indicator"' ?> href="<?php echo site_url('/contact') ?>">Contact</a>

  <a <?php if (is_page('search')) echo 'class="indicator"' ?>  href="<?php echo esc_url(site_url('/search')) ?>" tabindex="0" class="visible search-trigger" aria-description="You can search for your topic of interest either by clicking here or by clicking the keys s + alt">
         Search <ion-icon name="search" size="small" ></ion-icon>
  </a>
</menu>
