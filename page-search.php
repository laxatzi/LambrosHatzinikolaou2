<?php
/**
 * Search Page Template
 *
 * Template for the dedicated search page (slug: search).
 * Displays the live search interface with results container.
 *
 * @package LambrosPersonalTheme
 * @since 1.0.0
 */
get_header();
?>

<main id="main-content" class="site-main main-page-search" aria-label="Search page">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
      itemscope itemtype="https://schema.org/SearchResultsPage"
    >
      <header class="entry-header">
        <h1 id="page-title" class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
      </header>

      <div class="entry-content">
        <?php
          // Optional intro/instructions edited in the page body
          the_content();
        ?>
      </div>

      <?php get_template_part('template-parts/search-overlay');  ?>
    </article>

  <?php endwhile; else : ?>

    <?php get_template_part( 'template-parts/content', 'none' ); ?>

  <?php endif; ?>
</main>

<?php
get_footer();
