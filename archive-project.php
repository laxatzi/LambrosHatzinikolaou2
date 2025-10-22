<?php
 get_header();
?>

<main id="main-content" aria-labelledby="archive-project-title">
  <div class="container">
    <header class="archive-header">
      <?php
      // Title + description (WP will escape these appropriately)

        the_archive_title('<h1>','</h1>');
        the_archive_description('<p>','</p>');
      ?>
    </header>
    <section id="posts">
      <?php
        while(have_posts()) :
          the_post();
          get_template_part('template-parts/project-presentation');
        endwhile;
      ?>
    </section>
  </div>
</main>

<?php
  get_footer();
