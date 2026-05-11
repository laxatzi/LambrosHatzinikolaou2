<?php
/**
 * Display a contact form message from a transient.
 * 
 * Retrieves a contact message stored in a transient, displays it with
 * appropriate styling based on message type (success or error), and then
 * deletes the transient to prevent the message from persisting across page loads.
 * 
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
