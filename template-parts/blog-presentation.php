<article class="the-post" itemscope
         itemtype="https://schema.org/BlogPosting">
    <div class="the-post__title-wrapper">
        <div class="tags" itemprop="keywords">
          <ul class="taglist__parent">

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
        <div class="the-post__title">

          <h3 class="post flex-column">
            <a href="<?php echo esc_url( get_permalink() ); ?>" itemprop="url" class="post__title-link">
              <span itemprop="headline"><?php the_title(); ?></span>
            </a>


          </h3>
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
          if ( has_excerpt() ) {
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
      <div class="read-more__wrapper">
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read_more" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'LambrosPersonalTheme' ), get_the_title() )); ?>"> <?php echo esc_html__( 'Read More', 'LambrosPersonalTheme' ); ?> </a>
      </div>

    </div>
</article>
