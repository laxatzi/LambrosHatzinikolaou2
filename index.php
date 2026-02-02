<?php
 get_header();
?>
<main id="main-content">
<div class="dot-bg-section-1"></div>
  <div class="container">
    <section id="posts" aria-labelledby="posts-title">
      <h1 id="posts-title" class="screen-reader-text">
        <?php esc_html_e('Posts', 'LambrosPersonalTheme'); ?>
      </h1>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <article id="post-<?php the_ID(); ?>" <?php post_class('the-post'); ?> itemscope itemtype="https://schema.org/BlogPosting" class="the-post fade-up">
           <header class="the-post_title">
             <h2 class="posts">
               <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                 <?php the_title(); ?>
               </a>
             </h2>
             <small class="the-date">
               <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
                 <?php echo esc_html( get_the_date( 'l F j, Y' ) ); ?>
               </time>
             </small>
            </header>

          <?php
            $categories = get_the_category_list( ' / ' ); // already escaped HTML list
            if ( $categories ) :
          ?>
            <div class="tags">
              <ul class="taglist-parent">
                <?php
                  $cats = get_the_category(); foreach ( $cats as $cat ) { 
                    echo '<li class="taglist tag">
                            <a href="' . esc_url( get_category_link( $cat ) ) . '">' 
                             . esc_html( $cat->name ) .
                            '</a>
                          </li>'; 
                  }
                ?>
              </ul>
            </div>
          <?php endif; ?>

          <div class="entry-summary">
          <?php
              $excerpt        = get_the_excerpt();
              $excerpt_length = 26;
              if ( $excerpt ) {
                echo wp_kses_post( wpautop( $excerpt ) );
              } else {
                echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_content() ), $excerpt_length, '…' ) );
              }
            ?>
          </div>

          <p>
            <a class="read_more" href="<?php echo esc_url( get_permalink() ); ?>">
              <?php esc_html_e('Read more', 'LambrosPersonalTheme'); ?>
            </a>
          </p>

        </article>
     <?php
       endwhile; else : ?>
       <p><?php esc_html_e('No posts found.', 'LambrosPersonalTheme'); ?></p>

     <?php endif; ?>

 // Accessible pagination with proper landmarks
     <?php
        the_posts_pagination([
          'mid_size'           => 1,
          'prev_text'          => '<span class="screen-reader-text">'.esc_html__('Previous','LambrosPersonalTheme').'</span><span aria-hidden="true">Previous</span>',
          'next_text'          => '<span class="screen-reader-text">'.esc_html__('Next','LambrosPersonalTheme').'</span><span aria-hidden="true">Next</span>',
          'screen_reader_text' => esc_html__('Posts navigation','LambrosPersonalTheme'),
          'aria_label'         => esc_html__('Posts','LambrosPersonalTheme'),
          'class'              => 'posts-pagination', // adds this to the <nav>
        ]);

    ?>
 </section>
</div>
<div class="dot-bg-section-2"></div>
</main>
<?php
  get_footer();
