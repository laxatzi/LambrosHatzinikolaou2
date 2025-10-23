<?php
  // Configure your social URLs here (or move to Customizer later)
  $twitter  = 'https://twitter.com/yourhandle';
  $linkedin = 'https://www.linkedin.com/in/yourhandle/';
  $github   = 'https://github.com/yourhandle';
?>
<ul class="footer-links">
  <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="me noopener noreferrer">Twitter</a></li>
  <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="me noopener noreferrer">LinkedIn</a></li>
  <li><a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="me noopener noreferrer">GitHub</a></li>
  <li>
    <a
      <?php if ( is_page( 'privacy-policy' ) ) echo 'class="indicator"'; ?>
      href="<?php echo esc_url( site_url( '/privacy-policy' ) ); ?>">
      <?php esc_html_e( 'Privacy', 'LambrosPersonalTheme' ); ?>
    </a>
  </li>
  <li>
    <a
      <?php if ( is_page( 'terms-of-service' ) ) echo 'class="indicator"'; ?>
      href="<?php echo esc_url( site_url( '/terms-of-service' ) ); ?>">
      <?php esc_html_e( 'Terms', 'LambrosPersonalTheme' ); ?>
    </a>
  </li>
</ul>

