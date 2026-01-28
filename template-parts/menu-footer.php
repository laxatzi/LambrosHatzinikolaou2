<?php
  get_template_part( 'template-parts/social-links' );
?>

<ul class="footer-links legal-links">
  <li>
    <a <?php if ( is_page( 'privacy-policy' ) ) echo 'class="indicator" aria-current="page"'; ?>
      href="<?php echo esc_url( site_url( '/privacy-policy' ) ); ?>">
      <?php esc_html_e( 'Privacy', 'LambrosPersonalTheme' ); ?>
    </a>
  </li>
  <li>
    <a <?php if ( is_page( 'terms-of-service' ) ) echo 'class="indicator" aria-current="page"'; ?>
      href="<?php echo esc_url( site_url( '/terms-of-service' ) ); ?>">
      <?php esc_html_e( 'Terms', 'LambrosPersonalTheme' ); ?>
    </a>
  </li>
</ul>


