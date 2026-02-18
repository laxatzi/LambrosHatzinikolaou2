<?php
// Fetch social URLs
$social_links = [
    'x'   => get_theme_mod( 'lambros_x_url' ),
    'linkedin'  => get_theme_mod( 'lambros_linkedin_url' ),
    'github'    => get_theme_mod( 'lambros_github_url' ),
    'youtube'   => get_theme_mod( 'lambros_youtube_url' ),
    'instagram' => get_theme_mod( 'lambros_instagram_url' ),
];

// Icon mapping (Ionicons)
$icons = [
    'x'   => 'logo-twitter',
    'linkedin'  => 'logo-linkedin',
    'github'    => 'logo-github',
    'youtube'   => 'logo-youtube',
    'instagram' => 'logo-instagram',
];

// Display names (for accessibility) mapping
$display_names = [
    'x'   => 'X',
    'linkedin'  => 'LinkedIn',
    'github'    => 'GitHub',
    'youtube'   => 'YouTube',
    'instagram' => 'Instagram',
];

?>

<?php

if ( ! empty( $social_links ) ) : ?>
<ul class="footer-links social-links">
  <?php foreach ( $social_links as $network => $url ) : ?>
    <?php if ( $url ) : ?>
      <li>
        <a href="<?php echo esc_url( $url ); ?>"
           target="_blank"
            class="social-link social-link-<?php echo esc_attr( $network ); ?>"
            aria-label="<?php echo esc_attr( isset( $display_names[ $network ] ) ? $display_names[ $network ] : ucfirst( $network ) ); ?>"
            rel="noopener noreferrer">
           <ion-icon name="<?php echo esc_attr( $icons[ $network ] ); ?>" aria-hidden="true"></ion-icon>
           <span><?php echo esc_html( $display_names[ $network ] ); ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
    

