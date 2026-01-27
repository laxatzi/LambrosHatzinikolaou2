<section class="no-results not-found">
  <?php if ( is_search() ) : ?>
 <!-- Header -->
    <header class="error-page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'No results found', 'LambrosPersonalTheme' ); ?>
      </h1>
      <h2 class="page-subtitle">
        <?php
        printf(
          /* translators: %s: "Sorry" or equivalent */
          esc_html__( '%s, no results matched your search.', 'LambrosPersonalTheme' ),
          '<span class="subtitle-emphasis">' . esc_html__( 'Sorry', 'LambrosPersonalTheme' ) . '</span>'
        );
        ?>
      </h2>
    </header>

    <div class="no-results-explanation error-explanation">
      <p>
       <?php esc_html_e( 'Try adjusting your search terms or explore some of our recent content below.', 'LambrosPersonalTheme' ); ?>
      </p>      
    </div>

<!-- Search Form -->
    <div class="error-search">
      <h3><?php esc_html_e( 'Try searching again:', 'LambrosPersonalTheme' ); ?></h3>
      <?php get_search_form(); ?>
    </div>
  
<!-- Back to Home -->
    <div class="back-to-home">
      <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span aria-hidden="true">←</span>
        <?php esc_html_e( 'Back to home page', 'LambrosPersonalTheme' ); ?>
      </a>
    </div>
  
<!-- Recent Posts -->
  <div class="recent-posts-404">
      <?php the_widget( 'WP_Widget_Recent_Posts', [ 'number' => 3 ], [ 'before_title' => '<h3>', 'after_title' => '</h3>' ] ); ?>
  </div>

  <?php elseif ( is_archive() ) : ?>

    <header class="error-page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'Nothing here yet', 'LambrosPersonalTheme' ); ?>
      </h1>
      <h2 class="page-subtitle">
        <?php
        printf(
          esc_html__( '%s, this archive is empty.', 'LambrosPersonalTheme' ),
          '<span class="subtitle-emphasis">' . esc_html__( 'Oops', 'LambrosPersonalTheme' ) . '</span>'
        );
        ?>
      </h2>
    </header>

    <div class="no-results-explanation error-explanation">
      <p>
        <?php esc_html_e( 'There are no posts here yet. You can try searching or browse recent posts.', 'LambrosPersonalTheme' ); ?>
      </p>
    </div>

    <div class="no-results-search error-search">
      <h3><?php esc_html_e( 'Search the site:', 'LambrosPersonalTheme' ); ?></h3>
      <?php get_search_form(); ?>
    </div>

   <div class="back-to-home">
      <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span aria-hidden="true">←</span>
        <?php esc_html_e( 'Back to home page', 'LambrosPersonalTheme' ); ?>
      </a>
   </div>

    <div class="recent-posts-404">
      <?php the_widget( 'WP_Widget_Recent_Posts', [ 'number' => 5 ], [ 'before_title' => '<h3>', 'after_title' => '</h3>' ] ); ?>
    </div>


  <?php elseif ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

   <!-- Header -->
    <header class="error-page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'Ready to publish your first post?', 'LambrosPersonalTheme' ); ?>
      </h1>
      <h2 class="page-subtitle">
        <?php
        printf(
          esc_html__( '%s, your blog is empty.', 'LambrosPersonalTheme' ),
          '<span class="subtitle-emphasis">' . esc_html__( 'Welcome', 'LambrosPersonalTheme' ) . '</span>'
        );
        ?>
      </h2>
    </header>

    <div class="no-results-explanation error-explanation">
        <p>
          <?php esc_html_e( 'Ready to publish your first post?', 'LambrosPersonalTheme' ); ?>
        </p>
    </div>

    <div class="back-to-home">
      <a class="button" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
        <span aria-hidden="true">✎</span>
        <?php esc_html_e( 'Create your first post', 'LambrosPersonalTheme' ); ?>
      </a>
    </div>

  <?php else : ?>
    <!-- Header -->
    <header class="error-page-header">
      <h1 id="page-title">0</h1>
      <h2 class="page-subtitle">
        <?php
        printf(
          esc_html__( '%s, we couldn’t find anything here.', 'LambrosPersonalTheme' ),
          '<span class="subtitle-emphasis">' . esc_html__( 'Sorry', 'LambrosPersonalTheme' ) . '</span>'
        );
        ?>
      </h2>
    </header>
  
    <div class="error-explanation no-results-explanation">
      <p>
        <?php esc_html_e( 'Try searching for something else or explore recent posts below.', 'LambrosPersonalTheme' ); ?>
      </p>
    </div>
  
    <div class="error-search no-results-search">
      <h3><?php esc_html_e( 'Search the site:', 'LambrosPersonalTheme' ); ?></h3>
      <?php get_search_form(); ?>
    </div>

  <?php endif; ?>

</section>

