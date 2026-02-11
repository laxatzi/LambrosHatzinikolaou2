  <article <?php post_class(); ?> itemscope itemtype="https://schema.org/Article" >
    <?php
        /**
         * Hook: lambros_before_post_content
         */
        do_action( "lambros_before_post_content" );
    ?>
  <!-- Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
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


        <!-- Author -->
            <?php if ( get_post_type() === "post" ) : ?>
              <span class="byline">
                <span class="author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
                  <?php esc_html_e( "Written by", "LambrosPersonalTheme" ); ?>
                  <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>" itemprop="url">
                    <span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
                  </a>
                </span>
              </span>
            <?php endif; ?>

          <!-- ⭐ Read time indicator -->
              <span class="read-time" itemprop="timeRequired">

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
        <?php if ( get_post_type() === "post" && has_category() ) : ?>
          <div class="entry-categories" itemprop="articleSection">
            <span class="categories-label"><?php esc_html_e( 'Categories:', 'LambrosPersonalTheme' ); ?></span>
            <?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?>
          </div>
        <?php endif; ?>

      </div> <!-- .header-info -->
    </header> <!-- .entry-header -->

  <!-- Content -->

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
        <?php if ( get_post_type() === 'post' ) : ?>
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
