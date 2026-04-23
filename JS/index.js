// /js/index.js (or /JS/index.js)
document.addEventListener("DOMContentLoaded", () => {
  // Mark JS-enabled without nuking other classes
  document.documentElement.classList.add("js");
  document.documentElement.classList.remove("no-js");

  // Back to top

  const backToTop = document.getElementById("top-button");
  if (!backToTop) return;

  const toggleBackToTop = () => {
    const shouldShow = window.scrollY > window.innerHeight;
    backToTop.hidden = !shouldShow;
    backToTop.setAttribute("aria-hidden", shouldShow ? "false" : "true");
  };

  window.addEventListener("scroll", toggleBackToTop, { passive: true });
  toggleBackToTop();

  backToTop.addEventListener("click", (e) => {
    e.preventDefault();

    const prefersReducedMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;

    window.scrollTo({
      top: 0,
      behavior: prefersReducedMotion ? "auto" : "smooth",
    });
  });

  // Mobile menu toggle

  const button = document.getElementById("toggle-menu-button");
  const menu = document.getElementById("js--menu");

  if (button && menu) {
    button.addEventListener("click", () => {
      const isOpen = menu.classList.toggle("is-open");
      button.setAttribute("aria-expanded", isOpen ? "true" : "false");

      const icons = button.querySelectorAll("ion-icon");
      if (icons.length === 2) {
        icons[0].hidden = isOpen; // menu icon
        icons[1].hidden = !isOpen; // close icon
      }
    });
  }
}); // end of window load
