<?php

get_header();
?>

<main id="main-content" class="site-main" aria-labelledby="page-title-<?php the_ID(); ?>">
  <?php 
  
    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
        itemscope
        itemtype="https://schema.org/WebPage"
      >
  
        <header class="entry-header">
          <h1 id="page-title-<?php the_ID(); ?>" class="entry-title"
            itemprop="headline">
             <?php the_title(); ?>
          </h1>
          <?php
          // For posts only, you might add meta (date, categories). Skip for pages.
          ?>
        </header>

      <?php 
      /**
       * Displays the post thumbnail image if one is set for the current post.
       *
       * Renders the featured image wrapped in a figure element with the 'post-thumbnail' class.
       * The image is displayed at 'large' size with lazy loading enabled for improved performance.
       *
       * @since 1.0.0
       * @return void
       */
        if ( has_post_thumbnail() ) : ?>
          <figure class="post-thumbnail">
            <?php the_post_thumbnail( 'large', [ 'loading' => 'lazy' ] ); ?>
          </figure>
      <?php endif; ?>

      <div class="entry-content" itemprop="mainEntity">
        <?php
       /**
         * Display the main page content with pagination support.
         *
         * Outputs the page content and handles paginated posts separated by
         * the WordPress <!-- nextpage --> tag. Navigation links are wrapped
         * in a nav element with appropriate styling.
         *
         * @uses the_content() - Displays the post content
         * @uses wp_link_pages() - Creates navigation links for paginated content
         *
         * @return void
         */
          the_content();

          // Support paginated posts (<!--nextpage-->)
          wp_link_pages( [
            'before' => '<nav class="page-links">' . __( 'Pages:', 'LambrosPersonalTheme' ),
            'after'  => '</nav>',
          ] );
        ?>
      </div>

      <footer class="entry-footer">
      <?php 
         /**
         * Displays an edit link for the current page in the frontend.
         *
         * The edit link is only visible to users with permission to edit the page.
         * The link text is internationalized and can be translated.
         *
         * @uses edit_post_link() WordPress function to generate the edit link
         *
         * @param string 'Edit this page' The text displayed in the edit link
         * @param string '<span class="edit-link">' Opening HTML markup wrapper
         * @param string '</span>' Closing HTML markup wrapper
         * @param string 'LambrosPersonalTheme' Text domain for translation
         *
         * @return void Outputs HTML directly to the page
         */
        edit_post_link( __( 'Edit', 'LambrosPersonalTheme' ), '<span class="edit-link">', '</span>' ); ?>
        </footer>

    </article>

    <?php
    /**
     * Displays the comments section for a page template.
     *
     * If comments are open or if there are existing comments on the page,
     * the comments template is loaded. If the main loop contains no posts,
     * a 'no content' template part is displayed as a fallback.
     *
     * @since 1.0.0
     * @return void
     */
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
