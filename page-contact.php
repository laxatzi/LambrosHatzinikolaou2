<?php
  get_header();
?>
<main>
  <section id="contactme">
    <h2>Why don't you reach out?</h2>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus
      provident repellat in expedita saepe numquam nesciunt maiores.
    </p>
    <div class="contact">
      <div class="message">
        <h3>Send a message</h3>
        <?php
          get_template_part('template-parts/form-basic');
        ?>
      </div>

      <div class="contact-info">
        <h3>Or get in touch another way</h3>
        <div class="contact-info_box">
          <p>
            <ion-icon name="location" size="large"></ion-icon>Mikras Asia 89, Thessaloniki, Greece
          </p>
          <p>
            <ion-icon name="home" size="large"></ion-icon>
                  ZIP code: 55000
          </p>
          <p>
            <ion-icon name="mail" size="large"></ion-icon>duck@gmail.com
          </p>
          <p>
            <ion-icon name="call" size="large"></ion-icon>2310-xxx-xxx
          </p>
          <p>
            <ion-icon size="large" name="logo-whatsapp"></ion-icon>6948-xxx-xxx
          </p>
            &nbsp;
          <p>
            <a href="linkedin.com" target="_blank">
              <ion-icon
                style="color: var(--color-main-dark)"
                size="large"
                name="logo-linkedin"
              ></ion-icon>
            </a>
            <a href="twitter.com" target="_blank">
              <ion-icon
                style="color: var(--color-main-dark)"
                size="large"
                name="logo-twitter"
              ></ion-icon>
            </a>
          </p>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
  get_footer();
