<?php

// theme setup
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup(){
  load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array( 'search-form' ) );
}

@ini_set( 'upload_max_size' , '24M' );
@ini_set( 'post_max_size', '24M');
@ini_set( 'max_execution_time', '300' );

// add jQuery
// function blankslate_load_scripts(){
//  wp_enqueue_script( 'jquery' );
// }
// add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );

// add custom styles
function cstyles(){
  wp_enqueue_style( 'fontawesome',  get_template_directory_uri() . '/_inc/webfonts/all.min.css', false, '5.0.0',false);
  wp_enqueue_style( 'bootstrap-css',  'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', false, '4.4.1',false);
  wp_enqueue_style( 'animate-css',  'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', false, '3.7.2',false);
  wp_enqueue_style( 'select2-css',  'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css', false, '4.0.12',false);
  wp_enqueue_style( 'colorbox-css',  'https://cdn.jsdelivr.net/npm/jquery-colorbox@1.6.4/example3/colorbox.min.css', false, '1.6.4',false);
  wp_enqueue_style( 'build',  get_template_directory_uri() . '/_inc/css/build.css', false, '1.0.0',false);
}
add_action( 'wp_enqueue_scripts', 'cstyles' );

// add custom scripts
function cscripts() {
  wp_enqueue_script( 'jquery' );  
  wp_enqueue_script( 'bootstrap-js',  'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', false, '4.4.1', true);
  wp_enqueue_script( 'bootstrap-bundle-js',  'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', false, '4.4.1', true);
  wp_enqueue_script( 'pixelate-js',  get_template_directory_uri() . '/_inc/js/pixelate.min.js', false, '1.0.0', true);
  wp_enqueue_script( 'lazyload-js',  'https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js', false, '2.0.0', true);
  wp_enqueue_script( 'wow-js',  'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', false, '1.1.2', true);
  wp_enqueue_script( 'colorbox-js',  'https://cdn.jsdelivr.net/npm/jquery-colorbox@1.6.4/jquery.colorbox.min.js', false, '1.6.4', true);
  wp_enqueue_script( 'select2-js',  'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js', false, '4.0.12', true);
}
add_action( 'wp_enqueue_scripts', 'cscripts' );


//svg support
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


//menus
function register_menus() {
  register_nav_menus(
    array(
      'main-nav' => __( 'Main Nav' ),
      'aux-nav' => __( 'Aux Nav' ),
      'footer-nav' => __( 'Footer Nav' )
    )
  );
}
add_action( 'init', 'register_menus' );


//enable excerpt
add_action( 'init', 'enable_excerpts' );
function enable_excerpts() {
   add_post_type_support( 'page', 'excerpt' );
}

// theme adjust comment reply
function blankslate_enqueue_comment_reply_script(){
  if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );

//adjusts comments pings
function blankslate_custom_pings( $comment ){
  $GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
  }
add_filter( 'get_comments_number', 'blankslate_comments_number' );


// adjust comments number
function blankslate_comments_number( $count ){
  if ( !is_admin() ) {
    global $id;
    $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
    return count( $comments_by_type['comment'] );
  } else {
    return $count;
  }
}

// add placeholders to comment fields
function my_update_comment_fields( $fields ) {

  $commenter = wp_get_current_commenter();
  $req       = get_option( 'require_name_email' );
  $label     = $req ? '*' : ' ' . __( '(optional)', 'text-domain' );
  $aria_req  = $req ? "aria-required='true'" : '';

  $fields['author'] =
    '<p class="comment-form-author">
      <label for="author">' . __( "Username", "text-domain" ) . $label . '</label>
      <input id="author" name="author" type="text" placeholder="' . esc_attr__( "Username*", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30" ' . $aria_req . ' />
    </p>';

  $fields['email'] =
    '<p class="comment-form-email">
      <label for="email">' . __( "Email", "text-domain" ) . $label . '</label>
      <input id="email" name="email" type="email" placeholder="' . esc_attr__( "Email*", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
    '" size="30" ' . $aria_req . ' />
    </p>';

  return $fields;
}
add_filter( 'comment_form_default_fields', 'my_update_comment_fields' );

//move comment field to bottom
function wpb_move_comment_field_to_bottom( $fields ) {
  $cookie_field = $fields['cookies'];
  unset( $fields['comment'] );
  unset( $fields['cookies'] );
  unset( $fields['url'] );
  $fields['comment'] = '<p class="comment-form-comment">
      <label for="comment">' . __( "Comment", "text-domain" ) . '</label>
      <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="' . esc_attr__( "Comment*", "text-domain" ) . '" required="required"></textarea>
      </p>';
  $fields['cookies'] = '<p class="comment-form-cookies-consent">
      <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
      <label for="wp-comment-cookies-consent">Save my username and email in this browser for the next time I comment.</label>
      </p>';
  return $fields;
}
 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

// ACF global options
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array('menu_title'=>'Global Options'));
  
}

// get first image
function first_image () {
    global $post;   // Assuming that this is in The Loop.

    $i = 0;
    
    $images = get_posts (array (
        'numberposts' => -1,
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_parent' => $post->ID,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    
    foreach ($images as $image) {
        $i++;

        $image = wp_get_attachment_image_src ($image->ID, 'medium_large');
        
        if ($i == 1) return esc_url ($image [0]);
    }
}
function first_image_ID () {
    global $post;   // Assuming that this is in The Loop.

    $i = 0;
    
    $images = get_posts (array (
        'numberposts' => -1,
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_parent' => $post->ID,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    
    foreach ($images as $image) {
        $i++;
        
        if ($i == 1) return wp_get_attachment_image_src($image->ID,'medium_large');
    }
}

//custom tag cloud
function set_wp_generate_tag_cloud($content, $tags, $args)
{ 
  $count=0;
  $output=preg_replace_callback('(</a\s*>)', 
  function($match) use ($tags, &$count) {
      return " <span class=\"tagcount\">(".$tags[$count++]->count.")</span></a>";  
  }
  , $content);
  
  return $output;
}
add_filter('wp_generate_tag_cloud','set_wp_generate_tag_cloud', 10, 3);

?>