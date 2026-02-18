<?php
/**
 * Search Form Template
 *
 * Provides the HTML structure for the site's search form.
 * Used by get_search_form() function throughout the theme.
 *
 * @package LambrosPersonalTheme
 * @since 1.0.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url(site_url('/')) ?> ">
   <div class="search-form">
    <label for="live-search-input">Perform a new search:</label>
    <input   id="live-search-input" type="search" name="s" placeholder="What are you searching for?" aria-label="Search query">
  </div>
  <input type="submit" value="Search" aria-label="Submit search">
</form>
