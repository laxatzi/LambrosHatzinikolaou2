<article class="the-post">
  <div class="post-title--wrapper">
    <div class="the-post_title">
      <h3 class="posts">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
        <?php the_title(); ?></a>
        <small class="project-date">
            <?php echo get_the_date( get_option( 'l F j, Y' ) ); ?>
        </small>
      </h3>
    </div>
    <div class="tags">
      <ul class="taglist-parent">
        <?php
          $categories = get_the_category_list( '' );
          echo $categories ? '<li class="taglist tag">' . $categories . '</li>' : '';
         ?>
      </ul>
    </div>
    <div>
    <?php
      if (has_excerpt()) {
        echo get_the_excerpt();
      } else {
        echo wp_trim_words(get_the_content(), 26);
      } ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="read_more">Read More</a>
  </div>
</article>
