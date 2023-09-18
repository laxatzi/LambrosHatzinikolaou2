<?php
 get_header();
?>
<main>
  <div class="container">
    <section id="posts">
       <h1>Projects</h1>
       <p><?php the_archive_description(); ?></p>

      <?php
        while(have_posts()) {
          the_post();
      ?>

   <div class="the-project">
      <h3 class="project-title">
        <?php the_title(); ?>
        <small><?php echo get_the_date( 'l F j, Y' ); ?></small>
      </h3>

        <div><?php
        if (has_excerpt()) {
           get_the_excerpt();
        }else {
          echo wp_trim_words(get_the_content(), 26);
        } ?></div>
        <a href="<?php the_permalink(); ?>" class="read_more">Read More</a>
      </div>
      <?php
        }
        echo paginate_links();
      ?>

    </section>
</div>
</main>
<?php
  get_footer();
?>