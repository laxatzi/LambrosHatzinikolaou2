document.documentElement.className = "js";

const searchTrigger = document.querySelector(".search-trigger");
const closer = document.querySelector(".closer");
const searchOverlay = document.querySelector(".search-overlay");
const inputField = document.querySelector("#search");
const searchGlass = document.querySelector(".input-field span");
const body = document.querySelector("body");
let typingTimer;
const searchResultsDiv = document.querySelector(
  "#search-overlay--search-results"
);
const spinnerDiv = document.querySelector(".spinner-div");
let typedVal;
let isSearchOverlayOpen = false;

const openSearch = function () {
  if (searchOverlay.classList.contains("search-overlay--mute")) {
    searchOverlay.classList.add("search-overlay--active");
    searchOverlay.classList.remove("search-overlay--mute");
    body.classList.add("no-scroll");
    inputField.value = "";
    setTimeout(() => inputField.focus(), 400);
    isSearchOverlayOpen = true;
  } else return;
};

const closeSearch = function () {
  if (searchOverlay.classList.contains("search-overlay--active")) {
    searchOverlay.classList.add("search-overlay--mute");
    searchOverlay.classList.remove("search-overlay--active");
    body.classList.remove("no-scroll");
    isSearchOverlayOpen = false;
    // in order to compensate the small lag in redirecting
    if (window.location.href.match("/search") != null) {
      body.classList.add("hidden");
    }
    // redirecting
    window.location.href = "http://lambroshatzinikolaou.local/";
  } else return;
};

const keyToOpenSearch = function (ev) {
  let key = ev.key;
  if ((key == "s" || key == "S") && ev.altKey && !isSearchOverlayOpen) {
    openSearch();
  }
  if (key == "Escape" && isSearchOverlayOpen) {
    closeSearch();
  }
};

const openTheSearch = function (ev) {
  if (window.location.href.match("/search") != null) {
    openSearch();
  } else return;
};

const getSearchResults = function () {
  // fetch json for posts and page separately
  const posts = fetch(
    website_data.root_url + "/wp-json/wp/v2/posts?search=" + inputField.value
  ).then((response) => response.json());

  const pages = fetch(
    website_data.root_url + "/wp-json/wp/v2/pages?search=" + inputField.value
  ).then((response) => response.json());

  // Once fetched create a promise and then merge them together in one json file
  Promise.all([posts, pages])
    .then(([posts, pages]) => posts.concat(pages))
    // Insert the suitable html for the respective case
    .then(function (json) {
      searchResultsDiv.insertAdjacentHTML(
        "beforeend",
        `${
          // if there is data in the search results they will be dynamically returned otherwise a hardcoded paragraph will be returned instead
          json.length
            ? json
                .map(
                  (el) => `<p><a href="${el.link}">${el.title.rendered}</a></p>
                        <p>${el.excerpt.rendered}</p>`
                )
                .join("")
            : `<p>Sorry. No results found!</p>`
        }`
      );
    })
    .catch(function (err) {
      console.error(err.message);
      searchResultsDiv.insertAdjacentHTML("beforeend", `<p>${err.stack}</p>`);
    });
};

const notSearchResults = function () {
  return (searchResultsDiv.textContent = "");
};

const typing = function (ev) {
  if (typedVal !== inputField.value) {
    clearTimeout(typingTimer);
    if (inputField.value) {
      spinnerDiv.setAttribute("class", "spinner-loader"); // init spinner
      notSearchResults();
      typingTimer = setTimeout(() => {
        spinnerDiv.removeAttribute("class", "spinner-loader");
        // set a clean slate
        notSearchResults();
        // get the new results
        getSearchResults();
      }, 500);
    } else {
      spinnerDiv.removeAttribute("class", "spinner-loader");
      notSearchResults();
    }
  }
  typedVal = inputField.value;
};

const topBtn = document.getElementById('top-button');
window.addEventListener('scroll', () => {
  const show = window.scrollY > 250;
  if (topBtn) topBtn.hidden = !show;
});
topBtn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

// Event Listeners
window.addEventListener("load", openTheSearch);
closer.addEventListener("click", closeSearch);
document.addEventListener("keydown", keyToOpenSearch);
inputField.addEventListener("keyup", typing);
