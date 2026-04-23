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
  const toggleBtn = document.querySelector(".toggle-menu");
  const nav = document.querySelector(".site-nav");
  if (toggleBtn && nav) {
    const setExpanded = (state) => {
      toggleBtn.setAttribute("aria-expanded", state ? "true" : "false");
      nav.classList.toggle("is-open", state);
    };
    setExpanded(false);
    toggleBtn.addEventListener("click", () => {
      const next = !(toggleBtn.getAttribute("aria-expanded") === "true");
      setExpanded(next);
    });
  }
}); // end of window load
