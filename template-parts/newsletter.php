<section id="newsletter">
  <h2><?php echo esc_html__( 'My Monthly Newsletter about Web Development', 'LambrosPersonalTheme' ); ?></h2>
    <small><?php echo esc_html__( 'Subscribe to my newsletter to get useful tips and a selection of articles about web technologies on the first Monday of every month.', 'LambrosPersonalTheme' ); ?>
    </small>
    <form action="" method="post" aria-label="Newsletter subscription form">
      <input type="email" placeholder="<?php echo esc_attr__( 'Email', 'LambrosPersonalTheme' ); ?>" name="email" autocomplete="email" required/>
      <label for="newsletter-email" class="screen-reader-text">
        Email address
      </label>
      
      <input type="submit" value="<?php echo esc_attr__( 'Subscribe', 'LambrosPersonalTheme' ); ?>" />
    </form>
</section>
