<?php
 get_header();
?>
<main style="margin-top:50px" class="layout__main" aria-labelledby="search-title">
  <div class="container">
  <h2 id="search-title">Your search query was "<span class='search-query'><?php echo esc_html( get_search_query( false ) ); ?></span>"</h2>
   <section id="posts" class="section" aria-labelledby="search-results-title">
     <h2 id="search-results-title" class="u-sr-only">
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
            echo "<h3 class=\"search-query--heading\">No results match the search!</h3>";
          }

        } else {
          echo "<h3 class=\"search-query--heading\">No results match the search!</h3>";
        }
      ?>
       <label for="search-type" class="search-type__label"> <?php esc_html_e( 'Filter by type:', 'LambrosPersonalTheme' ); ?> </label>
       <select id="search-type" class="search-type">
          <option value="any"><?php esc_html_e( 'All', 'LambrosPersonalTheme' ); ?></option>
          <option value="post"><?php esc_html_e( 'Posts', 'LambrosPersonalTheme' ); ?></option>
          <option value="page"><?php esc_html_e( 'Pages', 'LambrosPersonalTheme' ); ?></option>
          <option value="project"><?php esc_html_e( 'Projects', 'LambrosPersonalTheme' ); ?></option>
       </select>
       <div id="search-page-form"> <?php get_search_form(); ?> </div>
       <div id="live-search-results" class="live-search__results" aria-live="polite"></div>
 
    </section>
</div>
</main>
<?php
  get_footer();
