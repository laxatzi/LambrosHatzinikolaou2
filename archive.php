<?php
 get_header();
?>
<main id="main-content" aria-labelledby="archive-title">
  <div class="container">
  <?php
    /**
     * Fires before archive page content.
     *
     * @since 1.0.0
     */
    do_action( 'lambros_before_archive_loop' );
    
     if ( have_posts() ) : ?>
      <header class="archive-header" aria-labelledby="archive-title">
        <?php
        // Title + description (WP will escape these appropriately)
          the_archive_title( '<h1>','</h1>' );
          the_archive_description( '<p>','</p>' );
        ?>
      </header>
      <section id="posts">
      <?php
        while(have_posts()) :
          the_post();
          get_template_part( 'template-parts/blog-presentation' );
        endwhile;        
      ?>
      </section>
   
      <?php
      
    /**
       * Display paginated navigation for archive pages.
       *
       * Renders pagination links for navigating between pages of posts on archive pages.
       * Includes previous/next navigation with accessible labels and screen reader text.
       *
       * @uses the_posts_pagination() WordPress template tag
       *
       * Configuration:
       * - mid_size: Number of page links to show around current page (set to 1)
       * - prev_text: HTML for previous page link with accessibility label and arrow icon
       * - next_text: HTML for next page link with accessibility label and arrow icon
       * - screen_reader_text: Label for screen readers describing the navigation section
       * - class: CSS class applied to the pagination wrapper ('posts-pagination')
       *
       * Text strings are localized using the 'LambrosPersonalTheme' text domain.
       */
        the_posts_pagination( [
          'mid_size'           => 1,
          'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'LambrosPersonalTheme' ) . '</span><span aria-hidden="true">←</span>',
          'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next', 'LambrosPersonalTheme' ) . '</span><span aria-hidden="true">→</span>',
          'screen_reader_text' => esc_html__( 'Posts navigation', 'LambrosPersonalTheme' ),
          'class'              => 'posts-pagination',
        ] );
      ?>
    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; 
   
    /**
     * Fires after archive page content.
     *
     * @since 1.0.0
     */
    do_action( 'lambros_after_archive_loop' );
    ?>
   </div>
</main>
<?php
  get_footer();
