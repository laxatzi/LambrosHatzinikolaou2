<?php 
// Build link data
$links = [
  [
    'label'   => esc_html__( 'About', 'LambrosPersonalTheme' ),
    'url'     => esc_url( home_url( '/about' ) ),
    'current' => is_page( 'about' ),
  ],
  [
    'label'   => esc_html__( 'Articles', 'LambrosPersonalTheme' ),
    'url'     => esc_url( home_url( '/blog' ) ),
    // active on the posts index and on single posts
    'current' => is_home() || is_singular( 'post' ),
  ],
  [
    'label'   => esc_html__( 'Projects', 'LambrosPersonalTheme' ),
    'url'     => esc_url( get_post_type_archive_link( 'project' ) ?: home_url( '/projects' ) ),
    'current' => is_post_type_archive( 'project' ) || is_singular( 'project' ),
  ],
  [
    'label'   => esc_html__( 'Contact', 'LambrosPersonalTheme' ),
    'url'     => esc_url( home_url( '/contact' ) ),
    'current' => is_page( 'contact' ),
  ],
  [
    'label'   => esc_html__( 'Search', 'LambrosPersonalTheme' ),
    'url'     => esc_url( home_url( '/search' ) ),
    'current' => is_page( 'search' ),
  ],
];
?>

<nav class="site-header__nav site-nav__primary" aria-label="<?php esc_attr_e( 'Primary', 'LambrosPersonalTheme' ); ?>">
  <ul class="nav nav__list site-nav" id="js--menu">
    <?php foreach ( $links as $item ) : ?>
      <!-- If you ever want to style the active item differently (background, underline, etc.), it’s useful to have a CSS class on that item. Here, we add the class current-menu-item to the <li> of the active page. -->
      <li class="nav__list-item <?php echo $item['current'] ? 'current-menu-item' : ''; ?>">

        <a
          href="<?php echo esc_url( $item['url'] ); ?>"
          class="nav__list-link <?php echo $item['current'] ? 'indicator' : ''; ?>"
          <?php echo $item['current'] ? 'aria-current="page"' : ''; ?>
        >
          <?php echo $item['label']; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>
