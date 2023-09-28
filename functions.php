<?php
  function my_custom_rest() {
    register_rest_field('post', 'authorName', array(
      'get_callback' => function() { return get_the_author() ;}
    ));
  }
  add_action('rest_api_init', 'my_custom_rest');

   function style_files() {
     wp_enqueue_style('main_styles', get_stylesheet_uri());
     wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=JetBrains+Mono&display=swap');
  }

  add_action('wp_enqueue_scripts', 'style_files');

  // import ion-icons
  function my_theme_load_ionicons_font() {
    // Load Ionicons font from CDN
    wp_enqueue_script( 'my-theme-ionicons', 'https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js', array(), '7.1.0', true );
  }

  add_action( 'wp_enqueue_scripts', 'my_theme_load_ionicons_font' );

  // Set the title tag automatically
    function theme_slug_setup() {
      add_theme_support( 'title-tag' );
    }

  add_action( 'after_setup_theme', 'theme_slug_setup' );

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

function add_favicon(){ ?>
    <!-- Custom Favicons -->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico"/>
    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png">
    <?php }

add_action('wp_head','add_favicon');

function custom_javascript() {
  wp_enqueue_script( 'my_script', get_template_directory_uri() . '/js/index.js');
   wp_localize_script('my_script', 'website_data', array(
    'root_url' => get_site_url(),
  ));
  }

add_action('wp_footer', 'custom_javascript');
?>

