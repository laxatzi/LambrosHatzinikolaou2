<?php
  get_header();
  while(have_posts()) {
   the_post(); ?>
   <h2> <?php the_title(); ?></h2>
    <form method="get" id="search" action="<?php echo esc_url(site_url('/')) ?> ">
      <input type="search" name="s" placeholder="What are you looking for?">
      <input type="submit" value="Search">
    </form>
   <?php
  }
    get_footer();
  ?>
