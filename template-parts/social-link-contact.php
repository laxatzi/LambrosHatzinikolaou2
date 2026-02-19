<?php
// Fetch social URLs
$social_links = [
    'x'         => get_theme_mod( 'lambros_x_url' ),
    'linkedin'  => get_theme_mod( 'lambros_linkedin_url' ),
];

// Icon mapping (Ionicons)
$icons = [
    'x'         => 'logo-twitter',
    'linkedin'  => 'logo-linkedin',
];

// Display names (for accessibility) mapping
$display_names = [
    'x'         => 'X',
    'linkedin'  => 'LinkedIn',
];

?>

<ul class="footer-links social-links">
  <?php foreach ( $social_links as $network => $url ) : ?>
    <?php if ( $url ) : ?>
      <li>
        <a href="<?php echo esc_url( $url ); ?>"
           target="_blank"

           rel="noopener noreferrer">
          <ion-icon name="<?php echo esc_attr( isset( $icons[$network] ) ? $icons[$network] : '' ); ?>" aria-hidden="true"></ion-icon>
          <span><?php echo esc_html( isset( $display_names[ $network ] ) ? $display_names[ $network ] : '' ); ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>

