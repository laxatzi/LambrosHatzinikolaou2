<?php

// Exit if accessed directly for security
if ( ! defined( 'ABSPATH' ) ) {
    http_response_code( 403 );
     header( 'Content-Type: text/plain; charset=utf-8' );
    exit( 'Forbidden: direct access is not allowed.' );
}

// CONSTANTS
define( 'LAMBROS_THEME_AUTHOR', 'Lambros Hatzinikolaou' );
define( 'LAMBROS_DATE_FORMAT', 'F j, Y' );
define( 'LAMBROS_THEME_VERSION', wp_get_theme()->get( 'Version' ) );


/**
 * Register a custom REST API field that exposes the post author's display name.
 *
 * This function adds a new field named "authorName" to the REST API response
 * for the "post" post type. The field is populated through a callback that
 * retrieves the author's display name based on the post's author ID.
 *
 * Behavior:
 * - Runs during REST API initialization.
 * - Adds a read-only field "authorName" to each post object.
 * - Uses a callback to safely fetch and return the author's display name.
 * - Returns an empty string if no author is found.
 *
 * Schema:
 * - Description: Human-readable author display name.
 * - Type: string
 * - Context: view, edit
 *
 * Intended to be hooked into the 'rest_api_init' action.
 *
 * @return void
 */

function lambros_my_custom_rest() {
    register_rest_field( 'post', 'authorName', [
        'get_callback' => function( $post ) {
            if ( empty( $post['author'] ) ) {
                return '';
            }

            $author_id = absint( $post['author'] );
            $author_name = get_the_author_meta( 'display_name', $author_id );

            return $author_name ?: '';
        },
        'schema' => [
            'description' => __( 'Post author display name', 'LambrosPersonalTheme' ),
            'type'        => 'string',
            'context'     => [ 'view', 'edit' ],
        ],
    ] );
  }
  add_action('rest_api_init', 'lambros_my_custom_rest');


/**
 * Enqueue the theme’s stylesheets and JavaScript assets.
 *
 * This function loads all front-end assets required by the theme, including
 * the main stylesheet, Google Fonts, Ionicons (module and legacy versions),
 * the primary theme script, and the newsletter script. It also passes useful
 * data to JavaScript through wp_localize_script.
 *
 * Behavior:
 * - Retrieves the active theme version and uses it for cache busting.
 * - Enqueues the main stylesheet and Google Fonts.
 * - Loads Ionicons in both module and nomodule formats for broad browser support.
 * - Enqueues the theme’s main JavaScript file and the newsletter script.
 * - Localizes the theme script with the site’s root URL for use in JS.
 *
 * Intended to be hooked into the 'wp_enqueue_scripts' action.
 *
 * @return void
 */

function lambros_enqueue_assets() {

    $ver = 'LAMBROS_THEME_VERSION'

// Styles
    //Adding a version (cache busting)
    wp_enqueue_style('main-styles', get_stylesheet_uri(), [], 'LAMBROS_THEME_VERSION');
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

// YOUR theme JS — note the CASE "js/index.js"
    wp_enqueue_script(
      'theme-scripts',
      get_template_directory_uri() . '/js/index.js',
      [],
      $ver,
      true
    );

// Enqueue newsletter script
    wp_enqueue_script(
       'newsletter-script',
        get_template_directory_uri() . '/js/newsletter.js',
        [],
        null,
        true
    );

// Provide root URL to JS
    wp_localize_script('theme-scripts', 'website_data', [
      'root_url' => home_url('/'),
    ]);
}

add_action( 'wp_enqueue_scripts', 'lambros_enqueue_assets' );


// If you previously injected inline JS in the footer, keep this to avoid duplicate/old code
remove_action('wp_footer', 'wpb_hook_javascript_footer');


/**
 * Sets up theme defaults and registers supported WordPress features.
 *
 * This function is hooked into `after_setup_theme` and performs the
 * initial configuration for the theme. It:
 *
 * - Loads the theme text domain for translation.
 * - Enables support for the document title tag.
 * - Enables featured images (post thumbnails).
 * - Adds HTML5 markup support for specific elements.
 * - Registers support for a custom logo.
 * - Registers navigation menu locations.
 *
 * @since 1.0.0
 *
 * @return void
 */

