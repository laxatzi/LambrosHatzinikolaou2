  <article <?php post_class(); ?> itemscope itemtype="https://schema.org/Article" >
    <?php
        /**
         * Hook: lambros_before_post_content
         */
        do_action( 'lambros_before_post_content' );
    ?>
  <!-- Featured Image -->
    <?php 
    /**
     * Displays the featured image for a single post.
     *
     * Renders the post thumbnail with schema.org ImageObject microdata markup.
     * The image is set to 'large' size and includes accessibility attributes.
     *
     * @since 1.0.0
     */
     if ( has_post_thumbnail() ) : ?>
      <div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <?php
          the_post_thumbnail( 'large', [
            'itemprop' => 'url',
            'alt'      => get_the_title()
          ] );
        ?>
      </div>
     <?php endif; ?>
        <!-- Header -->
    <header class="entry-header" >
      <h1 id="post-title-<?php the_ID(); ?>" class="entry-title" itemprop="headline">
        <?php the_title(); ?>
      </h1>

      <div class="header-info">
        <div class="header-metadata">

        <!-- Published Date -->
          <time datetime="<?php echo esc_attr( get_the_date( LAMBROS_DATE_FORMAT ) ); ?>" itemprop="datePublished">
              <?php echo esc_html( get_the_date( LAMBROS_DATE_FORMAT ) ); ?>
          </time>
        <!-- Modified date (hidden visually, important for SEO) -->
          <meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>" >
          <?php
              $published = get_the_date( 'U' );
              $modified  = get_the_modified_date( 'U' );
              $diff_days = ( $modified - $published ) / DAY_IN_SECONDS;
  
             
            /**
             * Display an updated notice if the post was modified more than 7 days ago.
             *
             * Shows a notice box containing the last modified date of the current post,
             * but only displays if the difference between the current date and the
             * modified date is greater than 7 days.
             *
             * The notice uses the LAMBROS_DATE_FORMAT constant for date formatting
             * and the 'LambrosPersonalTheme' text domain for internationalization.
             *
             * @global int $diff_days The number of days since the post was last modified.
             * @uses get_the_modified_date() To retrieve the post's last modified date.
             * @uses esc_html__() To safely output translated text.
             * @uses esc_html() To safely escape HTML output.
             *
             * @return void
             */
              if ( $diff_days > 7 ) :
            ?>
            <div class="updated-notice">
              <?php
                printf(
                    esc_html__( 'Updated on %s', 'LambrosPersonalTheme' ),
                    esc_html( get_the_modified_date( LAMBROS_DATE_FORMAT ) )
                );
              ?>
            </div>
            <?php endif; ?>

        <!-- Author -->
            <?php 
            /**
             * Displays the author byline for single posts.
             *
             * Renders a byline section with the author's name and link to their posts archive page.
             * Only displays for posts (not other post types). Includes schema.org markup for better SEO.
             *
             * @since 1.0.0
             *
             * @return void
             */
              if ( get_post_type() === "post" ) : ?>
              <span class="byline">
                <span class="author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
                  <?php esc_html_e( 'Written by', 'LambrosPersonalTheme' ); ?>
                  <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>" itemprop="url">
                    <span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
                  </a>
                </span>
              </span>
            <?php endif; ?>

          <!-- ⭐ Read time indicator -->
              <span class="read-time" itemprop="timeRequired">
              <?php
                 /**
                   * Display reading time estimate for a post
                   *
                   * Outputs an SVG icon followed by the estimated reading time in minutes.
                   * Uses internationalization to support singular and plural forms.
                   *
                   * @hook lambros_get_reading_time_icon() - Retrieves and echoes the SVG icon for reading time
                   * @hook lambros_get_reading_time() - Calculates and returns the estimated reading time in minutes
                   *
                   * @uses _n() For pluralization support between 'min read' and 'mins read'
                   * @uses esc_html() To safely escape the reading time output
                   * @uses sprintf() To format the reading time string with the minute value
                   *
                   * @global string 'LambrosPersonalTheme' Text domain for translations
                   *
                   * @example
                   * The output might appear as: [icon] 5 mins read
                   */
                  ?>

                  <?php echo lambros_get_reading_time_icon(); // Get the SVG icon for reading time ?>
                  <?php
                    $minutes = lambros_get_reading_time();
                    echo esc_html( sprintf(
                      _n( '%d min read', '%d mins read', $minutes, 'LambrosPersonalTheme' ),
                      $minutes
                    ) );
                  ?>
              </span>

        </div> <!-- header-metadata -->

        <!-- Categories -->
        <?php 
        /**
         * Display post categories section for single post view.
         *
         * This block renders a categorized section that displays all categories
         * associated with the current post. It only appears when viewing a single
         * post that has at least one category assigned.
         *
         * The output includes:
         * - A label "Categories:" (translatable)
         * - A navigation element containing comma-separated category links
         * - Proper semantic markup with itemProp for article schema
         * - Accessibility support with aria-label
         *
         * @package PersonalWebsite
         * @since 1.0.0
         *
         * @uses get_post_type() - Checks if current post type is 'post'
         * @uses has_category() - Verifies the post has assigned categories
         * @uses esc_html_e() - Escapes and translates the "Categories:" label
         * @uses esc_attr_e() - Escapes and translates the aria-label attribute
         * @uses get_the_category_list() - Retrieves formatted category links with comma separator
         * @uses wp_kses_post() - Sanitizes the category list HTML output
         *
         * Textdomain: 'LambrosPersonalTheme'
         */

        if ( get_post_type() === 'post' && has_category() ) : ?>
          <div class="entry-categories" itemprop="articleSection">
            <span class="categories-label"><?php esc_html_e( 'Categories:', 'LambrosPersonalTheme' ); ?></span>
            <?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?>
          </div>
        <?php endif; ?>

      </div> <!-- .header-info -->
    </header> <!-- .entry-header -->

  <!-- Content -->
    <?php
      /**
       * Displays the main content of a single post/page with article body markup.
       *
       * Renders the post content and pagination links for multi-page posts.
       * Uses Schema.org itemProp for semantic HTML and proper accessibility.
       *
       * @return void
       */
      ?>
      <div class="entry-content" itemprop="articleBody">
        <?php
          the_content();
          wp_link_pages( [
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'LambrosPersonalTheme' ),
            'after'  => '</div>',
          ] );
        ?>
      </div>

       <!-- Footer: Tags, Share, etc. -->
        <?php 
        /**
         * Displays the entry footer with tags for single post type content.
         *
         * Renders a footer section containing post tags if the current post type is 'post'
         * and the post has associated tags. The tags are displayed with a "Tags:" label
         * followed by a comma-separated list of tag links.
         *
         * @since 1.0.0
         *
         * @return void
         */
        if ( get_post_type() === 'post' ) : ?>
          <footer class="entry-footer">
            <?php if ( has_tag() ) : ?>
              <div class="entry-tags">
                <span class="tags-label"><?php esc_html_e( 'Tags:', 'LambrosPersonalTheme' ); ?></span>
                <?php the_tags( '', ', ', '' ); ?>
              </div>
            <?php endif; ?>
          </footer>
        <?php endif; ?>

        <?php
        /**
         * Hook: lambros_after_post_content
         */
        do_action( 'lambros_after_post_content' );
        ?>

  </article>
