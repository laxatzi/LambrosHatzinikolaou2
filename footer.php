<footer>
  <menu>
    <a href="#twitter">Twitter</a> .
    <a href="#linkedin">Linkedin</a> .
    <a href="#youtube">YouTube</a> .
     <a href="#youtube">Privacy</a> .
      <a href="#youtube">Terms</a>
  </menu>
    <div id="sig">
    <small>Developed by <span>Lambros Hatzinikolaou</span> &#169; <?php echo wp_kses_post(date('Y')) ?>.
    All rights reserved.</small>
   </div>
</footer>
<?php
  get_template_part('template-parts/search-overlay');

  wp_footer();
?>
</body>
</html>