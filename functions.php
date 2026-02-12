<?php
  // Add custom fields to REST API responses
  function my_custom_rest() {
    register_rest_field('post', 'authorName', array(
    'get_callback' => function($obj,  $field=null, $req=null) {
      return get_the_author_meta('display_name', (int)$obj['author'] ?? 0);
    }
    ));
  }
  add_action('rest_api_init', 'my_custom_rest');

// Enqueue styles & scripts


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
    'root_url' => home_url('/'),
  ]);
});

// Enqueue newsletter script
function lambros_enqueue_newsletter_script() {
    wp_enqueue_script(
        'newsletter-script',
        get_template_directory_uri() . '/js/newsletter.js',
        [],
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'lambros_enqueue_newsletter_script' );


// If you previously injected inline JS in the footer, keep this to avoid duplicate/old code
remove_action('wp_footer', 'wpb_hook_javascript_footer');

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
function add_favicon_html() {
if (has_site_icon()) return;
?>
  <link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/favicon.ico' ); ?>" />
  <link rel="apple-touch-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/apple-touch-icon.png' ); ?>">
<?php }

add_action('wp_head', 'add_favicon_html', 5);

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

/**
 * Log 404 errors for debugging
 */
function lambros_log_404_errors() {
    if (is_404()) {
        $url = isset($_SERVER['REQUEST_URI']) ? esc_url_raw($_SERVER['REQUEST_URI']) : '';
        $referrer = isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : 'Direct';
        $ip = filter_var(
                $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
                FILTER_VALIDATE_IP
            ) ?: 'Unknown';

        error_log(sprintf(
            '404 Error: %s | Referrer: %s | IP: %s',
            $url,
            $referrer,
            $ip
        ));
    }
}
add_action('wp', 'lambros_log_404_errors');


//This processes the form safely, throttles repeat posts, and sets messages via a transient. It posts back to the same page.
// Contact form handler: nonce + honeypot + throttle + hardened mail headers

function lambros_handle_contact_form() {
    // This function is now empty because we moved the code to an anonymous function below.
   // Only handle our form posts
  if ( empty($_POST['contact_nonce']) || ! isset($_POST['submit']) ) {
    return;
  }

  // CSRF check
  if ( ! wp_verify_nonce( $_POST['contact_nonce'], 'contact_form_submit' ) ) {
    lambros_set_contact_message('error', __('Security check failed. Please try again.',
    'LambrosPersonalTheme')); 
     return lambros_redirect_back();
  }

  // Basic throttle by IP (60s)
  $ip = $_SERVER['REMOTE_ADDR'] ?? '';
  $k  = 'contact_last_' . md5($ip);
  if ( get_transient($k) ) {
    lambros_set_contact_message('error', __('Please wait a minute before sending again.',
    'LambrosPersonalTheme')); 
    return lambros_redirect_back();
  }
  set_transient($k, 1, 60);
  
// Honeypot (bots usually fill this)
  if ( ! empty($_POST['website']) ) {
   lambros_set_contact_message('error', __('Spam detected.','LambrosPersonalTheme')); 
    return lambros_redirect_back();
  }

// Sanitize input
  $name    = sanitize_text_field( wp_unslash($_POST['name'] ?? '') );
  $email   = sanitize_email(      wp_unslash($_POST['email'] ?? '') );
  $subject = sanitize_text_field( wp_unslash($_POST['subject'] ?? '') );
  $message = wp_strip_all_tags(   wp_unslash($_POST['message'] ?? '') );


  // Validate required fields
  $errors = [];
  if ( $name === '' )              $errors[] = __('Name is required.','LambrosPersonalTheme');
  if ( ! is_email($email) )        $errors[] = __('A valid email is required.','LambrosPersonalTheme');
  if ( $subject === '' )           $errors[] = __('Subject is required.','LambrosPersonalTheme');
  if ( trim($message) === '' )     $errors[] = __('Message is required.','LambrosPersonalTheme');

  if ( $errors ) {
    set_transient('contact_msg', ['type'=>'error','text'=>implode(' ', $errors)], 30);
    wp_safe_redirect( wp_get_referer() ?: home_url('/') );
    exit;
  }
  // ---- Hardened email headers ----
  // Use a site address as the From: to avoid SPF/DMARC rejections.
  $host = wp_parse_url( home_url(), PHP_URL_HOST );
  $host = $host ? preg_replace('/^www\./', '', $host) : 'example.com';
  $site_from = 'wordpress@' . $host; // or create a real mailbox like "noreply@yourdomain"

  $mail_subject = sprintf( __('Contact form: %s','LambrosPersonalTheme'), $subject );
  $headers = [
    'From: ' . get_bloginfo('name') . ' <' . $site_from . '>',
    'Reply-To: ' . $name . ' <' . $email . '>',
    'Content-Type: text/plain; charset=UTF-8',
  ];

// Body as plain text
  $body  = "From: {$name} <{$email}>\n";
  $body .= "IP: {$ip}\n";
  $body .= "URL: " . ( wp_get_referer() ?: home_url('/') ) . "\n\n";
  $body .= "Message:\n{$message}\n";

// Send
   $to = get_option('admin_email');
  // Change to a custom recipient if you prefer
 // $to = 'laxatzi@gmail.com';
  $ok = wp_mail( $to, $mail_subject, $body, $headers );

 lambros_set_contact_message(
   $ok ? 'success' : 'error',
   $ok
     ? __('Thanks! Your message has been sent.','LambrosPersonalTheme')
     : __('Sorry, something went wrong. Please try again later.',
      'LambrosPersonalTheme') );

     return lambros_redirect_back();
}

add_action('template_redirect', 'lambros_handle_contact_form' );

// --- Helpers ---
function lambros_set_contact_message($type, $text) {
    set_transient('contact_msg', ['type'=>$type,'text'=>$text], 30);
  }

function lambros_redirect_back() {
  wp_safe_redirect( wp_get_referer() ?: home_url('/') );
  exit;
  }

// Preconnecting to fonts.googleapis.com and fonts.gstatic.com lets the browser do the slow handshake work early so your text styles apply faster.

// Preconnect (and DNS prefetch fallback) for Google Fonts
add_filter('wp_resource_hints', function ($urls, $relation_type) {
  if ( $relation_type === 'preconnect' ) {
    // Preconnect: opens socket + TLS early
    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = [
      'href'        => 'https://fonts.gstatic.com',
      'crossorigin' => 'anonymous',
    ];
  }

  if ( $relation_type === 'dns-prefetch' ) {
    // Light fallback for older browsers
    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = 'https://fonts.gstatic.com';
  }

  return $urls;
}, 10, 2);

// Reading time function

function lambros_get_reading_time( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field( 'post_content', $post_id );

    // Count words
    $word_count = str_word_count( wp_strip_all_tags( $content ) );

    // Average reading speed: 200 wpm
    $minutes = ceil( $word_count / 200 );

    return $minutes;
}


//Live search endpoint for AJAX requests
function lambros_live_search_scripts() {
    wp_enqueue_script(
        'live-search',
        get_template_directory_uri() . '/js/liveSearch.js',
        [],
        null,
        true
    );

    wp_localize_script('live-search', 'LiveSearch', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'lambros_live_search_scripts');

// AJAX handler for live search

function lambros_live_search_ajax() {
    $query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
    $type  = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'any';

    if (strlen($query) < 2) {
        wp_die();
    }

    $args = [
        'post_type'      => $type === 'any' ? ['post', 'page', 'project'] : $type,
        'posts_per_page' => 5,
        's'              => $query,
    ];

    $search = new WP_Query($args);

    if ($search->have_posts()) {
        echo '<ul class="live-search-list">';

        while ($search->have_posts()) {
            $search->the_post();

            $title = get_the_title();
            $highlighted = preg_replace(
                '/(' . preg_quote($query, '/') . ')/i',
                '<mark class="highlight">$1</mark>',
                $title
            );

            echo '<li class="live-search-item" >';

            if (has_post_thumbnail()) {
                echo '<span class="thumb">';
                echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', ['loading' => 'lazy']);
                echo '</span>';
            }

            echo '<a href="' . esc_url(get_permalink()) . '">' . $highlighted . '</a>';

            // echo '<span class="type-label">' . esc_html(ucfirst(get_post_type())) . '</span>';

            echo '</li>';
        }

        echo '</ul>';
    } else {
        echo '<p class="no-results">' . esc_html__('No results found.', 'LambrosPersonalTheme') . '</p>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_live_search', 'lambros_live_search_ajax');
add_action('wp_ajax_nopriv_live_search', 'lambros_live_search_ajax');

/**
 * Get reading time icon SVG
 */
function lambros_get_reading_time_icon() {
    return '<svg class="read-time-icon" width="14" height="14" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>';
}


// CONSTANTS
define( 'LAMBROS_THEME_AUTHOR', 'Lambros Hatzinikolaou' );

// CUSTOMIZER SETTINGS
  //Social Links panel in the Customizer
function lambros_customize_social_links( $wp_customize ) {

    $wp_customize->add_section( 'lambros_social_links', [
        'title'       => __( 'Social Links', 'LambrosPersonalTheme' ),
        'priority'    => 160,
        'description' => __( 'Add your social media profile URLs.', 'LambrosPersonalTheme' ),
    ] );

    // Helper: domain validation
    // Ensures only correct domains are accepted - Empty fields simply don’t render in the footer
    function lambros_validate_social_url( $url, $allowed_domain ) {
        $url = esc_url_raw( $url );
        if ( empty( $url ) ) {
            return '';
        }
        $host = wp_parse_url( $url, PHP_URL_HOST );
        if ( $host && str_contains( $host, $allowed_domain ) ) {
            return $url;
        }
        return '';
    }

    // Social networks
    $social_networks = [
        'x'   => 'x.com',
        'linkedin'  => 'linkedin.com',
        'github'    => 'github.com',
        'youtube'   => 'youtube.com',
        'instagram' => 'instagram.com',
        'whatsapp'  => 'wa.me',
    ];

    foreach ( $social_networks as $network => $domain ) {

        $setting_id = "lambros_{$network}_url";

        $wp_customize->add_setting( $setting_id, [
            'default'           => '',
            'sanitize_callback' => function( $value ) use ( $domain ) {
                return lambros_validate_social_url( $value, $domain );
            },
        ] );

        $wp_customize->add_control( $setting_id, [
            'label'   => ucfirst( $network ) . ' URL',
            'section' => 'lambros_social_links',
            'type'    => 'url',
        ] );
    }
}
add_action( 'customize_register', 'lambros_customize_social_links' );

// Make the Front-Page fallback editable via the Customizer
function lambros_customize_hero_intro( $wp_customize ) {
  $wp_customize->add_section( 'lambros_hero_intro', [
    'title'       => __( 'Hero Intro Text', 'LambrosPersonalTheme' ),
    'priority'    => 30,
    'description' => __( 'Customize the fallback intro text shown on the homepage.', 'LambrosPersonalTheme' ),
  ] );

  $wp_customize->add_setting( 'lambros_hero_intro_text', [
    'default'           => '',
    'sanitize_callback' => 'wp_kses_post',
  ] );

  $wp_customize->add_control( 'lambros_hero_intro_text', [
    'label'   => __( 'Intro Text (HTML allowed)', 'LambrosPersonalTheme' ),
    'section' => 'lambros_hero_intro',
    'type'    => 'textarea',
  ] );
}
add_action( 'customize_register', 'lambros_customize_hero_intro' );




