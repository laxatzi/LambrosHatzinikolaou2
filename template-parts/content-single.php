  <article <?php post_class(); ?> itemscope itemtype="https://schema.org/Article" class="the-post fade-up">
    <?php
        /**
         * Hook: lambros_before_post_content
         */
        do_action( 'lambros_before_post_content' );
    ?>

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
      <div class="post-thumbnail post__thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
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
          <div class="header-metadata--row">
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

        if ( get_post_type() === "post" && has_category() ) : ?>
          <div class="entry-categories" itemprop="articleSection">

            <span class="categories-label entry-categories__label"></span>
            <nav class="entry-categories-nav entry-categories__nav" aria-label="<?php esc_attr_e( 'Post categories', 'LambrosPersonalTheme' ); ?>">
              <?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?>
            </nav>
          </div>
        <?php endif; ?>

      </div> <!-- .header-info -->
    </header> <!-- .entry-header -->

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
          <footer class="entry-footer site-footer">
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
