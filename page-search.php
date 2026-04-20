<?php
// Template for the “Search” page (slug: search)
get_header();
?>

<main id="main-content" class="layout__main layout__content site-main main-page-search" aria-label="<?php esc_attr_e( 'Search results', 'LambrosPersonalTheme' ); ?>">
  <?php 
  /**
   * Displays the search results page template.
   *
   * Renders the main search results page with schema.org markup for search results.
   * Loops through available posts and displays them with their title and optional content.
   * If no posts are found, displays the "no content" template part.
   *
   * @since 1.0.0
   *
   * @uses have_posts() - Checks if there are posts to display
   * @uses the_post() - Set up post data for current post in the loop
   * @uses the_ID() - Display the post ID
   * @uses post_class() - Display classes for post div
   * @uses the_title() - Display the post title
   * @uses the_content() - Display the post content
   * @uses get_template_part() - Load a template part for no results fallback
   *
   * @return void
   */
    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class("the-post fade-up"); ?>
        itemscope itemtype="https://schema.org/SearchResultsPage"
      >
        <header class="entry-header flex-column site-header">
          <h1 id="page-title" class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
        </header>

          <div class="entry-content">
            <?php
              // Optional intro/instructions edited in the page body
              the_content();
            ?>
          </div>
        </article>
    <?php endwhile; else : ?>
     <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>

  <section class="search-form__wrapper section" aria-labelledby="search-form-title">
    <h2 id="search-form-title" class="u-sr-only"><?php esc_html_e( 'Search this site', 'LambrosPersonalTheme' ); ?></h2>
    <label for="search-type" class="search-type__label"> <?php esc_html_e( 'Filter by type:', 'LambrosPersonalTheme' ); ?> </label>
    <select id="search-type" class="search-type">
      <option value="any"><?php esc_html_e( 'All', 'LambrosPersonalTheme' ); ?></option>
      <option value="post"><?php esc_html_e( 'Posts', 'LambrosPersonalTheme' ); ?></option>
      <option value="page"><?php esc_html_e( 'Pages', 'LambrosPersonalTheme' ); ?></option>
      <option value="project"><?php esc_html_e( 'Projects', 'LambrosPersonalTheme' ); ?></option>
   </select>

 <?php
      // Core search form (already pre-fills the current query and has label)
      ?>
      <div id="search-page-form"> <?php get_search_form(); ?> </div>
    <div id="live-search-results" class="live-search__results" aria-live="polite"></div>

  </section>
</main>

<?php get_footer(); ?>
