<?php
/**
 * Theme footer
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter" aria-labelledby="footer-title">
  <h2 id="footer-title" class="screen-reader-text">Footer</h2>
  <div id="sig" class="container">
    <div class="footer-menu-wrapper">
      <nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'LambrosPersonalTheme' ); ?>">
      <?php
            get_template_part( 'template-parts/menu-footer' );
        ?>
      </nav>
    </div>
    <small class="site-credit">
      <?php
      /* translators: 1: Developer/brand name, 2: year */
      printf(
            esc_html__( 'Developed by %1$s © 2024 - %2$s. All rights reserved.', 'LambrosPersonalTheme' ),
            '<span>' . esc_html( LAMBROS_THEME_AUTHOR ) . '</span>',
            esc_html( wp_date( 'Y' ) )
           );
      ?>
    </small>
  </div>
</footer>
<?php
// Place overlay markup before wp_footer so plugins can still hook very last.
get_template_part( 'template-parts/search-overlay' );

// Must be the last thing before </body>.
wp_footer();
?>
</body>
</html>

