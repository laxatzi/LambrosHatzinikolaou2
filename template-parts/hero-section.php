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

 </section>
