<?php
  // Add custom fields to REST API responses
  function my_custom_rest() {
    register_rest_field('post', 'authorName', array(
    'get_callback' => function($obj) {
      return get_the_author_meta('display_name', $obj['author'] ?? 0);
    }
    ));
  }
  add_action('rest_api_init', 'my_custom_rest');

// Styles & Scripts
add_action('wp_enqueue_scripts', function () {
  $ver = wp_get_theme()->get('Version') ?: null;

  // Styles
  //Adding a version (cache busting)
  wp_enqueue_style('main-styles', get_stylesheet_uri(), [], $ver);
  wp_enqueue_style(
    'google-fonts',
    'https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=JetBrains+Mono&display=swap',
    [],
    null
  );

  // Ionicons (module + nomodule)
  wp_enqueue_script(
    'ionicons-module',
    'https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js',
    [],
    null,
    true
  );
  wp_script_add_data('ionicons-module', 'type', 'module');

  wp_enqueue_script(
    'ionicons-legacy',
    'https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js',
    [],
    null,
    true
  );
  wp_script_add_data('ionicons-legacy', 'nomodule', true);

  // YOUR theme JS — note the CASE "JS/index.js"
  wp_enqueue_script(
    'theme-scripts',
    get_template_directory_uri() . '/JS/index.js',
    [],
    $ver,
    true
  );

  // Provide root URL to JS
  wp_localize_script('theme-scripts', 'website_data', [
    'root_url' => get_site_url(),
  ]);
});

// If you previously injected inline JS in the footer, keep this to avoid duplicate/old code
remove_action('wp_footer', 'wpb_hook_javascript_footer');

  //add JavaScript to your WordPress footer
function wpb_hook_javascript_footer() {
    ?>
    <script>

   // toggling nav bar
      const toggleMenu = document.querySelector(".toggle-menu");
      const nav = document.querySelector("#js--menu");
      const icon = document.querySelector(".toggle-menu ion-icon");

       ["click", "keypress"].forEach((ev)=>{
        toggleMenu.addEventListener(ev, function(e) {
          if (ev === 'click' || e.key == 'Enter') {
            nav.classList.toggle("show");
            const menuIcon = document.getElementsByTagName("ion-icon")[0];
            const closeIcon = document.getElementsByTagName("ion-icon")[1];

          if (menuIcon.classList.contains("show")) {
              menuIcon.classList.add("close");
              menuIcon.classList.remove("show");
              closeIcon.classList.remove("close");
              closeIcon.classList.add("show");
           } else {
             menuIcon.classList.add("show");
             menuIcon.classList.remove("close");
             closeIcon.classList.remove("show");
             closeIcon.classList.add("close");
           }
          }
        }, false);
      });

  // smooth scrolling
    const hopLinks = document.querySelectorAll(".hop");

    for (const hopLink of hopLinks) {
      hopLink.addEventListener("click", clickToScrollSmoothly);
    }

    function clickToScrollSmoothly(el) {
      el.preventDefault();
      const href = this.getAttribute("href");
      const offsetTop = document.querySelector(href).offsetTop;

      scroll({
        top: offsetTop,
        behavior: "smooth",
      });
    }


// back to top
  // Get the button
   const topButton = document.querySelector("#top-button");

  // When the user scrolls down 250px from the top of the document, show the button
   window.onscroll = function() {scrollFunction()};

   function scrollFunction() {
      if (document.body.scrollTop > 350 || document.documentElement.scrollTop > 350) {
        topButton.style.opacity = 1;
      } else {
        topButton.style.opacity = 0;
      }
  }

  // When the user clicks on the button, scroll to the top of the document
   function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
    </script>
    <?php
}

add_action('wp_footer', 'wpb_hook_javascript_footer');

// Set the title tag automatically also loads the theme’s translated strings.

    function theme_slug_setup() {
      load_theme_textdomain('LambrosPersonalTheme', get_template_directory().'/languages');
      add_theme_support( 'title-tag' );
      add_theme_support('post-thumbnails');
      add_theme_support('html5', ['search-form', 'gallery', 'caption', 'script', 'style']);
  // Custom logo support
  add_theme_support('custom-logo', [
    'height' => 80,
    'width'  => 80,
    'flex-height' => true,
    'flex-width'  => true,
  ]);
  // Menus
  register_nav_menus([
    'primary' => __( 'Primary menu', 'LambrosPersonalTheme' ),
    'footer'  => __( 'Footer menu',  'LambrosPersonalTheme' ),
    'social'  => __( 'Social links', 'LambrosPersonalTheme' ),
  ]);

    }

  add_action( 'after_setup_theme', 'theme_slug_setup' );

// add favicon
function add_favicon_html() { ?>
  <link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/favicon.ico' ); ?>" />
  <link rel="apple-touch-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/apple-touch-icon.png' ); ?>">
<?php }
add_action('wp_head', 'add_favicon_html', 5);

function custom_javascript() {
  wp_enqueue_script( 'my_script', get_template_directory_uri() . '/js/index.js');
   wp_localize_script('my_script', 'website_data', array(
    'root_url' => get_site_url(),
  ));
  }

add_action('wp_footer', 'custom_javascript');

//Alter the WordPress search to return ONLY posts, no pages
add_action('pre_get_posts', function ($q) {
  if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
    $q->set('post_type', 'post'); // only posts on front-end search
  }
});

// Add emoji to post titles
function add_emoji_to_title_frontend( $title, $post_id ) {
    if ( get_post_type($post_id) !== 'post' ) return $title;
    if ( is_admin() || ! in_the_loop() || ! is_main_query() ) {
        return $title;
    }

    return '✨ ' . $title;
}

add_filter( 'the_title', 'add_emoji_to_title_frontend', 10, 2 );

// Manipulate archive titles to remove prefixes

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $author = get_queried_object();
    $title  = $author ? '<span class="vcard">' . esc_html( $author->display_name ) . '</span>' : $title;
  } elseif ( is_tax() ) {

        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});

// Add noindex to 404 pages

add_action('wp_head', function () {
  if (is_404()) echo '<meta name="robots" content="noindex,follow">';
}, 5);


