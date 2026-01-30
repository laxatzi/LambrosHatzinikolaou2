<article class="the-project">
  <h3 class="project-title">
    <a href="<?php echo esc_url( get_permalink() ); ?>">
     <?php the_title(); ?>
    </a>
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
   <a href="<?php echo esc_url( get_permalink() ); ?>"> <?php echo esc_html__( 'Project article', 'LambrosPersonalTheme' ); ?> </a>
   <a href="https://github.com/laxatzi/LambrosHatzinikolaou2.git"> <?php echo esc_html__( 'Source code', 'LambrosPersonalTheme' ); ?> </a>
  </div>
</article>
