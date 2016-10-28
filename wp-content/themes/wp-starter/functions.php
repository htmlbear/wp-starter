<?php 

add_theme_support('post-thumbnails' );
add_theme_support('menus' );
add_theme_support('widgets' );
 add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); 


register_nav_menus(array(
	'main' => __( 'Main Nav','dpt' ),
));

// heartbeat control

function optimize_heartbeat_settings( $settings ) {
    $settings['autostart'] = false;
    $settings['interval'] = 60;
    return $settings;
}
add_filter( 'heartbeat_settings', 'optimize_heartbeat_settings' );

function disable_heartbeat_unless_post_edit_screen() {
    global $pagenow;
    if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' )
        wp_deregister_script('heartbeat');
}
add_action( 'init', 'disable_heartbeat_unless_post_edit_screen', 1 );


// Clear wp_head

remove_action( 'wp_head', 'feed_links', 2 ); // Удаляет ссылки RSS-лент записи и комментариев
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Удаляет ссылки RSS-лент категорий и архивов

remove_action( 'wp_head', 'rsd_link' ); // Удаляет RSD ссылку для удаленной публикации
remove_action( 'wp_head', 'wlwmanifest_link' ); // Удаляет ссылку Windows для Live Writer

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0); // Удаляет короткую ссылку
remove_action( 'wp_head', 'wp_generator' ); // Удаляет информацию о версии WordPress
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Удаляет ссылки на предыдущую и следующую статьи

// отключение WordPress REST API
remove_action( 'wp_head', 'rest_output_link_wp_head' ); 
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );


// thumbnails in admin panel

add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs');
    return $defaults;
}

function posts_custom_columns($column_name, $id){
        if($column_name === 'riv_post_thumbs'){
        echo the_post_thumbnail( 'thumbnail' );
    }
}


// Лимит превью
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function theme_styles() {

wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css' );    
    wp_enqueue_style( 'fancybox_css', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css' );    
    wp_enqueue_style( 'slick_css', get_template_directory_uri() . '/js/slick/slick.css' );    
    wp_enqueue_style( 'slick_theme_css', get_template_directory_uri() . '/js/slick/slick-theme.css' );    
    wp_enqueue_style( 'style_my', get_template_directory_uri() . '/css/style.css' );    
  
  wp_enqueue_style( 'style-name', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'theme_styles' );





function my_scripts_method() {
    // wp_deregister_script( 'jquery' );
    // wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', false, '1.3.2', true);
    // wp_enqueue_script( 'jquery' ,'1.0.0', true );

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', '',  '', true );
    wp_enqueue_script('phone', get_template_directory_uri() . '/js/phone.js', '',  '', true );
    wp_enqueue_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', '',  '', true );
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick/slick.js', '',  '', true );
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.js', '',  '', true );
    wp_enqueue_script('jqBootstrapValidation', get_template_directory_uri() . '/js/jqBootstrapValidation.js', '',  '', true );
    wp_enqueue_script('calc', get_template_directory_uri() . '/js/calc.js', '',  '', true );
    wp_enqueue_script('function', get_template_directory_uri() . '/js/functions.js', '',  '', true );

}    
 
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


//  remove default widgets wp 

function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


function ppm_quickstart_ie_compitable_elements(){
    ?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php //var_dump(cs_get_option('favicon')); ?>
    
    <?php if(cs_get_option('favicon')) : ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo wp_get_attachment_image_src(cs_get_option('favicon'), 'thumbnail')[0]; ?>"/>
    <?php endif; ?>
    
    <?php
}
add_action('wp_head', 'ppm_quickstart_ie_compitable_elements'); 

include_once('inc/widgets.php');
include_once('inc/shortcodes.php');
include_once('inc/custom-posts.php');


/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function joints_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="http://htmlbear.ru/" target="_blank">HTMLBEAR</a></span>.', 'jointswp');
}
// adding it to the admin area
add_filter('admin_footer_text', 'joints_custom_admin_footer');


// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT SYSADMIN
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}
//Adds Attachment ID to Media Library admin columns
add_filter('manage_media_columns', 'posts_columns_attachment_id', 1);
add_action('manage_media_custom_column', 'posts_custom_columns_attachment_id', 1, 2);
function posts_columns_attachment_id($defaults){
    $defaults['wps_post_attachments_id'] = __('ID');
    return $defaults;
}
function posts_custom_columns_attachment_id($column_name, $id){
	if($column_name === 'wps_post_attachments_id'){
	echo $id;
    }
}


//Add Plugins link to Admin Bar
function add_wpst_admin_bar_link($wp_admin_bar) {
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_node( array(
	'parent' => 'site-name',
	'id' => 'ab-plugins',
	'title' => 'Plugins',
	'href' => admin_url('plugins.php')
	) );
}
add_action('admin_bar_menu', 'add_wpst_admin_bar_link', 35);


// function for inserting Google Analytics into the wp_footer
add_action('wp_footer', 'ga');
function ga() {
	if ( !is_user_logged_in() ) { // not for logged in users ?>

	<script type="text/javascript">
		var _gaq = _gaq || [];
	  	_gaq.push(['_setAccount', 'UA-XXXXXXXX']); // insert your Google Analytics id here
	  	_gaq.push(['_trackPageview']);
	  	_gaq.push(['_trackPageLoadTime']);
	  	(function() {
	    	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  	})();
	</script>

	<?php
	}
}

