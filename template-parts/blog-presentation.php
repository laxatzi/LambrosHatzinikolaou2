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
            <?php echo get_the_date( get_option( LAMBROS_DATE_FORMAT ) ); ?>
<!-- ⭐ Read time indicator -->
              <span class="read-time" itemprop="timeRequired"> <svg class="read-time-icon" width="14" height="14" viewBox="0 0 24 24" aria-hidden="true"> <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/> <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/> </svg>
                • <?php
                    $minutes = lambros_get_reading_time();
                    echo esc_html( sprintf(
                      _n( '%d min read', '%d mins read', $minutes, 'LambrosPersonalTheme' ),
                      $minutes
                    ) );
                  ?>
              </span>
            </time>
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
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read_more" 
          aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'LambrosPersonalTheme' ), 
          esc_html(get_the_title() ) ) ); ?>"> 
      <?php echo esc_html__( 'Read More', 'LambrosPersonalTheme' ); ?> </a>
    </div>
  </div>
</article>
