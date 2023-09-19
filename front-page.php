<?php
  get_header();
  ?>
    <main>
        <div class="container">
          <section id="hero">
            <div class="intro-heading-section">
              <div class="intro-heading-image">
                <img
                  class="intro-heading-img"
                   src="<?php echo get_template_directory_uri(); ?>/images\aggelikoyla.jpg"
                  alt="Lambros Hatzinikolaou's cat profile"
                  title="Aggeliki is a web developer's cat!"
                />
              </div>
              <h1 class="intro-heading">Hi, I'm Lambros</h1>
            </div>
            <p>
              I'm a web developer in Thessaloniki, Greece. This is my tech blog
              where <a href="<?php echo site_url('/blog') ?>">I write about web development, web design, and my life as a
              programmer</a>.
            </p>
            <p>I've written <a href="#latest-posts" class="hop">a few interesting posts</a> recently.</p>
            <p>
              I try to implement what I've learned so building
              <a href="#latest-projects" class="hop">a lot of projects</a> is part of the
              process to enhance my learning.
            </p>
          </section>

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

