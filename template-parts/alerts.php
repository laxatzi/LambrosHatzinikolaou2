<?php
/**
 * Display a contact form message from a transient.
 * The transient should be an array with 'type' (success or error) and 'text' (the message).
 * The message is displayed in the footer of the site and is styled based on its type.
 * @uses get_transient() to retrieve the message and delete_transient() to remove it after displaying.
 * The message is sanitized using esc_html() to prevent XSS attacks, and the CSS class is determined based on the type of message.
 * @return void
 */
function lambros_show_contact_message() {
    $msg = get_transient( 'contact_msg' );
    if ( ! $msg || ! isset( $msg['type'], $msg['text'] ) ) return;

    $allowed_types = [ 'success', 'error' ];
    $type  = in_array( $msg['type'], $allowed_types, true ) ? $msg['type'] : 'error';
    $class = $type === 'success' ? 'contact-success' : 'contact-error';

    // Delete only after we've prepared everything
    delete_transient( 'contact_msg' );
    ?>
  <div class="contact-message <?php echo esc_attr( $class ); ?>">
    <?php echo esc_html( $msg['text'] ); ?>
  </div>
  <?php
}
add_action( 'wp_footer', 'lambros_show_contact_message' );
