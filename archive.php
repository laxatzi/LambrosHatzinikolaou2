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
    do_action('lambros_before_archive_loop');
    
     if ( have_posts() ) : ?>
      <header class="archive-header" aria-labelledby="archive-title">
        <?php
        // Title + description (WP will escape these appropriately)
          the_archive_title('<h1>','</h1>');
          the_archive_description('<p>','</p>');
        ?>
      </header>
      <section id="posts">
      <?php
        while(have_posts()) :
          the_post();
          get_template_part('template-parts/blog-presentation');
        endwhile;        
      ?>
      </section>
      <?php
      // Accessible pagination
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
    do_action('lambros_after_archive_loop');
    ?>
   </div>
</main>
<?php
  get_footer();
