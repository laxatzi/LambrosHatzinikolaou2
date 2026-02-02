<article class="the-post" itemscope
  itemtype="https://schema.org/BlogPosting">
  <div class="post-title--wrapper">
    <div class="the-post_title">
      <h3 class="posts">
        <a href="<?php echo esc_url( get_permalink() ); ?>" itemprop="url">
          <span itemprop="headline"><?php the_title(); ?></span>
        </a>
        <small class="project-date">
              <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
              itemprop="datePublished">
            <?php echo get_the_date( get_option( 'l F j, Y' ) ); ?>
        </small>
      </h3>
    </div>
    <div class="tags" itemprop="keywords">
      <ul class="taglist-parent">
        <?php
          $categories = get_the_category_list( '' );
          echo $categories ? '<li class="taglist tag">' . $categories . '</li>' : '';
         ?>
      </ul>
    </div>
    <div class="post-excerpt" itemprop="description">
    <?php
      if (has_excerpt()) {
        echo get_the_excerpt();
      } else {
        echo wp_trim_words(get_the_content(), 26);
      } ?>
    </div>
    <div class="read-more-wrapper">
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read_more" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'LambrosPersonalTheme' ), get_the_title() ) ); ?>"> <?php echo esc_html__( 'Read More', 'LambrosPersonalTheme' ); ?> </a>
    </div>
  </div>
</article>
