<?php
  /**
 * Single Post Template
 *
 * @package LambrosPersonalTheme
 * @since 1.0.0
 */
  get_header();
?>
<main id="main-content" class="the-post-single" aria-labelledby="post-title-<?php the_ID(); ?>">
  <div class="container">
<?php
  while ( have_posts() ) : the_post();
  get_template_part( 'template-parts/content', 'single' );
  ?>

 <!-- Post Navigation  -->
  <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if ( $prev_post || $next_post ) : ?>
    <nav class="post-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'LambrosPersonalTheme' ); ?>">
    <?php if ( $prev_post ) : ?>
      <div class="nav-previous">
         <span class="nav-subtitle">
           <?php  esc_html_e( 'Previous Post', 'LambrosPersonalTheme' ); ?>
           <span aria-hidden="true">← </span>
         </span>
          <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" rel="prev">
            <span class="nav-title"><?php echo esc_html( get_the_title( $prev_post ) ); ?></span>
          </a>
      </div>
    <?php endif; ?>

    <?php if ( $next_post ) : ?>
      <div class="nav-next">
        <span class="nav-subtitle">
          <?php esc_html_e( 'Next Post', 'LambrosPersonalTheme' ); ?>
          <span aria-hidden="true"> →</span>
        </span>
        <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" rel="next">
          <span class="nav-title"><?php echo esc_html( get_the_title( $next_post ) ); ?></span>
        </a>
      </div>
    <?php endif; ?>

  </nav>
  <?php endif;


// If comments are open or there are comments, load the comment template
    if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;
  endwhile;
?>
</div> <!-- .container -->
</main>

<?php
  get_footer();


