<?php
 get_header();
?>
<main style="margin-top:50px">
  <div class="container">
 <h2>Your search query was "<span class='search-query'><?php echo esc_html(get_search_query(false)) ?></span>"</h2>
    <section id="posts">
      <?php
         if (have_posts() && 'page' !== get_post_type()) {
          while(have_posts()) {
            the_post();
            get_template_part('/template-parts/search-content');
          }
          echo paginate_links();
        } else {
          echo "<h3 class=\"search-query--heading\">No results much the search!</h3>";
        }

          get_search_form();
      ?>
    <div id="live-search-results" class="live-search-results" aria-live="polite"></div>
    </section>
</div>
</main>
<?php
  get_footer();
