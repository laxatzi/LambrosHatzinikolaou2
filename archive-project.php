<?php
 get_header();
?>

<main id="main-content" aria-labelledby="archive-project-title">
  <div class="container">
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
