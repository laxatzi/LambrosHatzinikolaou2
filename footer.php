<?php
/**
 * Theme footer
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo">
  <div id="sig" class="container">
    <nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'LambrosPersonalTheme' ); ?>">
      <?php
            get_template_part('template-parts/menu-footer');
        ?>
    </nav>
    <small class="site-credit">
      <?php
      /* translators: 1: Developer/brand name, 2: year */
      printf(
            esc_html__( 'Developed by %1$s © 2024 - %2$s. All rights reserved.', 'LambrosPersonalTheme' ),
            '<span>' . esc_html( 'Lambros Hatzinikolaou' ) . '</span>',
            esc_html( wp_date( 'Y' ) )
           );
      ?>
    </small>
  </div>
</footer>
<?php
  wp_footer();
?>
</body>
</html>
