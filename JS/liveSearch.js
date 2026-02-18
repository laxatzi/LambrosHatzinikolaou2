(function () {
  const input = document.querySelector("#live-search-input");
  const typeSelect = document.querySelector("#search-type");
  const resultsBox = document.querySelector("#live-search-results");

  if (!input || !resultsBox) return;

  let timer;
  let activeIndex = -1;

  function fetchResults() {
    const query = input.value.trim();
    const type = typeSelect ? typeSelect.value: 'any';

    if (query.length < 2) {
      resultsBox.innerHTML = "";
      resultsBox.classList.remove("open");
      return;
    }

    const url = new URL(LiveSearch.ajax_url);
    url.search = new URLSearchParams({
      action: "live_search",
      q: query,
      type: type,
      nonce: LiveSearch.nonce,
    }).toString();

    resultsBox.innerHTML = "<p class='loading'>Searching…</p>";
    resultsBox.classList.add("open");
    resultsBox.setAttribute("aria-busy", "true");
    
    fetch(url)
      .then((res) => { 
         if (!res.ok) throw new Error("Request failed"); 
        return res.text(); 
      })
      .then((html) => {
        resultsBox.innerHTML = html;
        resultsBox.classList.add("open");
        resultsBox.removeAttribute("aria-busy");
        activeIndex = -1;
      })
      .catch(() => {
        resultsBox.innerHTML = "<p class='error'>Error loading results.</p>";
        resultsBox.removeAttribute("aria-busy");
      });
  }

  input.addEventListener("input", function () {
    clearTimeout(timer);
    timer = setTimeout(fetchResults, 250);
  });

  typeSelect.addEventListener("change", fetchResults);

 
  // Keyboard navigation for result types
  input.addEventListener("keydown", function (e) {
    const items = resultsBox.querySelectorAll(".live-search-item");
    if (!items.length) return;

    const updateActiveClass = () => {
      items.forEach((item, i) =>
        item.classList.toggle("active", i === activeIndex),
      );
    };

    if (e.key === "ArrowDown") {
      e.preventDefault();
      activeIndex = (activeIndex + 1) % items.length;
      updateActiveClass();
    } else if (e.key === "ArrowUp") {
      e.preventDefault();
      activeIndex = (activeIndex - 1 + items.length) % items.length;
      updateActiveClass();
    } else if (e.key === "Enter" && activeIndex >= 0) {
       e.preventDefault();
      items[activeIndex].querySelector("a").click();
    }

    items[activeIndex].querySelector("a").focus();

  });
})();
