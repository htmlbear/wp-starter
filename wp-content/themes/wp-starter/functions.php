<?php 

add_theme_support('thumbnails' );
add_theme_support('menus' );

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


