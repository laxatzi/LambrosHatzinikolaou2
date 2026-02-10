<?php
  get_header();
?>
<main id="main-content" class='the_post' aria-labelledby="post-title-<?php the_ID(); ?>">
  <div class="container">
<?php
while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?> itemscope itemtype="https://schema.org/Article">
  <header class="entry-header"> 
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <?php
          the_post_thumbnail( 'large', [
            'itemprop' => 'url',
            'alt'      => get_the_title()
          ] );
        ?>
        <meta itemprop="width" content="<?php echo esc_attr( get_post_thumbnail_id() ? wp_get_attachment_metadata( get_post_thumbnail_id() )['width'] : '' ); ?>">
        <meta itemprop="height" content="<?php echo esc_attr( get_post_thumbnail_id() ? wp_get_attachment_metadata( get_post_thumbnail_id() )['height'] : '' ); ?>">
       </div>
    <?php endif; ?>
      <h1 id="post-title-<?php the_ID(); ?>" class="entry-title" itemprop="headline">
        <?php the_title(); ?>
      </h1>
      <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" itemprop="datePublished">
        <?php echo esc_html( get_the_date() ); ?>
      </time>
    <!-- Modified date (hidden visually, important for SEO) -->
      <meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>">
    <!-- Author -->
      <span class="author" itemprop="author" itemscope itemtype="https://schema.org/Person">
        <span itemprop="name"><?php the_author(); ?></span>
      </span>
      <?php if ( get_post_type() === 'post' && has_category() ) : ?>
        <div class="entry-categories">
          <span class="categories-label"><?php esc_html_e( 'Categories:', 'LambrosPersonalTheme' ); ?></span>
          <?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?>
        </div>
      <?php endif; ?>
   </header>
   <?php the_content(); ?>
</article>
<!-- Navigation  section -->
<?php
  $prev_post = get_previous_post();
  $next_post = get_next_post();
?>
<?php if ( $prev_post || $next_post ) : ?>
  <nav class="post-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'LambrosPersonalTheme' ); ?>">

    <?php if ( $prev_post ) : ?>
      <div class="nav-previous">
        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
          <?php
            printf(
              esc_html__( 'Previous post: %s', 'LambrosPersonalTheme' ),
              esc_html( get_the_title( $prev_post->ID ) )
            );
          ?>
        </a>
      </div>
    <?php endif; ?>

    <?php if ( $next_post ) : ?>
      <div class="nav-next">
        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
          <?php
            printf(
              esc_html__( 'Next post: %s', 'LambrosPersonalTheme' ),
              esc_html( get_the_title( $next_post->ID ) )
            );
          ?>
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
</div>
</main>
<?php
  }
  get_footer();
