      <div class="the-post">
        <div class="the-post_title">
          <h3 class="posts">
            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
            <small><?php echo get_the_date( 'l F j, Y' ); ?></small>
          </h3>
        </div>
        <div class="tags">
          <ul class="taglist-parent">
            <li class="taglist tag">
              <?php echo get_the_category_list(' / ') ?>
            </li>
          </ul>
        </div>
        <div><?php
         if (has_excerpt()) {
            echo get_the_excerpt();
          } else {
            echo wp_trim_words(get_the_content(), 26);
          } ?></div>
          <a href="<?php the_permalink(); ?>" class="read_more">Read More</a>
      </div>
