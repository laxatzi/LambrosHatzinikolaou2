<?php
// Template for the “Search” page (slug: search)
get_header();
?>
<main id="main-content" class="site-main" aria-labelledby="page-title-<?php the_ID(); ?>">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header">
        <h1 id="page-title" class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
      </header>

      <div class="entry-content">
        <?php
          // Optional intro/instructions edited in the page body
          the_content();

          // Core search form (already pre-fills the current query and has label)
          get_search_form();
        ?>
      </div>
    </article>
  <?php endwhile; else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
  <?php endif; ?>

</main>
    get_footer();
  
