<section class="no-results not-found">

  <?php if ( is_search() ) : ?>

    <header class="page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'No results found', 'LambrosPersonalTheme' ); ?>
      </h1>
    </header>

    <div class="no-results-explanation">
      <p>
        <?php esc_html_e( 'Sorry, but nothing matched your search terms. Try searching again with different keywords.', 'LambrosPersonalTheme' ); ?>
      </p>
    </div>

    <div class="no-results-search">
      <?php get_search_form(); ?>
    </div>


  <?php elseif ( is_archive() ) : ?>

    <header class="page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'Nothing here yet', 'LambrosPersonalTheme' ); ?>
      </h1>
    </header>

    <div class="no-results-explanation">
      <p>
        <?php esc_html_e( 'This archive does not contain any posts yet.', 'LambrosPersonalTheme' ); ?>
      </p>
    </div>

    <div class="no-results-search">
      <?php get_search_form(); ?>
    </div>


  <?php elseif ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

    <header class="page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'Ready to publish your first post?', 'LambrosPersonalTheme' ); ?>
      </h1>
    </header>

    <div class="no-results-explanation">
      <p>
        <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
          <?php esc_html_e( 'Click here to start writing.', 'LambrosPersonalTheme' ); ?>
        </a>
      </p>
    </div>


  <?php else : ?>

    <header class="page-header no-results-header">
      <h1 class="page-title">
        <?php esc_html_e( 'No content found', 'LambrosPersonalTheme' ); ?>
      </h1>
    </header>

    <div class="no-results-explanation">
      <p>
        <?php esc_html_e( 'We couldn’t find anything here. Try searching for something else.', 'LambrosPersonalTheme' ); ?>
      </p>
    </div>

    <div class="no-results-search">
      <?php get_search_form(); ?>
    </div>

  <?php endif; ?>

</section>