function lambros_theme_slug_setup() {
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

add_action( 'after_setup_theme', 'lambros_theme_slug_setup' );


/**
 * Outputs fallback favicon and Apple touch icon links in the document head.
 *
 * This function checks whether a Site Icon has been set in the WordPress
 * Customizer. If one exists, no additional markup is added. If not, it
 * prints default <link> tags pointing to favicon assets located in the
 * theme directory.
 *
 * Intended to be hooked into `wp_head`.
 *
 * @since 1.0.0
 *
 * @return void
 */

function lambros_add_favicon_html() {
if (has_site_icon()) return;
?>
  <link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/favicon.ico' ); ?>" />
  <link rel="apple-touch-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/apple-touch-icon.png' ); ?>">
<?php }

add_action('wp_head', 'lambros_add_favicon_html', 5);


/**
 * Restrict front-end search results to standard posts only.
 *
 * This helper checks the main query on the front-end and, when a search
 * request is detected, forces the query to return only items of the
 * "post" post type. This prevents pages or custom post types from
 * appearing in search results unless explicitly allowed elsewhere.
 *
 * Intended to be used with the "pre_get_posts" action.
 *
 * @param WP_Query $q The query instance being modified.
 *
 * @return void
 */

function lambros_modify_search_query( $query ) {
    // Only modify front-end main search queries
    if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
        return;
    }

    // Exclude pages from search results
    $query->set( 'post_type', 'post' );
}
add_action( 'pre_get_posts', 'lambros_modify_search_query' );


// Add emoji to post titles
function lambros_add_emoji_to_title_frontend( $title, $post_id ) {
     // Only on singular post pages, in the main content area
    if ( ! is_singular( 'post' ) ) {
        return $title;
    }
    
    if ( is_admin() || ! in_the_loop() || ! is_main_query() ) {
        return $title;
    }
    
    // Optional: Make it toggleable via post meta
    if ( get_post_meta( $post_id, '_disable_emoji', true ) ) {
        return $title;
    }
    
    return '✨ ' . $title;
}

add_filter( 'the_title', 'lambros_add_emoji_to_title_frontend', 10, 2 );


/**
 * Filter archive titles to remove default prefixes.
 *
 * @param string $title The archive title.
 * @return string Filtered archive title.
 */
function lambros_filter_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $author = get_queried_object();
        $title  = $author ? '<span class="vcard">' . esc_html( $author->display_name ) . '</span>' : $title;
    } elseif ( is_tax() ) {
        $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }

    return $title;
}

add_filter( 'get_the_archive_title', 'lambros_filter_archive_title' );


// Add noindex to 404 pages

add_action('wp_head', function () {
  if (is_404()) echo '<meta name="robots" content="noindex,follow">';
}, 5);


