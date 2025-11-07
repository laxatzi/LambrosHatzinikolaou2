<?php
  // Safer asset URL helper (child-theme friendly)
$img_src = get_theme_file_uri('images/aggelikoyla.jpg');
?>
<section id="hero">
  <div class="intro-heading-section">
    <div class="intro-heading-image">
      <img
        class="intro-heading-img"
        src="<?php echo esc_url( $img_src ); ?>"        
       alt="<?php esc_attr_e('Portrait of Aggelikoyla', 'LambrosPersonalTheme'); ?>"
        title="<?php esc_attr_e('Aggeliki is a web developer\'s cat!', 'LambrosPersonalTheme'); ?>"
        loading="lazy"
        decoding="async"
      />
    </div>
      <h1 class="intro-heading">
        <?php echo esc_html__( "Hi, I'm Lambros", 'LambrosPersonalTheme' ); ?>
      </h1>
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
