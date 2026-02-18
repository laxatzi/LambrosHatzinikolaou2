<?php
/**
 * Display contact form feedback messages.
 *
 * This function retrieves a temporary message stored in a transient
 * after a contact form submission and displays it to the user. The
 * message is shown once and then deleted to prevent it from appearing
 * on subsequent page loads.
 *
 * Behavior:
 * - Checks for a 'contact_msg' transient containing message data.
 * - Displays the message with appropriate CSS classes based on type.
 * - Deletes the transient immediately after displaying to ensure
 *   the message only appears once.
 * - If no message exists, the function returns early without output.
 *
 * Message structure:
 * - 'type': Either 'success' or 'error'
 * - 'text': The message text to display
 *
 * Intended to be hooked into 'wp_footer'.
 *
 * @return void
 *
 * @since 1.0.0
 */
function lambros_show_contact_message() {
  $msg = get_transient('contact_msg');
  if ( ! $msg ) return;

  // Delete after showing so it doesn't persist
  delete_transient('contact_msg');

  $class = $msg['type'] === 'success' ? 'contact-success' : 'contact-error';
  ?>
  <div class="contact-message <?php echo esc_attr($class); ?>">
    <?php echo esc_html($msg['text']); ?>
  </div>
  <?php
}
add_action('wp_footer', 'lambros_show_contact_message');
