<?php 
// Build link data
$links = [
  [
    'label'   => esc_html__( 'About', 'personaltheme' ),
    'url'     => esc_url( home_url( '/about' ) ),
    'current' => is_page( 'about' ),
  ],
  [
    'label'   => esc_html__( 'Articles', 'personaltheme' ),
    'url'     => esc_url( home_url( '/blog' ) ),
    // active on the posts index and on single posts
    'current' => is_home() || is_singular( 'post' ),
  ],
  [
    'label'   => esc_html__( 'Projects', 'personaltheme' ),
    'url'     => esc_url( get_post_type_archive_link( 'project' ) ?: home_url( '/projects' ) ),
    'current' => is_post_type_archive( 'project' ) || is_singular( 'project' ),
  ],
  [
    'label'   => esc_html__( 'Contact', 'personaltheme' ),
    'url'     => esc_url( home_url( '/contact' ) ),
    'current' => is_page( 'contact' ),
  ],
];
?>
<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'LambrosPersonalTheme' ); ?>">
  <ul class="nav site-nav" id="js--menu">
    <?php foreach ( $links as $item ) : ?>
      <li>
        <a
          href="<?php echo $item['url']; ?>"
          class="<?php echo $item['current'] ? 'indicator' : ''; ?>"
          <?php echo $item['current'] ? 'aria-current="page"' : ''; ?>
        >
          <?php echo $item['label']; ?>
        </a>
      </li>
    <?php endforeach; ?>

    <li>
      <!-- Search trigger: this activates your overlay via JS -->
      <a
        href="#"
        class="search-trigger visible"
        aria-label="<?php esc_attr_e( 'Open search', 'LambrosPersonalTheme' ); ?>"
        aria-haspopup="dialog"
        aria-controls="search-overlay"
        aria-expanded="false"
      >
        <?php esc_html_e( 'Search', 'LambrosPersonalTheme' ); ?>
        <ion-icon class="magnifying-glass" name="search" size="small" aria-hidden="true"></ion-icon>
        <span class="sr-only"><?php esc_html_e( 'Open site search', 'LambrosPersonalTheme' ); ?></span>
      </a>
    </li>
  </ul>
</menu>
