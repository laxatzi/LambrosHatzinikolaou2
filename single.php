<?php
/**
 * Single Post Template
 *
 * @package LambrosPersonalTheme
 * @since 1.0.0
 */
  get_header();
?>
<main id="main-content" class='the_post' aria-labelledby="post-title-<?php the_ID(); ?>">
  <div class="container">
<?php
while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Article">
  <?php
        /**
         * Hook: lambros_before_post_content
         */
        do_action( 'lambros_before_post_content' );
    ?>
  <!-- Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <?php
          the_post_thumbnail( 'large', [
            'itemprop' => 'url',
            'alt'      => get_the_title()
          ] );
        ?>
      </div>
    <?php endif; ?>
  <!-- Header -->
  <header class="entry-header"> 
      <h1 id="post-title-<?php the_ID(); ?>" class="entry-title" itemprop="headline">
        <?php the_title(); ?>
      </h1>
    
    <!-- Published Date -->
      <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" itemprop="datePublished">
        <?php echo esc_html( get_the_date() ); ?>
      </time>
    <!-- Modified date (hidden visually, important for SEO) -->
      <meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>">
   
    <!-- Author -->
      <?php if ( get_post_type() === 'post' ) : ?>
        <span class="byline">
          <span class="author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
            <?php esc_html_e( 'by', 'LambrosPersonalTheme' ); ?>
            <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemprop="url">
              <span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
            </a>
          </span>
        </span>
      <?php endif; ?>
  
  <!-- Categories -->
    <?php if ( get_post_type() === 'post' && has_category() ) : ?>
        <div class="entry-categories">
          <span class="categories-label"><?php esc_html_e( 'Categories:', 'LambrosPersonalTheme' ); ?></span>
          <?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?>
        </div>
    <?php endif; ?>
    <?php
      /**
       * Hook: lambros_after_post_content
       */
      do_action( 'lambros_after_post_content' );
     ?>
  
   </header> <!-- .entry-header -->

<!-- Content -->
<div class="entry-content" itemprop="articleBody">
  <?php the_content(); 
        wp_link_pages( [
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'LambrosPersonalTheme' ),
          'after'  => '</div>',
          ] );
  ?>
</div>
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
