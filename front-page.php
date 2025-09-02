<?php
  get_header();
  ?>
    <main>
        <div class="container">
          <?php
            get_template_part('template-parts/hero-section');
            get_template_part('template-parts/newsletter');
          ?>
    <!-- latest posts -->
          <section id="latest-posts">
              <div class="blog-intro">
                <h2>My latest posts</h2>
                <a href="<?php echo site_url('/blog');  ?>" class="read_more">View All</a>
              </div>
            <?php
            $latestPosts = new WP_Query(array(
              'posts_per_page' => 2,
            ));
              while($latestPosts -> have_posts()) {
                $latestPosts -> the_post();

                get_template_part('template-parts/blog-presentation');
              }
              wp_reset_postdata();
            ?>
         </section>

    <!-- latest projects -->
          <section id="latest-projects">
            <div class="heading">
              <h2>My latest projects</h2>
              <a href="<?php echo site_url('/projects');  ?>" class="read_more">View All</a>
            </div>
            <?php
            $latestProjects = new WP_Query(array(
              'posts_per_page' => 2,
              'post_type' => 'project',
            ));
              while($latestProjects -> have_posts()) {
                $latestProjects -> the_post();

                get_template_part('template-parts/project-presentation');
              }
              wp_reset_postdata();
            ?>
          </section>
        </div>
      </main>
  <?php
  get_footer();


