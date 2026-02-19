<?php
// Display contact form feedback messages
function lambros_show_contact_message() {
  $msg = get_transient( 'contact_msg' );
  if ( ! $msg ) return;

  // Delete after showing so it doesn’t persist
  delete_transient( 'contact_msg' );

  $class = $msg['type'] === 'success' ? 'contact-success' : 'contact-error';
  ?>
  <div class="contact-message <?php echo esc_attr( $class ); ?>">
    <?php echo esc_html( $msg['text'] ); ?>
  </div>
  <?php
}
add_action( 'wp_footer', 'lambros_show_contact_message' );
