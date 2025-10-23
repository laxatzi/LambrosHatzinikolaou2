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
    <small>Developed by <span>Lambros Hatzinikolaou</span> &#169; <?php echo wp_kses_post(date('Y')) ?>.
    All rights reserved.</small>
  </div>
</footer>
<?php
  wp_footer();
?>
</body>
</html>
