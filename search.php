<?php
 get_header();
?>
<main class="layout__main" aria-labelledby="search-title">
  <div class="container">
    <h1 id="search-title">
      <?php
      printf(
        esc_html__( 'Search results for "%s"', 'LambrosPersonalTheme' ),
        esc_html( get_search_query() )
      );
      ?>
    </h1>
   <section id="posts" class="section" aria-labelledby="search-results-title">
      <h2 id="search-results-title" class="u-sr-only"><?php esc_html_e( 'Search results', 'LambrosPersonalTheme' ); ?></h2>
     <?php
        if (have_posts()) {
          $has_non_page_results = false;
          while (have_posts()) {
            the_post();
            if ('page' === get_post_type()) {
              continue;
            }
            $has_non_page_results = true;
            get_template_part( '/template-parts/search-content' );
          }
          if ( ! $has_non_page_results ) {
            echo '<h3 class="search-query--heading">' .
	                   esc_html__( 'No results match the search.', 'LambrosPersonalTheme' ) .
                 '</h3>';
              }
          else {
            echo '<h3 class="search-query--heading">' .
	                  esc_html__( 'No results match the search.', 'LambrosPersonalTheme' ) .
                  '</h3>';
              }
      ?>
      <div class="search-performer">
       <div id="search-page-form"> <?php get_search_form(); ?> </div>
       
      </div>
    </section>
</div>
</main>
<?php
  get_footer();
