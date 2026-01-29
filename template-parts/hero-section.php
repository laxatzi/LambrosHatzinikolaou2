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
<?php
  // Pull the content of the current front page and print it here.
  // Works whether you're on a static front page or using a custom front-page template.
  // Fallback content is provided below if no content is found.
  // $front_id will be 0 if we're on a posts page or similar non-front-page context.
  // In that case, we check if the front page is set to a static page and use that ID.
  // This ensures we always get the correct front page content.
  // Note: This assumes this template part is only used on the front page.
  // If used elsewhere, additional checks may be needed.
$front_id = get_queried_object_id();

  if ( ! $front_id && get_option('show_on_front') === 'page' ) {
    $front_id = (int) get_option('page_on_front');
  }

  if ( $front_id ) {
    $content = get_post_field( 'post_content', $front_id );
    if ( $content ) {
      echo '<div class="hero__content">';
      // the_content filters add paragraph tags, shortcodes, embeds, etc.
      echo apply_filters( 'the_content', $content );
      echo '</div>';
    } else {
      // Fallback (what you had commented out, cleaned up + escaped)
      $custom_intro = get_theme_mod( 'lambros_hero_intro_text' );
      echo '<div class="hero__content">';
      echo $custom_intro ? wp_kses_post( $custom_intro ) : '<p>' . esc_html__( 'Welcome to my blog. I write about web development, my work, and life as a programmer.', 'LambrosPersonalTheme' ) . '</p>';
      echo '</div>';
      ?>
      <div class="hero__content">
        <p><?php echo esc_html__( "I'm a web developer in Thessaloniki, Greece. This is my tech blog where", 'LambrosPersonalTheme' ); ?>
          <a href="<?php echo esc_url( site_url( '/blog' ) ); ?>">
            <?php echo esc_html__( 'I write about web development', 'LambrosPersonalTheme' ); ?>
          </a>,
          <a href="#latest-projects" class="hop">
            <?php echo esc_html__( 'my work', 'LambrosPersonalTheme' ); ?>
          </a>,
          <?php echo esc_html__( 'and my life as a programmer.', 'LambrosPersonalTheme' ); ?>
        </p>
        <p>
          <a href="#latest-posts" class="hop">
            <?php echo esc_html__( 'I’ve written a few interesting posts recently.', 'LambrosPersonalTheme' ); ?>
          </a>
        </p>
        <p>
          <?php echo esc_html__( 'You can look over', 'LambrosPersonalTheme' ); ?>
          <a href="https://github.com/laxatzi" rel="me noopener" target="_blank">
            <?php echo esc_html__( 'my code on GitHub', 'LambrosPersonalTheme' ); ?>
          </a>.
        </p>
        <p><?php echo esc_html__( "If you want to talk about anything programming related, have recommendations, comments, want to work with me, meet up or just say hello—tweet me or send an email!", 'LambrosPersonalTheme' ); ?></p>
      </div>
      <?php
    }
  }
  ?>
 </section>
