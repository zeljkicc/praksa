<?php
/**
 * ImpulsePress Framework functions and definitions.
  */

 /*
 * load the include files
 */

/*require_once (get_template_directory() . '/includes/admin/index.php');*/
require_once( get_template_directory() . '/includes/wp_bootstrap_navwalker.php');
require_once ( get_template_directory().'/includes/tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/includes/plugins.php');
require_once( get_template_directory() . '/includes/customizer/options.php');
require_once( get_template_directory() . '/includes/class-ip-bootstrap-page-walker.php');



add_action( 'wp_enqueue_scripts', 'impulse_press_register_styles' );
add_action( 'wp_enqueue_scripts', 'impulse_press_register_scripts' );
add_action('widgets_init', 'impulse_press_widgets_init');
add_action( 'wp_enqueue_scripts', 'impulse_press_enqueue_comment_reply' );
add_filter('widget_text', 'do_shortcode');
add_action( 'tgmpa_register', 'impulse_press_register_required_plugins' );
add_action('after_setup_theme', 'impulse_press_setup');

function impulse_press_setup() {

     global $content_width;
     if (!isset($content_width)) {
         $content_width = 550;
     }


    $args = array(
	    'default-image' => get_template_directory_uri() . '/images/logo.png',
        'uploads'       => true
    );
    add_theme_support('automatic-feed-links');
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 450, 300, true );
    register_nav_menu( 'top-menu', 'Top Menu' );
    register_nav_menu( 'footer-menu', 'Footer Menu' );

}

/**
 * A comment reply.
 */
function impulse_press_enqueue_comment_reply() {
if ( is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}


/*
 * Shortcodes initialization
 */
function impulse_press_admin_inline_js(){
    $url = get_template_directory_uri() . '/includes/shortcodes/';
    echo "<script type='text/javascript'>\n";
    echo 'var shortcode_url = "'.$url .'"';
    echo "\n</script>";
}

/*
 * Register the JavaScript libraries
 */
function impulse_press_register_scripts()
{

	// Register the scripts for this theme:
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ),null, false );
    wp_register_script( 'placeholder', get_template_directory_uri() . '/js/holder.js', array( 'jquery' ),null, false );
    wp_register_script( 'scroll', get_template_directory_uri() . '/js/scroll.js', array( 'jquery' ),null, false );
    wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ),null, false );
    wp_register_script( 'validate-js', get_template_directory_uri() . '/js/jquery.validate.min.js', array( 'jquery' ),null, false );
    wp_register_script( 'validate', get_template_directory_uri() . '/js/validate.js', array( 'jquery' ),null, false );
    wp_register_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ),null, false );



	//  enqueue the scripts
	wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'placeholder' );
    wp_enqueue_script( 'scroll' );
    wp_enqueue_script( 'easing' );
    wp_enqueue_script( 'validate-js' );
    wp_enqueue_script( 'validate' );
    wp_enqueue_script( 'respond' );

}


/*
 * Register stylesheets
 */
function impulse_press_register_styles()
{
	// Register the styles
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null, 'all' );
    wp_register_style( 'impulse-press', get_template_directory_uri() . '/css/impulse-press.css', array(), null, 'all' );
    wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), null, 'all' );

	//  enqueue the styles
	wp_enqueue_style('bootstrap' );
    wp_enqueue_style('impulse-press');
    wp_enqueue_style('font-awesome');


}





/**
 *  Sidebar Widgets
 */
