<?php
  get_header();
?>
<main class='the_post'>
  <div class="container">
<?php
  while(have_posts()) {
   the_post(); ?>
    <div class="the-post_title">
      <h3 class="posts">
        <?php the_title(); ?>
        <small><?php echo get_the_date( 'l F j, Y' ); ?></small>
      </h3>
    </div>
      <div class="tags">
        <ul class="taglist-parent">
          <li class="taglist tag">
            <?php if ( get_post_type() == 'post') echo get_the_category_list(' / ') ?>
          </li>
        </ul>
      </div>
   <?php the_content(); ?>

</div>
</main>
<?php
  }
  get_footer();
