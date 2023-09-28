<form name="contact_form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype="multipart/form-data" autocomplete="off">
  <div class="label-form">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required />
  </div>
  <div class="label-form">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required />
  </div>
  <div class="label-form">
    <label for="subject-line">Send your inquiry or just say hello!</label>
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