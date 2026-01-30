<article class="the-project">
  <h3 class="project-title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php echo get_the_date( get_option( 'l F j, Y' ) ); ?>
  </h3>
 <p class="project-desc">
  <?php
    if (has_excerpt()) {
        echo get_the_excerpt();
      } else {
        echo wp_trim_words(get_the_content(), 26);
      } ?>
  </p>
  <div class="buttons">
    <a href="<?php the_permalink(); ?>">project article</a>
    <a href="https://github.com/laxatzi">source code</a>
  </div>
</article>
