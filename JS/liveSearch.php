(function () {
  const input = document.querySelector('#searchform input[type="search"]');
  const resultsBox = document.querySelector("#live-search-results");

  if (!input || !resultsBox) return;

  let timer;

  input.addEventListener("input", function () {
    const query = this.value.trim();

    clearTimeout(timer);

    if (query.length < 2) {
      resultsBox.innerHTML = "";
      return;
    }

    timer = setTimeout(() => {
      fetch(
        LiveSearch.ajax_url +
          "?action=live_search&q=" +
          encodeURIComponent(query),
      )
        .then((res) => res.text())
        .then((html) => {
          resultsBox.innerHTML = html;
        })
        .catch(() => {
          resultsBox.innerHTML = "<p>Error loading results.</p>";
        });
    }, 250);
  });
})();

