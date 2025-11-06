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
<input type="hidden" name="contact_form">
  <div class="label-form">
    <label for="name"><?php echo esc_html( 'Name', 'LambrosPersonalTheme' ); ?></label>
    <input type="text" id="name" name="name" required />
  </div>
  <div class="label-form">
    <label for="email"><?php echo esc_html( 'Email', 'LambrosPersonalTheme' ); ?></label>
    <input type="email" id="email" name="email" required />
  </div>
  <div class="label-form">
    <label for="subject-line"><?php echo esc_html( 'Send your inquiry or just say hello!', 'LambrosPersonalTheme' ); ?></label>
    <div class="textarea">
      <input
        type="text"
        id="subject-line"
        name="subject-line"
        placeholder="Subject line"
        required
      />
    <textarea
      name="message"
      rows="5"
      placeholder="Your message..."
    ></textarea>
    </div>
  </div>
  <input type="submit" name="submit" value="Send Message" />
</form>
