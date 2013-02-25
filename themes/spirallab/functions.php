<?php

// Support the Tuhubnail - http://codex.wordpress.org/Post_Thumbnails
add_theme_support('post-thumbnails');

add_image_size( 'thumb-cartaz', 160, 235, true);
add_image_size( 'full-cartaz', 300, 440, true);

// Format is post - http://codex.wordpress.org/Post_Formats
add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

// Support the background
add_theme_support( 'custom-background', array('default-color' => $default_background_color,));

// Menu - http://codex.wordpress.org/Function_Reference/register_nav_menus
add_theme_support('menus');
register_nav_menus(array(
    'header-menu' => __('Header Menu', 'spirallab'),
    'footer-menu' => __('Footer Menu', 'spirallab')
)); 

// Add 'active' class for menu
function spirallab_active_nav_class( $classes, $item ){
    if($item->current == 1){
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'spirallab_active_nav_class', 10, 2 );

// Extends with output for nav
class spirallab_walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"flyout\">\n";
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) {
            $element->classes[] = 'has-flyout';
        }
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

}

// Summary length
function spirallab_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'spirallab_excerpt_length');

// Link 'Continue Reading'
function spirallab_excerpt_more ( $more ) {
    return '&nbsp; <a href="'. get_permalink().'" class="more">'.'[continue lendo]' . '</a>';
}
add_filter( 'excerpt_more', 'spirallab_excerpt_more' );

// Sidebar
$sidebars = array('Sidebar');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
        'before_widget' => '<article id="%1$s" class="row widget %2$s"><div class="sidebar-section twelve columns">',
        'after_widget' => '</div></article>',
        'before_title' => '<h6><strong>',
        'after_title' => '</strong></h6>'
    ));
}

// Scripts
function spirallab_scripts() {     
    wp_enqueue_script('jquery');
    wp_enqueue_script('foundation', get_bloginfo('template_directory'). '/scripts/foundation.min.js', array(), '1.0', true);
    wp_enqueue_script('app', get_bloginfo('template_directory'). '/scripts/app.js', array('foundation'), '1.0', true); 
    wp_enqueue_script('saw', 'http://sawpf.com/1.0.js', array('app'), '1.0', true);
}  
add_action('wp_enqueue_scripts', 'spirallab_scripts');

// Pagination
function spirallab_pagination() {
    global $wp_query;
    $big = 999999999;

    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'prev_next' => true,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'list'
        )
    );
    $pagination = str_replace('page-numbers', 'pagination', $links);
    echo $pagination;
}
    

// Custom Post Type - Includes
include ('custom/filme.php');


// Admin
function spirallab_widget_admin() {
    echo '<ul><li><a href="http://www.spirallab.com.br" target="_blank">
    <img style="float: left; max-width: 260px; margin-right: 15px;" src="'.get_bloginfo('template_directory').'/admin/spirallab.png" /></a></li>
    <li>(51) xxxx.xxxx</li>
    <li>(51) 8205.5187</li>
    <li>falecom@spirallab.com.br</li></ul>';
}

function spirallab_add_widget_widgets() {
    wp_add_dashboard_widget('wp_dashboard_widget', 'Spirallab - Soluções Criativas para a Web', 'spirallab_widget_admin');
}
add_action('wp_dashboard_setup', 'spirallab_add_widget_widgets' );

function spirallab_login_url( $url ) {
    return get_bloginfo('url');
}
add_filter( 'login_headerurl', 'spirallab_login_url' );

function spirallab_login_admin() { 
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/admin/login.css" />'; 
}
add_action('login_head', 'spirallab_login_admin');

function spirallab_footer_admin () {
    echo 'Desenvolvido por <a href="http://www.spirallab.com.br" target="_blank">Spirallab - Soluções Criativas para a Web</a></p>';
}
add_filter('admin_footer_text', 'spirallab_footer_admin');