<?php
 get_header();
?>
<main>
  <div class="container">
 <h2>Your search query was "<span class='search-query'><?php echo esc_html(get_search_query(false)) ?></span>"</h2>
    <section id="posts">
      <?php
        while(have_posts()) {
          the_post();
          get_template_part('/template-parts/search-content');

        }

        echo paginate_links();
      ?>

    </section>
</div>
</main>
<?php
  get_footer();
?>