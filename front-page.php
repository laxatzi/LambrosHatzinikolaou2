<?php
  /**
   * Front Page Template
   *
   * Displays the site's homepage with hero section, newsletter signup,
   * latest blog posts, and featured projects.
   *
   * @package LambrosPersonalTheme
   * @since 1.0.0
   */
  get_header();
  ?>
    <main id="main-content">
    <div class="dot-bg-section-1"></div>
      <div class="container">
          <?php
            get_template_part('template-parts/hero-section');
            get_template_part('template-parts/newsletter');
          ?>
    <!-- latest posts -->
          <section id="latest-posts" class="home-section" aria-labelledby="latest-posts-title">
            <div class="blog-intro">
                  <h2 id="latest-posts-title"><?php esc_html_e( 'My latest posts', 'LambrosPersonalTheme' ); ?></h2>
                  <?php
                    $posts_page_id = (int) get_option('page_for_posts');
                    $blog_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');
                  ?>
                  <a href="<?php echo esc_url( $blog_url ); ?>" class="read_more">
                     <?php esc_html_e( 'View All', 'LambrosPersonalTheme' ); ?>
                  </a>
              </div>
            <?php
           $latestPosts = new WP_Query(array(
              'posts_per_page' => 2,
              'ignore_sticky_posts'    => true,
              'no_found_rows'          => true,
               'update_post_term_cache' => false,
               'update_post_meta_cache' => false,

            ));
          if($latestPosts -> have_posts()) :
              while($latestPosts -> have_posts()) :
                $latestPosts -> the_post();

                get_template_part('template-parts/blog-presentation');

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
          <section id="latest-projects" class="home-section" aria-labelledby="latest-projects-title">
            <div class="heading">
              <h2 id="latest-projects-title"><?php esc_html_e( 'My latest projects!', 'LambrosPersonalTheme' ); ?></h2>
              <?php
                $projects_url = get_post_type_archive_link( 'project' ) ?: home_url( '/projects/' );
              ?>
       <!-- Serious Bug 
              <a href="<?php echo site_url($projects_url); ?>" class="read_more">
              But $projects_url is already a full URL returned by:
              
              get_post_type_archive_link( 'project' )
              So site_url() wraps a URL inside another URL, producing something like:
              
              https://example.com/https://example.com/projects/
            // The actual code
              <a href="<?php echo site_url($projects_url);  ?>" class="read_more"><?php esc_html_e( 'View All', 'LambrosPersonalTheme' ); ?></a>
              -->
              <a href="<?php echo esc_url( $projects_url ); ?>" class="read_more" aria-label="<?php esc_attr_e( 'View all projects', 'LambrosPersonalTheme' ); ?>">
                <?php esc_html_e( 'View All', 'LambrosPersonalTheme' ); ?>
              </a>
            </div>
            <?php
            $latestProjects = new WP_Query(array(
              'posts_per_page' => 2,
              'post_type' => 'project',
              'no_found_rows'          => true,
              'update_post_term_cache' => false,
              'update_post_meta_cache' => false,
            ));
            if ( $latestProjects->have_posts() ) :
              while($latestProjects -> have_posts()) :
                $latestProjects -> the_post();

                get_template_part('template-parts/project-presentation');
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


