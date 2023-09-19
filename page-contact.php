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
              <form action="index.php">
                <div class="label-form">
                  <label for="name">Name</label>
                  <input type="text" id="name" name="name" required />
                </div>
                <div class="label-form">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" required />
                </div>
                <div class="label-form">
                  <label for="subject-line"
                    >Send your inquiry or just say hello!</label
                  >
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
            </div>

            <div class="contact-info">
              <h3>Or get in touch another way</h3>
              <div class="contact-info_box">
                <p>
                  <ion-icon name="location" size="large"></ion-icon>Mikras Asia
                  89, Thessaloniki, Greece
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
                  <ion-icon size="large" name="logo-whatsapp"></ion-icon
                  >6948-xxx-xxx
                </p>
                &nbsp;
                <p>
                  <a href="linkedin.com" target="_blank"
                    ><ion-icon
                      style="color: var(--color-main-dark)"
                      size="large"
                      name="logo-linkedin"
                    ></ion-icon
                  ></a>
                  <a href="twitter.com" target="_blank"
                    ><ion-icon
                      style="color: var(--color-main-dark)"
                      size="large"
                      name="logo-twitter"
                    ></ion-icon
                  ></a>
                </p>
              </div>
            </div>
          </div>
        </section>
      </main>
<?php
  get_footer();
?>