/**
 * Logs details of 404 (Not Found) errors to the PHP error log.
 *
 * This function checks whether the current request results in a 404
 * response. If so, it collects relevant request information including:
 *
 * - The requested URL.
 * - The referring URL (if available).
 * - The visitor's IP address (validated).
 *
 * The collected data is sanitized and written to the server's error log
 * using `error_log()` for debugging and monitoring purposes.
 *
 * Intended to be hooked into an appropriate action such as `template_redirect`.
 *
 * @since 1.0.0
 *
 * @return void
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


/**
 * Process and validate submissions from the theme’s contact form.
 *
 * This handler runs only when the contact form is submitted with the expected
 * nonce and submit field. It performs multiple security checks including CSRF
 * validation, a honeypot field, and a short IP‑based throttle to reduce spam.
 * All user input is sanitized and validated before an email is constructed
 * using hardened headers to avoid header injection and mail delivery issues.
 *
 * Workflow:
 * 1. Confirm the request belongs to this form using a nonce and submit check.
 * 2. Validate the nonce to prevent CSRF attacks.
 * 3. Apply a 60‑second throttle per IP address using transients.
 * 4. Reject submissions where the honeypot field is filled.
 * 5. Sanitize and validate all fields (name, email, subject, message).
 * 6. Build safe email headers using a site‑based From address and a sanitized
 *    Reply‑To header.
 * 7. Send the message to the site administrator and store a success or error
 *    message in a transient.
 * 8. Redirect the user back to the referring page.
 *
 * Security considerations:
 * - Prevents CSRF via wp_verify_nonce.
 * - Blocks automated bots with a honeypot field.
 * - Limits rapid repeat submissions with a transient‑based throttle.
 * - Sanitizes all user input and strips tags from the message body.
 * - Removes newline characters from the Reply‑To name to prevent header injection.
 * - Uses a domain‑safe From header to avoid SPF and DMARC failures.
 *
 * @return void Redirects back to the referring page after processing the form.
 */

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
  // Remove newlines from name to prevent header injection
  $safe_name = str_replace( ["\r", "\n"], '', $name );

  $headers = [
      'From: ' . get_bloginfo( 'name' ) . ' <' . $site_from . '>',
      'Reply-To: ' . $safe_name . ' <' . $email . '>',
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
/**
 * Store a temporary contact form message for display after redirect.
 *
 * This helper saves a short-lived status message (success or error) in a
 * transient so it can be shown to the user after the form handler redirects.
 * The message is expected to be retrieved and displayed on the next page load.
 *
 * @param string $type Message type, usually 'success' or 'error'.
 * @param string $text Human-readable message to show to the user.
 *
 * @return void
 */

function lambros_set_contact_message($type, $text) {
    set_transient('contact_msg', ['type'=>$type,'text'=>$text], 30);
  }


/**
 * Redirect the user back to the referring page and stop execution.
 *
 * This helper safely redirects the user to the page they came from. If the
 * referrer is missing or invalid, it falls back to the site’s home URL.
 * Execution is terminated immediately after the redirect.
 *
 * @return void
 */

function lambros_redirect_back() {
  wp_safe_redirect( wp_get_referer() ?: home_url('/') );
  exit;
  }


/**
 * Adds preconnect and dns-prefetch resource hints for Google Fonts.
 *
 * This function optimizes the loading of Google Fonts by establishing early
 * connections to the required domains. It supports both preconnect (which opens
 * a socket and establishes TLS early) and dns-prefetch (a lighter fallback for
 * older browsers) relation types.
 *
 * The function also deduplicates resource hints to prevent duplicate entries,
 * handling both string URLs and array-based URL configurations.
 *
 * @param array $urls          An array of URLs or URL configurations to be processed.
 *                             Each entry can be either a string or an associative array
 *                             with an 'href' key and additional attributes.
 * @param string $relation_type The type of resource hint relation. Accepts 'preconnect'
 *                             or 'dns-prefetch'.
 *
 * @return array An array of deduplicated URL entries filtered by relation type.
 *               Returns preconnect and dns-prefetch hints with appropriate formatting
 *               based on the specified relation type.
 */

 function lambros_preconnect_Google_Fonts ($urls, $relation_type) {
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
    $urls[] = '//fonts.googleapis.com';
    $urls[] = '//fonts.gstatic.com';
  }

  // De-duplicate resource hints (handle both strings and ['href' => ...] arrays)
  $unique_urls = [];
  $seen        = [];

  foreach ( $urls as $entry ) {
    if ( is_array( $entry ) && isset( $entry['href'] ) ) {
      $key = strtolower( (string) $entry['href'] );
    } else {
      $key = strtolower( (string) $entry );
    }

    if ( isset( $seen[ $key ] ) ) {
      continue;
    }

    $seen[ $key ]   = true;
    $unique_urls[] = $entry;
  }

  return $unique_urls;
}

add_filter('wp_resource_hints', 'lambros_preconnect_Google_Fonts', 10, 2);


/**
 * Calculate the estimated reading time for a post
 *
 * @param int|null $post_id The post ID to calculate reading time for.
 *                          If null, uses the current post ID.
 *
 * @return int The estimated reading time in minutes (rounded up).
 *
 * @example
 *     $reading_time = lambros_get_reading_time( 42 );
 *     echo $reading_time; // Output: 5
 */

