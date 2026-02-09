<?php
  get_header();
?>
<main id="main-content" class='the_post' aria-labelledby="post-title-<?php the_ID(); ?>">
  <div class="container">
<?php
  while(have_posts()) {
   the_post(); ?>
<article <?php post_class(); ?> itemscope itemtype="https://schema.org/Article">
  <header class="entry-header">
      <h1 id="post-title-<?php the_ID(); ?>" class="posts" itemprop="headline">
        <?php the_title(); ?>
      </h1>
      <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" itemprop="datePublished">
        <?php echo esc_html( get_the_date() ); ?>
      </time>
        <?php if ( get_post_type() === 'post' ) : ?>
          <div class="tags">
            <ul class="taglist-parent">
              <li class="taglist tag">
                <?php echo wp_kses_post( get_the_category_list( ' / ' ) ); ?>
              </li>
            </ul>
          </div>
        <?php endif; ?>
   </header>
   <?php the_content(); ?>
</article>

</div>
</main>
<?php
  }
  get_footer();
