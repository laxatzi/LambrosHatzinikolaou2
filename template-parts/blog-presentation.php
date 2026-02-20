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
              <span class="read-time" itemprop="timeRequired"> 
                <svg class="read-time-icon" width="14" height="14" viewBox="0 0 24 24" aria-hidden="true">
                  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/> 
                  <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/> 
                </svg>
                <?php
               /**
                 * Display the estimated reading time for a blog post.
                 *
                 * Retrieves the reading time in minutes using the lambros_get_reading_time() function
                 * and outputs it with proper internationalization support for both singular and plural forms.
                 * The text is escaped for security before being displayed.
                 *
                 * @since 1.0.0
                 *
                 * @return void Outputs the reading time string directly to the page.
                 *
                 * @uses lambros_get_reading_time() To get the calculated reading time in minutes.
                 * @uses _n() For proper pluralization of the reading time text.
                 * @uses esc_html() To safely escape the output for display.
                 */
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
         /**
             * Displays the post categories as a list item with tag styling.
             *
             * Retrieves all categories associated with the current post and outputs them
             * as a comma-separated list wrapped in an HTML list item element with the
             * 'taglist' and 'tag' CSS classes. If no categories are assigned to the post,
             * nothing is output.
             *
             * @since 1.0.0
             *
             * @global void Uses get_the_category_list() WordPress function
             *
             * @return void Echoes HTML output directly
             */
          $categories = get_the_category_list( '' );
          echo $categories ? '<li class="taglist tag">' . $categories . '</li>' : '';
         ?>
      </ul>
    </div>
    <div class="post-excerpt" itemprop="description">
      <?php
      /**
         * Displays the post excerpt or a trimmed version of the post content.
         *
         * If the post has an excerpt defined, it will be displayed.
         * Otherwise, the first 26 words of the post content will be shown.
         *
         * @return void Outputs the excerpt or trimmed content directly to the page.
         */
        if (has_excerpt()) {
          echo get_the_excerpt();
        } else {
          echo wp_trim_words( get_the_content(), 26 );
        } ?>
    </div>

    <?php
      /**
       * Displays a "Read More" link for blog post excerpts.
       *
       * This section renders a wrapper container with an anchor tag that links to the full post.
       * The link includes proper escaping for security and an accessible aria-label that announces
       * the post title to screen readers.
       *
       * @uses get_permalink() - Retrieves the full permalink of the current post
       * @uses esc_url() - Escapes URL for safe HTML output
       * @uses get_the_title() - Gets the current post title
       * @uses esc_attr() - Escapes attribute for safe HTML output
       * @uses esc_html() - Escapes HTML content for safe display
       * @uses esc_html__() - Escapes and translates a string with text domain
       *
       * @textdomain LambrosPersonalTheme - The theme's text domain for localization
       *
       * @return void - Outputs HTML directly to the page
       */
      ?>
    <div class="read-more-wrapper">
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read_more" 
          aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'LambrosPersonalTheme' ), 
          esc_html(get_the_title() ) ) ); ?>"> 
      <?php echo esc_html__( 'Read More', 'LambrosPersonalTheme' ); ?> </a>
    </div>
  </div>
</article>
