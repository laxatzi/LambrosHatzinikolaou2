<section id="newsletter">
  <h2><?php echo esc_html__( 'My Monthly Newsletter about Web Development', 'LambrosPersonalTheme' ); ?></h2>
    <small>Subscribe to my newsletter to get useful tips and a
              selection of articles about web technologies on the first
              Monday of every month.
    </small>
    <form action="" method="post">
      <input type="email" placeholder="Email" name="email" autocomplete="email" required/>
      <label for="newsletter-email" class="screen-reader-text">
        Email address
      </label>
      <input type="submit" value="Subscribe" />
    </form>
</section>
