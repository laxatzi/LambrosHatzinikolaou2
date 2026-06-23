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
       if ( have_posts() ) :
		   while ( have_posts() ) :
             the_post();
             get_template_part( 'template-parts/search-content' );
		   endwhile;
            the_posts_pagination();
	   else :
         echo '<h3 class="search-query--heading">';
           esc_html_e( 'No results match the search.', 'LambrosPersonalTheme' );
         echo '</h3>';
         echo '<div class="search-performer">';
           echo '<div id="search-page-form">';
             get_search_form();
           echo '</div>';
         echo '</div>';

       endif;
      ?>

    </section>
</div>
</main>
<?php
  get_footer();
