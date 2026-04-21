<?php
  get_template_part( 'template-parts/social-links' );
?>

<ul class="site-footer__links legal-links nav__list">
  
    <li class="site-footer__nav-item">
    <a <?php if ( is_page( 'privacy-policy' ) ) echo 'class="site-footer__indicator site-footer__link" aria-current="page"'; ?>
      href="<?php echo esc_url( site_url( '/privacy-policy' ) ); ?>">
      <?php esc_html_e( 'Privacy', 'LambrosPersonalTheme' ); ?>
    </a>
  </li>
  
    <li class="site-footer__nav-item">
    <a <?php if ( is_page( 'terms-of-service' ) ) echo 'class="site-footer__indicator site-footer__link" aria-current="page"'; ?>
      href="<?php echo esc_url( site_url( '/terms-of-service' ) ); ?>">
      <?php esc_html_e( 'Terms', 'LambrosPersonalTheme' ); ?>
    </a>
  </li>
  
</ul>