function lambros_get_reading_time( $post_id = null ) {
  $post_id = $post_id ?: get_the_ID();
    $content = get_post_field( 'post_content', $post_id );

    // If content is empty
    if ( empty( $content ) ) {
        return 0;
    }

    // Count words
    $word_count = str_word_count( wp_strip_all_tags( $content ) );

   if ( $word_count < 200 ) {
        return 1; // Minimum 1 minute for very short posts
    }

    // Average reading speed: 200 wpm
    $minutes = ceil( $word_count / 200 );

    return (int) $minutes;
}


/**
 * Enqueue live search scripts and localize AJAX URL.
 *
 * Registers and enqueues the live search JavaScript file with dependencies.
 * Localizes the script with the WordPress AJAX URL for frontend requests.
 *
 * @return void
 */

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
        'nonce'    => wp_create_nonce( 'live_search_nonce' ),                       
    ]);
}
add_action('wp_enqueue_scripts', 'lambros_live_search_scripts');


/**
 * Handles AJAX live search functionality for posts, pages, and projects.
 *
 * Retrieves search query and post type from GET parameters, sanitizes input,
 * and queries for matching posts. Displays results in an HTML list with
 * highlighted search terms and optional post thumbnails.
 *
 * @return void Outputs HTML list of search results or "no results" message,
 *              then terminates execution with wp_die().
 *
 * @since 1.0.0
 *
 * @global wpdb $wpdb WordPress database object.
 *
 * @uses sanitize_text_field() To sanitize GET parameters.
 * @uses WP_Query To query posts by search term and type.
 * @uses get_the_title() To retrieve post title.
 * @uses esc_html() To escape HTML content.
 * @uses preg_quote() To escape regex special characters.
 * @uses has_post_thumbnail() To check if post has featured image.
 * @uses get_the_post_thumbnail() To retrieve post thumbnail HTML.
 * @uses get_the_ID() To retrieve current post ID.
 * @uses esc_url() To escape permalink URL.
 * @uses get_permalink() To retrieve post permalink.
 * @uses esc_html__() To translate and escape no results message.
 * @uses wp_reset_postdata() To restore original post data.
 * @uses wp_die() To terminate execution.
 */

