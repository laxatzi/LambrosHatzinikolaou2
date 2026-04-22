<?php
  get_header();
  ?>
    <main id="main-content" class="layout__main layout__content" aria-labelledby="home-title">
    <div class="dot-bg-section-1"></div>
      <div class="container">
          <?php
            get_template_part( 'template-parts/hero-section' );
            get_template_part( 'template-parts/newsletter' );
          ?>
    <!-- latest posts -->
          <section id="latest-posts" class="home-section section" aria-labelledby="latest-posts-title">
            <div class="blog__intro">
                  <h2 id="latest-posts-title"><?php esc_html_e( 'My latest posts', 'LambrosPersonalTheme' ); ?></h2>
                  <?php
                    $posts_page_id = (int) get_option( 'page_for_posts' );
                    $blog_url = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );
                  ?>
                  <a href="<?php echo esc_url( $blog_url ); ?>" class="read_more">
                     <?php esc_html_e( 'View All', 'LambrosPersonalTheme' ); ?>
                  </a>
              </div>

          <?php
            /**
             * Retrieve and display the latest blog posts on the front page.
             *
             * Queries for the 2 most recent posts, excluding sticky posts, with optimized
             * performance by disabling term and meta cache updates. Each post is rendered
             * using the 'blog-presentation' template part. If no posts are found, displays
             * a localized message.
             *
             * @global WP_Query $latestPosts The query object containing the latest posts.
             *
             * @return void
             */
           $latestPosts = new WP_Query(array(
              'posts_per_page' => 2,
              'ignore_sticky_posts'    => true,
              'no_found_rows'          => true,
               'update_post_term_cache' => false,
               'update_post_meta_cache' => false,

            ));
          if( $latestPosts -> have_posts() ) :
              while( $latestPosts -> have_posts() ) :
                $latestPosts -> the_post();

                get_template_part( 'template-parts/blog-presentation' );

              endwhile;
          else :
          ?>
            <p><?php esc_html_e( 'No posts found.', 'LambrosPersonalTheme' ); ?></p>
          <?php
          endif;
          wp_reset_postdata();
            ?>
         </section>

    <!-- latest projects -->
          <section id="latest-projects" class="home-section section" aria-labelledby="latest-projects-title">
            <div class="heading">
              <h2 id="latest-projects-title"><?php esc_html_e( 'My latest projects!', 'LambrosPersonalTheme' ); ?></h2>
              <?php
                $projects_url = get_post_type_archive_link( 'project' ) ?: home_url( '/projects/' );
                ?>
               <a href="<?php echo esc_url( $projects_url ); ?>" class="latest-projects__title-link read_more" aria-label="<?php esc_attr_e( 'View all projects', 'LambrosPersonalTheme' ); ?>"
                class="read_more" aria-label="<?php esc_attr_e( 'View all projects', 'LambrosPersonalTheme' ); ?>"
               >
                <?php esc_html_e( 'View All', 'LambrosPersonalTheme' ); ?>
              </a>

            </div>
            
            <?php
            /**
             * Retrieves and displays the latest 2 projects.
             *
             * Queries for the 2 most recent 'project' custom post type entries
             * with optimized performance settings to avoid unnecessary cache updates.
             * Each project is rendered using the 'project-presentation' template part.
             *
             * @global WP_Query $latestProjects The query object containing project posts.
             *
             * @return void
             */
            $latestProjects = new WP_Query( array(
              'posts_per_page' => 2,
              'post_type' => 'project',
              'no_found_rows'          => true,
              'update_post_term_cache' => false,
              'update_post_meta_cache' => false,
            ) );
            if ( $latestProjects->have_posts() ) :
              while( $latestProjects -> have_posts() ) :
                $latestProjects -> the_post();

                get_template_part( 'template-parts/project-presentation' );
              endwhile;
              endif;
              wp_reset_postdata();
            ?>
          </section>
        </div>
       <div class="dot-bg-section-2"></div>
      </main>
  <?php
  get_footer();


