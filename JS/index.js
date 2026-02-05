// /js/index.js (or /JS/index.js)
document.addEventListener("DOMContentLoaded", () => {
  // Mark JS-enabled without nuking other classes
  document.documentElement.classList.add("js");
  document.documentElement.classList.remove("no-js");

  // Back to top
  const backToTop = document.querySelector("[data-back-to-top]");
  if (backToTop) {
    backToTop.addEventListener("click", function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

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