function lambros_live_search_ajax() {
// Verify nonce
    check_ajax_referer( 'live_search_nonce', 'nonce' );
    
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
          // Escape title FIRST, then highlight
            $safe_title = esc_html( $title );
          
     // Now safely highlight the already-escaped content
           $highlighted = preg_replace(
                '/(' . preg_quote( esc_html($query), '/') . ')/i',
                '<mark class="highlight">$1</mark>',
                $safe_title
            );

            echo '<li class="live-search-item" >';

            if (has_post_thumbnail()) {
                echo '<span class="thumb">';
                echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', ['loading' => 'lazy']);
                echo '</span>';
            }

            echo '<a href="' . esc_url(get_permalink()) . '">' . $highlighted . '</a>';
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


// CUSTOMIZER SETTINGS

/**
 * Social Links Customizer Settings
 *
 * @package LambrosPersonalTheme
 * @since 1.0.0
 */

/**
 * Validate and sanitize social media URLs
 *
 * Ensures URLs match whitelisted domains. Accepts exact domain matches
 * or subdomains (e.g., "mobile.twitter.com" for "twitter.com").
 *
 * @param string $url            The URL to validate.
 * @param string $allowed_domain The allowed domain (e.g., "github.com").
 *
 * @return string Sanitized URL if valid, empty string otherwise.
 *
 * @since 1.0.0
 */
function lambros_validate_social_url( $url, $allowed_domain ) {
    // Sanitize URL
    $url = esc_url_raw( $url );

    // Allow empty values (field is optional)
    if ( empty( $url ) ) {
        return '';
    }

    // Extract hostname
    $host = wp_parse_url( $url, PHP_URL_HOST );

    if ( ! $host ) {
        return ''; // Invalid URL structure
    }

    // Normalize for case-insensitive comparison
    $host           = strtolower( $host );
    $allowed_domain = strtolower( $allowed_domain );

    // Allow exact match or subdomains
    // Examples:
    // - "github.com" matches "github.com" ✓
    // - "www.github.com" matches "github.com" ✓
    // - "gist.github.com" matches "github.com" ✓
    // - "github.io" does NOT match "github.com" ✗
    if ( $host === $allowed_domain || str_ends_with( $host, '.' . $allowed_domain ) ) {
        return $url;
    }

    return ''; // Domain doesn't match
}


/**
 * Get social network configuration
 *
 * Returns array of supported social networks with their domains.
 * Centralized so it can be used by multiple functions.
 *
 * @return array Associative array of network slug => domain.
 *
 * @since 1.0.0
 */
function lambros_get_social_networks() {
    return [
        'x'         => 'x.com',
        'linkedin'  => 'linkedin.com',
        'github'    => 'github.com',
        'youtube'   => 'youtube.com',
        'instagram' => 'instagram.com',
        'whatsapp'  => 'wa.me',
    ];
}


/**
 * Register social links customizer section and settings
 *
 * Creates a customizer section with URL inputs for each supported social network.
 * Only accepts URLs from whitelisted domains. Empty fields are ignored in frontend.
 *
 * @param WP_Customize_Manager $wp_customize WordPress customizer object.
 *
 * @return void
 *
 * @since 1.0.0
 */
function lambros_customize_social_links( $wp_customize ) {
    // Add customizer section
    $wp_customize->add_section( 'lambros_social_links', [
        'title'       => __( 'Social Links', 'LambrosPersonalTheme' ),
        'priority'    => 160,
        'description' => __( 'Add your social media profile URLs. Empty fields will not be displayed.', 'LambrosPersonalTheme' ),
    ] );

    // Get social networks configuration
    $social_networks = lambros_get_social_networks();

    // Register settings and controls for each network
    foreach ( $social_networks as $network => $domain ) {
        lambros_register_social_network_setting( $wp_customize, $network, $domain );
    }
}
add_action( 'customize_register', 'lambros_customize_social_links' );


/**
 * Register a single social network setting and control
 *
 * @param WP_Customize_Manager $wp_customize WordPress customizer object.
 * @param string               $network      Network slug (e.g., 'github').
 * @param string               $domain       Allowed domain (e.g., 'github.com').
 *
 * @return void
 *
 * @since 1.0.0
 */
function lambros_register_social_network_setting( $wp_customize, $network, $domain ) {
    $setting_id = "lambros_{$network}_url";

    // Add setting with validation
    $wp_customize->add_setting( $setting_id, [
        'default'           => '',
        'transport'         => 'refresh', // or 'postMessage' for live preview
        'sanitize_callback' => function( $value ) use ( $domain ) {
            return lambros_validate_social_url( $value, $domain );
        },
    ] );

    // Add control (UI input field)
    $wp_customize->add_control( $setting_id, [
        'label'       => sprintf(
            /* translators: %s: Social network name */
            __( '%s Profile URL', 'LambrosPersonalTheme' ),
            ucfirst( $network )
        ),
        'section'     => 'lambros_social_links',
        'type'        => 'url',
        'description' => sprintf(
            /* translators: %s: Allowed domain */
            __( 'Must be a %s URL', 'LambrosPersonalTheme' ),
            $domain
        ),
    ] );
}


/**
 * Get saved social link URL for a specific network
 *
 * Helper function to retrieve social links from theme mods.
 * Returns empty string if not set or invalid.
 *
 * @param string $network Network slug (e.g., 'github').
 *
 * @return string The saved URL or empty string.
 *
 * @since 1.0.0
 */
function lambros_get_social_link( $network ) {
    return get_theme_mod( "lambros_{$network}_url", '' );
}


/**
 * Get all saved social links
 *
 * Returns an associative array of all configured social links.
 * Only includes networks that have a URL set.
 *
 * @return array Array of network => URL pairs.
 *
 * @since 1.0.0
 *
 * @example
 * $links = lambros_get_all_social_links();
 * // Returns: ['github' => 'https://github.com/username', ...]
 */
function lambros_get_all_social_links() {
    $social_networks = lambros_get_social_networks();
    $links = [];

    foreach ( $social_networks as $network => $domain ) {
        $url = lambros_get_social_link( $network );

        if ( ! empty( $url ) ) {
            $links[ $network ] = $url;
        }
    }

    return $links;
}














