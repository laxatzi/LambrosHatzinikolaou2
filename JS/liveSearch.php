(function () {
  const input = document.querySelector("#search-type");
  const typeSelect = document.querySelector("#search-type");
  const resultsBox = document.querySelector("#live-search-results");

  if (!input || !resultsBox) return;

  let timer;
  let activeIndex = -1;

  function fetchResults() {
    const query = input.value.trim();
    const type = typeSelect ? typeSelect.value: 'Any';

    if (query.length < 2) {
      resultsBox.innerHTML = "";
      resultsBox.classList.remove("open");
      return;
    }

    fetch(
      LiveSearch.ajax_url +
        "?action=live_search&q=" +
        encodeURIComponent(query) +
        "&type=" +
        encodeURIComponent(type),
    )
      .then((res) => res.text())
      .then((html) => {
        resultsBox.innerHTML = html;
        resultsBox.classList.add("open");
        activeIndex = -1;
      })
      .catch(() => {
        resultsBox.innerHTML = "<p>Error loading results.</p>";
      });
  }

  input.addEventListener("input", function () {
    clearTimeout(timer);
    timer = setTimeout(fetchResults, 250);
  });

  typeSelect.addEventListener("change", fetchResults);

  // Keyboard navigation (unchanged)
  input.addEventListener("keydown", function (e) {
    const items = resultsBox.querySelectorAll(".live-search-item");
    if (!items.length) return;

    if (e.key === "ArrowDown") {
      e.preventDefault();
      activeIndex = (activeIndex + 1) % items.length;
      items.forEach((item, i) =>
        item.classList.toggle("active", i === activeIndex),
      );
    }

    if (e.key === "ArrowUp") {
      e.preventDefault();
      activeIndex = (activeIndex - 1 + items.length) % items.length;
      items.forEach((item, i) =>
        item.classList.toggle("active", i === activeIndex),
      );
    }

    if (e.key === "Enter" && activeIndex >= 0) {
      e.preventDefault();
      items[activeIndex].querySelector("a").click();
    }
  });
})();
