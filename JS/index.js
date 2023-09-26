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
  } else return;
};

const keyToOpenSearch = function (ev) {
  let key = ev.key;

  if (
    searchTrigger === document.activeElement &&
    key === "Enter" &&
    !isSearchOverlayOpen
  ) {
    openSearch();
  }
  if ((key == "s" || key == "S") && ev.altKey && !isSearchOverlayOpen) {
    openSearch();
  }
  if (key == "Escape" && isSearchOverlayOpen) {
    closeSearch();
  }
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

// Event Listeners
searchTrigger.addEventListener("click", openSearch);
closer.addEventListener("click", closeSearch);
searchGlass.addEventListener("click", () => console.log(inputField.value));
document.addEventListener("keydown", keyToOpenSearch);
inputField.addEventListener("keyup", typing);

// window loader
document.querySelector("#wrapper").style.display = "none";
window.onload = function () {
  document.getElementById("container-loader").style.display = "none";
  document.querySelector("#wrapper").style.display = "block";
};
//loading delay simulation
// setTimeout(() => {
//   document.getElementById("container-loader").style.display = "none";
//   document.querySelector("#wrapper").style.display = "block";
// }, 4000);
