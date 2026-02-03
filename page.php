<?php

get_header();
?>

<main id="main-content" class="site-main" aria-labelledby="page-title-<?php the_ID(); ?>">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
      itemscope
      itemtype="https://schema.org/WebPage"
    >

      <header class="entry-header">
        <h1 id="page-title-<?php the_ID(); ?>" class="entry-title"> <?php the_title(); ?> </h1>
        <?php
        // For posts only, you might add meta (date, categories). Skip for pages.
        ?>
      </header>

      <?php if ( has_post_thumbnail() ) : ?>
        <figure class="post-thumbnail">
          <?php the_post_thumbnail( 'large', [ 'loading' => 'lazy' ] ); ?>
        </figure>
      <?php endif; ?>

      <div class="entry-content">
        <?php
          the_content();

          // Support paginated posts (<!--nextpage-->)
          wp_link_pages( [
            'before' => '<nav class="page-links">' . __( 'Pages:', 'LambrosPersonalTheme' ),
            'after'  => '</nav>',
          ] );
        ?>
      </div>

      <footer class="entry-footer">
        <?php edit_post_link( __( 'Edit', 'LambrosPersonalTheme' ), '<span class="edit-link">', '</span>' ); ?>
      </footer>

    </article>

    <?php
      // Optional: load comments area if you enable comments
      if ( comments_open() || get_comments_number() ) {
        comments_template();
      }
    ?>

  <?php endwhile; else : ?>

    <?php get_template_part( 'template-parts/content', 'none' ); ?>

  <?php endif; ?>
</main>

<?php
get_footer();
