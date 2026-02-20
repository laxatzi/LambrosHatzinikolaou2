<?php
 get_header();
?>
<main id="main-content">
<div class="dot-bg-section-1"></div>
  <div class="container">
    <section id="posts" aria-labelledby="posts-title">
      <h1 id="posts-title" class="screen-reader-text">
        <?php esc_html_e( 'Posts', 'LambrosPersonalTheme' ); ?>
      </h1>
      <?php 
      /**
       * Post article container with schema.org markup
       *
       * Displays a single post within the WordPress loop with semantic HTML5
       * article element and structured data markup for search engines.
       *
       * @uses have_posts() - Check if there are posts in the loop
       * @uses the_post() - Iterate to the next post in the loop
       * @uses the_ID() - Retrieve the current post ID
       * @uses post_class() - Generate HTML classes for the post element
       *
       * Variables:
       * - Applies 'the-post' and 'fade-up' CSS classes
       * - Uses BlogPosting schema.org type for SEO
       * - Post ID is dynamically inserted as element ID
       */
      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <article id="post-<?php the_ID(); ?>" <?php post_class( 'the-post' ); ?> itemscope itemtype="https://schema.org/BlogPosting" class="the-post fade-up">
           <header class="the-post_title">
             <h2 class="posts">
               <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                 <?php the_title(); ?>
               </a>
               <small class="project-date" style="margin-top: 10px;">
                 <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
                   itemprop="datePublished">
                 <?php echo get_the_date( get_option( 'l F j, Y' ) ); ?>
            <!-- ⭐ Read time indicator -->
                 <span class="read-time" itemprop="timeRequired"> 
                 <svg class="read-time-icon" width="14" height="14" viewBox="0 0 24 24" aria-hidden="true"> 
                   <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/> 
                   <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/> 
                 </svg>
                 
                <?php
                /**
                 * Displays the estimated reading time for a post.
                 *
                 * Retrieves the reading time in minutes and outputs a localized,
                 * properly pluralized string indicating the estimated read duration.
                 * Uses WordPress translation functions to support multiple languages.
                 *
                 * @since 1.0.0
                 *
                 * @return void Outputs the reading time directly to the page.
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
            </h2>
          </header>

          <?php
          /**
           * Display category tags for the current post
           *
           * Retrieves all categories associated with the current post and displays them
           * as a list of clickable tag links. Each category link is properly escaped for
           * security and directs to the category archive page.
           *
           * @since 1.0.0
           * @return void Outputs HTML markup if categories exist
           */
            $categories = get_the_category_list( ' / ' ); // already escaped HTML list
            if ( $categories ) :
          ?>
            <div class="tags">
              <ul class="taglist-parent">
                <?php
                  $cats = get_the_category(); foreach ( $cats as $cat ) { 
                    echo '<li class="taglist tag">
                            <a href="' . esc_url( get_category_link( $cat ) ) . '">' 
                             . esc_html( $cat->name ) .
                            '</a>
                          </li>'; 
                  }
                ?>
              </ul>
            </div>
          <?php endif; ?>

          <div class="entry-summary">
          <?php
          /**
             * Display post excerpt or trimmed content
             *
             * Outputs the post excerpt if available, otherwise displays a trimmed version
             * of the post content with HTML tags removed and limited to a specified word count.
             *
             * Output:
             * - If excerpt exists: Displays the excerpt with WordPress formatting and allowed HTML tags
             * - If no excerpt: Displays the first 26 words of post content with ellipsis
             *
             * @uses get_the_excerpt() To retrieve the post excerpt
             * @uses wp_kses_post() To safely output post content with allowed HTML
             * @uses wpautop() To convert line breaks to paragraph tags
             * @uses wp_trim_words() To limit content to specified word count
             * @uses wp_strip_all_tags() To remove all HTML tags from content
             * @uses get_the_content() To retrieve the full post content
             */
              $excerpt        = get_the_excerpt();
              $excerpt_length = 26;
              if ( $excerpt ) {
                echo wp_kses_post( wpautop( $excerpt ) );
              } else {
                echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_content() ), $excerpt_length, '…' ) );
              }
            ?>
          </div>

          <p>
            <a class="read_more" href="<?php echo esc_url( get_permalink() ); ?>">
              <?php esc_html_e( 'Read more', 'LambrosPersonalTheme' ); ?>
            </a>
          </p>

        </article>
     <?php
       endwhile; else : ?>
       <p><?php esc_html_e( 'No posts found.', 'LambrosPersonalTheme' ); ?></p>

     <?php endif; ?>

     <?php
      /**
       * Display accessible pagination for posts with screen reader support.
       *
       * Renders a pagination navigation element for post archives with proper ARIA labels
       * and screen reader text to ensure accessibility compliance. Includes previous/next
       * links with hidden text for assistive technologies and visible text for sighted users.
       *
       * @uses the_posts_pagination() WordPress template tag
       *
       * Configuration:
       * - mid_size: Number of page links to show on each side of current page (set to 1)
       * - prev_text: HTML for previous page link with screen reader and visible text
       * - next_text: HTML for next page link with screen reader and visible text
       * - screen_reader_text: Label announced to screen readers for the navigation
       * - aria_label: ARIA label identifying the navigation as "Posts"
       * - class: CSS class "posts-pagination" applied to the <nav> element
       *
       * @return void
       */
        the_posts_pagination( [
          'mid_size'           => 1,
          'prev_text'          => '<span class="screen-reader-text">'.esc_html__( 'Previous','LambrosPersonalTheme' ).'</span><span aria-hidden="true">Previous</span>',
          'next_text'          => '<span class="screen-reader-text">'.esc_html__( 'Next','LambrosPersonalTheme' ).'</span><span aria-hidden="true">Next</span>',
          'screen_reader_text' => esc_html__( 'Posts navigation','LambrosPersonalTheme' ),
          'aria_label'         => esc_html__( 'Posts','LambrosPersonalTheme' ),
          'class'              => 'posts-pagination', // adds this to the <nav>
        ] );

    ?>
 </section>
</div>
<div class="dot-bg-section-2"></div>
</main>
<?php
  get_footer();
