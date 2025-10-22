<?php
 get_header();
?>
<main id="main-content" aria-labelledby="archive-title">
  <div class="container">
    <header class="archive-header">
        <?php
        // Title + description (WP will escape these appropriately)
          the_archive_title('<h1>','</h1>');
          the_archive_description('<p>','</p>');
        ?>
      </header>
    <section id="posts">
       <h1><?php the_archive_title(); ?></h1>
       <p><?php the_archive_description(); ?></p>

      <?php
        while(have_posts()) {
          the_post();
          get_template_part('template-parts/blog-presentation');
        }

        echo paginate_links();
      ?>

    </section>
</div>
</main>
<?php
  get_footer();
