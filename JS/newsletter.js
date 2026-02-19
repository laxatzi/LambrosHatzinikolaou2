document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".newsletter-form");
  const messageBox = document.querySelector(".newsletter-message");

  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Honeypot check
    if (form.hp.value.trim() !== "") {
      return; // Bot detected
    }

    const email = form.email.value.trim();
    if (!email) return;

    // Success animation
    messageBox.textContent = "Thanks for subscribing!";
    messageBox.classList.add("success");

    form.reset();
  });
});

