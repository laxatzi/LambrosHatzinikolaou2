<?php
 get_header();
?>

  <main id="main-content" aria-labelledby="archive-project-title">
    <section id="posts">
       <h1>Projects</h1>
       <p><?php the_archive_description(); ?></p>

      <?php
        while(have_posts()) {
          the_post();
          get_template_part('template-parts/project-presentation');
        }

        echo paginate_links();
      ?>

    </section>
</main>

<?php
  get_footer();
