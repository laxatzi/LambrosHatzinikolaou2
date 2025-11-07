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
 </section>
