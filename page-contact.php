<?php
/**
 * Contact Page Template
 *
 * Displays the contact form and social media links for user communication.
 * Handles form submission feedback and validation messages.
 *
 * @package LambrosPersonalTheme
 * @since 1.0.0
 */
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
<!-- Show flash message on the page -->
    <?php if ( $m = get_transient('contact_msg') ) : delete_transient('contact_msg'); ?>
      <div class="notice notice-<?php echo esc_attr($m['type']); ?>" role="status" aria-live="polite">
        <?php echo esc_html( $m['text'] ); ?>
      </div>
    <?php endif; ?>

    <div class="contact grid">
      <div class="message">
        <h3><?php esc_html_e( 'Send a message', 'LambrosPersonalTheme' ); ?></h3>
            <?php
          // Your contact form partial (ensure it outputs a <form> with nonce & validation)
              get_template_part( 'template-parts/form-basic' );
            ?>
      </div>
       <div class="contact-info">
         <h3><?php esc_html_e( 'Other ways to get in touch', 'LambrosPersonalTheme' ); ?></h3>
           <address class="contact-info_box" translate="no">
               <ul class="contact-list">
                <li class="contact-item">
                  <ion-icon name="location" size="small" aria-hidden="true"></ion-icon>
                  <small style="font-weight: 200; font-size: 16px;">
                    <?php echo esc_html__( 'Mikras Asia 89, Thessaloniki, Greece, ZIP code: 55000', 'LambrosPersonalTheme' ); ?>
                  </small>
                </li>
                <li class="contact-item">
                  <ion-icon name="mail" size="small" aria-hidden="true"></ion-icon>
                  <a href="mailto:duck@gmail.com">
                    <span class="sr-only"><?php esc_html_e( 'Email: ', 'LambrosPersonalTheme' ); ?></span>duck@gmail.com
                  </a>
                </li>
                <li class="contact-item">
                  <ion-icon name="call" size="small" aria-hidden="true"></ion-icon>
                  <a href="tel:+302310XXXXXX" aria-label="<?php esc_attr_e( 'Phone: +30 2310 XXX XXX', 'LambrosPersonalTheme' ); ?>">
                    +30 2310 XXX XXX
                  </a>
                </li>
                <li class="contact-item">
                  <ion-icon name="logo-whatsapp" size="small" aria-hidden="true"></ion-icon>
                  <a aria-label="<?php esc_attr_e( 'Contact via WhatsApp', 'LambrosPersonalTheme' ); ?>"
                     href="<?php echo esc_url( 'https://wa.me/' . $whatsapp_number ); ?>"
                     target="_blank" rel="noopener noreferrer">
                    WhatsApp
                  </a>
                </li>
              </ul>
            </address>
            <nav class="social-link-contact">
              <?php
                get_template_part( 'template-parts/social-link-contact' );
              ?>
            </nav>
        </div>
     </div>
   </section>
   <div class="entry-content">
     <?php
        // Optional: let editors add more content below the contact blocks
        the_content();
      ?>
   </div>
</article>
  <?php endwhile; endif; ?>
</main>
<?php
  get_footer();
