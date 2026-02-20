<section class="no-results not-found">
  <?php if ( is_search() ) : ?>
 <!-- Header -->
    <header class="error-page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'No results found', 'LambrosPersonalTheme' ); ?>
      </h1>
      <h2 class="page-subtitle">
        <?php
       /**
         * Displays a message when no search results are found.
         *
         * Outputs a localized "Sorry, no results matched your search" message with
         * the word "Sorry" emphasized in a span element with the class 'subtitle-emphasis'.
         *
         * @since 1.0.0
         * @return void
         */
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

    <?php
    /**
     * Displays a search form when no content is found.
     *
     * This section provides users with an error message and a search form
     * to allow them to search again after no results are found.
     *
     * @since 1.0.0
     */
    ?>
    <div class="error-search">
      <h3><?php esc_html_e( 'Try searching again:', 'LambrosPersonalTheme' ); ?></h3>
      <?php get_search_form(); ?>
    </div>
    
 <?php
  /**
   * Renders a "Back to home page" navigation button.
   *
   * This section displays a clickable button that directs users back to the home page.
   * The button includes a left arrow icon (←) for visual indication and uses proper
   * escaping for security. The link text is translatable for multi-language support.
   *
   * @since 1.0.0
   */
  ?>
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
       /**
         * Displays an empty archive message with emphasis.
         *
         * Outputs a localized message indicating that the current archive has no content.
         * The message includes an emphasized "Oops" text as a subtitle prefix.
         *
         * @since 1.0.0
         *
         * Text Domain: LambrosPersonalTheme
         */
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
  
    <?php
    /**
     * Displays a search form when no search results are found.
     *
     * This section is rendered when a search query returns no matching posts or pages.
     * It provides users with an alternative search interface to refine their search.
     *
     * @since 1.0.0
     */
     ?>
    <div class="no-results-search error-search">
      <h3><?php esc_html_e( 'Search the site:', 'LambrosPersonalTheme' ); ?></h3>
      <?php get_search_form(); ?>
    </div>
    
   <?php
    /**
     * Renders a "Back to home page" button that navigates to the website's homepage.
     *
     * Displays a clickable button with a left arrow icon and text label that links
     * to the home URL. Both the URL and text are properly escaped for security.
     * The arrow icon is hidden from screen readers using aria-hidden attribute.
     *
     * @return void
     */
     ?>
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

    <div class="back-to-home">
      <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span aria-hidden="true">←</span>
        <?php esc_html_e( 'Back to home page', 'LambrosPersonalTheme' ); ?>
      </a>
    </div>

    <div class="recent-posts-404">
      <?php the_widget( 'WP_Widget_Recent_Posts', [ 'number' => 5 ], [ 'before_title' => '<h3>', 'after_title' => '</h3>' ] ); ?>
    </div>

  <?php endif; ?>

</section>

