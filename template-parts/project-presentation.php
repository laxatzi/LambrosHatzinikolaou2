<article class="the-project the-post fade-up">
  <?php
    /**
     * Hook: lambros_before_post_content
     */
    do_action( "lambros_before_post_content" );
  ?>

<div class="entry-content" itemprop="articleBody">
  <?php
    /**
     * Displays the project title and date in a header section.
     *
     * Renders the project title as a link to the single project page and
     * displays the publication date formatted according to the theme's date format.
     * The title is wrapped in an h3 element for semantic structure, and the date is
     * displayed in a small element for visual distinction.
     *
     * @return void Outputs HTML directly to the page
     */
  ?>
  <div class="project__title-wrapper">
    <h3 class="project__title flex-column">
      <a href="<?php echo esc_url( get_permalink() ); ?>" class="project__title-link">
       <?php the_title(); ?>
      </a>
    </h3>
    <small class="project__date">
      <?php echo get_the_date( LAMBROS_DATE_FORMAT ) ); ?>
    </small>
  </div>
  
 <p class="project__desc">
<!-- Use the_excerpt() instead of get_the_excerpt() ? -->
  <?php
    if ( has_excerpt() ) { 
      the_excerpt(); 
    } else { 
      echo esc_html( wp_trim_words( get_the_content(), 26 ) ); 
    }
   ?>
  </p>
  
  <div class="buttons">
    <a href="<?php echo esc_url( get_permalink() ); ?>" class="button__link"> <?php echo esc_html__( 'Project article', 'LambrosPersonalTheme' ); ?> </a>
    <a href="https://github.com/laxatzi/LambrosHatzinikolaou2.git" class="button__link"> <?php echo esc_html__( 'Source code', 'LambrosPersonalTheme' ); ?> </a>
  </div>
</article>
