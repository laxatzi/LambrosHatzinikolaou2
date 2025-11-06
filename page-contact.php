<?php
  get_header();
?>
<main id="main-content" class="site-main" aria-labelledby="page-title-<?php the_ID(); ?>">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('page-contact'); ?>>
    <header class="entry-header">
      <h1 id="page-title-<?php the_ID(); ?>" class="entry-title"><?php the_title(); ?></h1>
      <?php
        // Optional: intro text editable in the page body (block editor)
        if ( has_excerpt() ) {
          echo '<div class="page-intro">' . wp_kses_post( wpautop( get_the_excerpt() ) ) . '</div>';
        }
      ?>
    </header>
 <section id="contactme" class="contact-section">
   <h2><?php esc_html_e( "Why don't you reach out?", 'LambrosPersonalTheme' ); ?></h2>
    <div class="contact grid">
      <div class="message">
        <h3><?php esc_html_e( 'Send a message', 'LambrosPersonalTheme' ); ?></h3>
            <?php
              get_template_part( 'template-parts/form-basic' );
            ?>
     </div>
       <div class="contact-info">
         <h3><?php esc_html_e( 'Or get in touch another way', 'LambrosPersonalTheme' ); ?></h3>
           <address class="contact-info_box" translate="no">
              <p>
                <ion-icon name="location" size="large" aria-hidden="true"></ion-icon>
                <?php esc_html_e( 'Mikras Asia 89, Thessaloniki, Greece', 'LambrosPersonalTheme' ); ?>
              </p>
              <p>
                <ion-icon name="home" size="large" aria-hidden="true"></ion-icon>
                <?php esc_html_e( 'ZIP code: 55000', 'LambrosPersonalTheme' ); ?>
              </p>
              <p>
                <ion-icon name="mail" size="large" aria-hidden="true"></ion-icon>
                <a href="mailto:duck@gmail.com">duck@gmail.com</a>
              </p>
              <p>
                <ion-icon name="call" size="large" aria-hidden="true"></ion-icon>
                <a href="tel:+302310XXXXXX">+30 2310 XXX XXX</a>
              </p>
              <p>
                <ion-icon name="logo-whatsapp" size="large" aria-hidden="true"></ion-icon>
                <a href="https://wa.me/306948XXXXXX" target="_blank" rel="noopener noreferrer">WhatsApp</a>
              </p>

              <p class="social-links">
                <a href="<?php echo esc_url( 'https://www.linkedin.com/in/your-handle' ); ?>"
                   target="_blank" rel="noopener noreferrer">
                  <ion-icon class="social-icon" name="logo-linkedin" size="large" aria-hidden="true"></ion-icon>
                  <span class="sr-only"><?php esc_html_e( 'LinkedIn', 'LambrosPersonalTheme' ); ?></span>
                </a>

                <a href="<?php echo esc_url( 'https://x.com/your-handle' ); ?>"
                   target="_blank" rel="noopener noreferrer">
                  <ion-icon class="social-icon" name="logo-twitter" size="large" aria-hidden="true"></ion-icon>
                  <span class="sr-only"><?php esc_html_e( 'X (Twitter)', 'LambrosPersonalTheme' ); ?></span>
                </a>
              </p>
            </address>
          </div>
     </div>
  </section>
  </article>
  <?php endwhile; endif; ?>
</main>
<?php
  get_footer();
