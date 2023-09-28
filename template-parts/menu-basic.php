<menu class="nav" id="js--menu">
  <a <?php if (is_page('about')) echo 'class="indicator"' ?>   href="<?php echo site_url('/about') ?>">About</a>
  <a <?php if (get_post_type() == 'post') echo 'class="indicator"' ?> href="<?php  echo site_url('/blog') ?>">Articles</a>
  <a <?php if (get_post_type() == 'project') echo 'class="indicator"' ?> href="<?php  echo site_url('/projects') ?>">Projects</a>
          <!--
            <a href="#books">Books</a>
            <a href="#now">Now</a>
          -->
  <a <?php if (is_page('contact')) echo 'class="indicator"' ?> href="<?php echo site_url('/contact') ?>">Contact</a>

  <a href="<?php echo esc_url(site_url('/search')) ?>" tabindex="0" class="visible search-trigger" aria-description="You can search for your topic of interest either by clicking here or by clicking the keys s + alt">
         Search <ion-icon name="search" size="small" ></ion-icon>
  </a>
</menu>