function impulse_press_widgets_init()
{


         /* The Hero Unit Simple */
      register_sidebar(array(
          'name' => __('Hero Unit Simple', 'impulse-press'),
          'description' => __('Hero Unit Simple', 'impulse-press'),
          'id' => 'hero-simple',
          'before_title' => '<div class="widget-title">',
          'after_title' => '</div>',
          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
          'after_widget' => '</div>'
     ));

       /* The Hero Unit Large */
      register_sidebar(array(
          'name' => __('Hero Unit Large', 'impulse-press'),
          'description' => __('Hero Unit Large', 'impulse-press'),
          'id' => 'hero-large',
          'before_title' => '<div class="widget-title">',
          'after_title' => '</div>',
          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
          'after_widget' => '</div>'
     ));

    /* The Hero Lading  */
    register_sidebar(array(
        'name' => __('Hero Landing', 'impulse-press'),
        'description' => __('Hero Landing', 'impulse-press'),
        'id' => 'hero-landing',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>',
        'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
        'after_widget' => '</div>'
    ));

    /* The Home Featurette One*/
      register_sidebar(array(
          'name' => __('Home Featurette One', 'impulse-press'),
          'description' => __('Home Featurette One', 'impulse-press'),
          'id' => 'home-featurette-1',
          'before_title' => '<div class="widget-title">',
          'after_title' => '</div>',
          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
          'after_widget' => '</div>'
     ));


    /* The Home Featurette Two*/
      register_sidebar(array(
          'name' => __('Home Featurette Two', 'impulse-press'),
          'description' => __('Hero Featurette Two', 'impulse-press'),
          'id' => 'home-featurette-2',
          'before_title' => '<div class="widget-title">',
          'after_title' => '</div>',
          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
          'after_widget' => '</div>'
     ));

    //* The Home Featurette Three*/
      register_sidebar(array(
          'name' => __('Home Featurette Three', 'impulse-press'),
          'description' => __('Home Featurette Three', 'impulse-press'),
          'id' => 'home-featurette-3',
          'before_title' => '<div class="widget-title">',
          'after_title' => '</div>',
          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
          'after_widget' => '</div>'
     ));



    /* The 3 widgets for the main page, below the heroe unit */
    register_sidebar(array(
                          'name' => __('Main One', 'impulse-press'),
                          'description' => __('Main One', 'impulse-press'),
                          'id' => 'main-1',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

    register_sidebar(array(
                          'name' => __('Main Two', 'impulse-press'),
                          'description' => __('Main Two', 'impulse-press'),
                          'id' => 'main-2',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

    register_sidebar(array(
                          'name' => __('Main Three', 'impulse-press'),
                          'description' => __('Main Three', 'impulse-press'),
                          'id' => 'main-3',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));


    /* left and right sidebar */
    register_sidebar(array(
                          'name' => 'Sidebar Left',
                          'description' => 'Sidebar Left',
                          'id' => 'sidebar-left',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));

	register_sidebar(array(
                          'name' => 'Sidebar Right' ,
                          'description' => 'Sidebar Right',
                          'id' => 'sidebar-right',
                          'before_title' => '<div class="widget-title">',
                          'after_title' => '</div>',
                          'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                          'after_widget' => '</div>'
                     ));


}

/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Courtesy of Dimox
 *
 * bbPress compatibility patch by Dan Smith
 */
function impulse_press_breadcrumb_lists() {

        $chevron = '<span class="divider">/</span>';
        $name = __('Home','impulse-press'); //text for the 'Home' link
        $currentBefore = '<li class="active">';
        $currentAfter = '</li>';

        echo '<ul class="breadcrumb">';

        global $post;
        $home = esc_url( home_url() );
        echo '<li><a href="' . $home . '">' . $name . '</a></li>';

        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo(get_category_parents($parentCat, TRUE, ''));
            echo $currentBefore . 'Archive by category &#39;';
            single_cat_title();
            echo '&#39;' . $currentAfter;
        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $chevron . '</li>  ';
            echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ';
            echo $currentBefore . get_the_time('d') . $currentAfter;
        } elseif (is_month()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
            echo $currentBefore . get_the_time('F') . $currentAfter;
        } elseif (is_year()) {
            echo $currentBefore . get_the_time('Y') . $currentAfter;
        } elseif (is_single()) {
            $pid = $post->ID;
            $pdata = get_the_category($pid);
            $adata = get_post($pid);
            if(!empty($pdata)){
                echo '<li>' .get_category_parents($pdata[0]->cat_ID, TRUE, ' '). '</li> ';
                echo $currentBefore;
            }
            echo $adata->post_title;
            echo $currentAfter;
        } elseif (is_page() && !$post->post_parent) {
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumb_lists = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumb_lists[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumb_lists = array_reverse($breadcrumb_lists);
            foreach ($breadcrumb_lists as $crumb)
                echo $crumb . ' ' . $chevron . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_search()) {
            echo $currentBefore . __('Search results for &#39;','impulse-press') . get_search_query() . __('&#39;','impulse-press') . $currentAfter;
        } elseif (is_tag()) {
            echo $currentBefore . __('Posts tagged &#39;','impulse-press');
            single_tag_title();
            echo '&#39;' . $currentAfter;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $currentBefore . __('Articles posted by ','impulse-press') . $userdata->display_name . $currentAfter;
        } elseif (is_404()) {
            echo $currentBefore . __('Error 404','impulse-press') . $currentAfter;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo __('Page','impulse-press') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</ul>';
}


/**
 * ImpulsePress Page Menu generator
 * @param array $args options
 */
function impulse_press_page_menu( $args = array() ) {
    $defaults = array(
        'sort_column' => 'menu_order, post_title',
        'menu_class' => 'menu',
        'container' => 'div',
        'echo' => true,
        'link_before' => '',
        'link_after' => '',
    );
    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'wp_page_menu_args', $args );

    $menu = '';

    $list_args = $args;

    // Show Home in the menu
    if ( ! empty($args['show_home']) ) {
        if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
            $text = __('Home','impulse-press');
        else
            $text = $args['show_home'];
        $class = '';
        if ( is_front_page() && !is_paged() )
            $class = 'class="current_page_item"';
        $menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
        // If the front page is a page, add it to the exclude list
        if (get_option('show_on_front') == 'page') {
            if ( !empty( $list_args['exclude'] ) ) {
                $list_args['exclude'] .= ',';
            } else {
                $list_args['exclude'] = '';
            }
            $list_args['exclude'] .= get_option('page_on_front');
        }
    }

    $list_args['echo'] = false;
    $list_args['title_li'] = '';
    $menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

    if ( $menu ) {
        $menu = '<ul class="' . esc_attr($args['menu_class']) . '">' . $menu . '</ul>';
    }

    if ( $args['container'] && in_array( $args['container'], array( 'nav', 'div' ) ) ) {
        $tag = $args['container'];
        $menu = '<' . $tag . ' class="' . esc_attr($args['menu_class']) . '">' . $menu . "</' . $tag . '>\n";
    }

    $menu = apply_filters( 'wp_page_menu', $menu, $args );

    if ( $args['echo'] )
        echo $menu;
    else
        return $menu;
}

function impulse_press_set_title( $title, $sep, $seplocation ) {
    $sitename = get_bloginfo( 'name' );
    if ( preg_match( "/(\\s|^)$sitename(\\s|$)/", $title ) === 0 ) {
        if ( $seplocation == 'right' )
            return $title . '  '. $sitename;
        else
            return $sitename . '  ' .  $title;
    }
    return $title;
}

add_filter('wp_title', 'impulse_press_set_title', 30, 3);


function impulse_press_options($id, $fallback = false) {
    if ( $fallback == false ) $fallback = '';
    return get_theme_mod($id);
}