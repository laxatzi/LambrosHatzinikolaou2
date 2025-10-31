<?php
// Template for the “Search” page (slug: search)
get_header();
?>
<main id="main-content" class="site-main" aria-labelledby="page-title-<?php the_ID(); ?>">

  while(have_posts()) {
   the_post(); ?>
   <h1> <?php the_title(); ?></h1>

   <?php
   get_search_form();
  }
   get_template_part('template-parts/search-overlay');
</main>
    get_footer();
  
