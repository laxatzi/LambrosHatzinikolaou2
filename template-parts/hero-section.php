<?php
  // Safer asset URL helper (child-theme friendly)
$img_src = get_theme_file_uri( 'images/aggelikoyla.jpg' );
?>
<section id="hero" class="section" aria-labelledby="intro-heading">

  <div class="intro-heading__section">
    <div class="intro-heading__image-wrapper">
      <img
        class="intro-heading__image"
        src="<?php echo esc_url( $img_src ); ?>"
        alt="<?php esc_attr_e( 'Portrait of Aggelikoyla', 'LambrosPersonalTheme' ); ?>"
        title="<?php esc_attr_e( 'Aggeliki is a web developer\'s cat!', 'LambrosPersonalTheme' ); ?>"
        decoding="async"
      />
    </div>

    <h1 class="intro-heading">
      <?php echo esc_html__( "Hi, I'm Lambros", 'LambrosPersonalTheme' ); ?>
    </h1>
  </div>
  
<?php

//Determine the correct front-page ID
$front_id = get_queried_object_id();

  if ( ! $front_id && get_option( 'show_on_front' ) === 'page' ) {
    $front_id = (int) get_option( 'page_on_front' );
  }

// Fetch Customizer intro text
$custom_intro = trim( get_theme_mod( 'lambros_hero_intro_text', '' ) );
// Get front page content ONLY if static front page is set
$content = '';
if ( get_option( 'show_on_front' ) === 'page' ) {
  $front_id = (int) get_option( 'page_on_front' );
  if ( $front_id ) {
    $raw = get_post_field( 'post_content', $front_id );
    $content = trim( wp_strip_all_tags( $raw ) ); // strip HTML + whitespace
    }
  }
  echo '<div class="hero__content">';

  if ( $content ) {
    // Use the page content
    echo apply_filters( 'the_content', $raw );

  }  else {
    // Fallback content (always shows if nothing else exists)
    ?>
      <p>
        <?php echo esc_html__( 'I\'m a web developer in Thessaloniki, Greece. This is my tech blog where', 'LambrosPersonalTheme' ); ?>
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
          <?php echo esc_html__( 'I\'ve written a few interesting posts recently.', 'LambrosPersonalTheme' ); ?>
        </a>
      </p>

      <p>
        <?php echo esc_html__( 'You can look over', 'LambrosPersonalTheme' ); ?>
        <a href="https://github.com/laxatzi" rel="me noopener" target="_blank">
          <?php echo esc_html__( 'my code on GitHub', 'LambrosPersonalTheme' ); ?>
        </a>.
      </p>

      <p>
        <?php echo esc_html__( 'If you want to talk about anything programming related, have recommendations, comments, want to work with me, meet up or just say hello—tweet me or send an email!', 'LambrosPersonalTheme' ); ?>
      </p>
    <?php
  }

  echo '</div>';
    

  // CTA button (Customizer)
  $cta_url   = get_theme_mod( 'lambros_hero_cta_url', site_url( '/contact' ) );
  $cta_label = get_theme_mod( 'lambros_hero_cta_label', __( 'Let\'s Work Together', 'LambrosPersonalTheme' ) );

?>

  <div class="hero__cta">
    <a href="<?php echo esc_url( $cta_url ); ?>" class="button primary-button">
      <?php echo esc_html( $cta_label ); ?>
    </a>
  </div>

</section>

