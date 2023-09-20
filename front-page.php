<?php
  get_header();
  ?>
    <main>
        <div class="container">
          <?php
            get_template_part('template-parts/hero-section');
          ?>

          <section id="newsletter">
            <h2>My Weekly Newsletter about Frontend</h2>
            <small
              >Subscribe to my newsletter to get useful tips and the week's
              selection of articles about frontend technologies every
              Tuesday.</small
            >
            <form action="">
              <input type="email" placeholder="Email" name="email" autocomplete="email"/>
              <input type="submit" value="Subscribe" />
            </form>
          </section>

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
?>

