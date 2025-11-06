<?php
// Pre-fill values when redisplaying after a failed submit
$posted = wp_unslash( $_POST ?? [] );
$name   = isset($posted['name'])   ? sanitize_text_field($posted['name'])   : '';
$email  = isset($posted['email'])  ? sanitize_email($posted['email'])       : '';
$subj   = isset($posted['subject'])? sanitize_text_field($posted['subject']): '';
$msg    = isset($posted['message'])? wp_kses_post($posted['message'])       : '';
?>
 <form
  class="contact-form"
  name="contact_form"
  method="post"
  action="<?php echo esc_url( get_permalink() ); ?>"
  autocomplete="on"
  enctype="multipart/form-data"
  novalidate
>
<?php wp_nonce_field( 'contact_form_submit', 'contact_nonce' ); ?>
 <!-- Honeypot: should stay empty -->
  <div class="honeypot" aria-hidden="true">
    <label for="website"><?php esc_html_e('Leave this field empty', 'LambrosPersonalTheme'); ?></label>
    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
  </div>
  
  <div class="label-form">
    <label for="name"><?php esc_html_e('Name', 'LambrosPersonalTheme'); ?></label>
    <input
      type="text"
      id="name"
      name="name"
      required
      autocomplete="name"
      value="<?php echo esc_attr( $name ); ?>"
    />
  </div>

  <div class="label-form">
    <label for="email"><?php esc_html_e('Email', 'LambrosPersonalTheme'); ?></label>
    <input
      type="email"
      id="email"
      name="email"
      required
      autocomplete="email"
      inputmode="email"
      value="<?php echo esc_attr( $email ); ?>"
    />
  </div>

  <div class="label-form">
    <label for="subject"><?php esc_html_e('Subject', 'LambrosPersonalTheme'); ?></label>
    <input
      type="text"
      id="subject"
      name="subject"
      placeholder="<?php esc_attr_e('Subject line', 'LambrosPersonalTheme'); ?>"
      required
      autocomplete="on"
      value="<?php echo esc_attr( $subj ); ?>"
    />
  </div>

  <div class="label-form">
    <label for="message"><?php esc_html_e('Your message', 'LambrosPersonalTheme'); ?></label>
    <textarea
      id="message"
      name="message"
      rows="5"
      placeholder="<?php esc_attr_e('Type your message…', 'LambrosPersonalTheme'); ?>"
      required
    ><?php echo esc_textarea( $msg ); ?></textarea>
  </div>
  <button id="send-button" type="submit" name="submit">
    <?php esc_html_e('Send Message', 'LambrosPersonalTheme'); ?>
  </button>
</form>
