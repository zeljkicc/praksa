<?php

/**
 * A custom WordPress page walker class to implement the Bootstrap 3 navigation
 * style in a custom theme using the WordPress built in menu manager.
 *
 * Version: 0.0.1
 * Author: Two Impulse
 */
class IP_Bootstrap_Page_Walker extends Walker_Page {

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    public function start_el( &$output, $page, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $value = '';

        $classes = array('page_item', 'page-item-'.$page->ID);

        if ( !empty( $id ) ) {
            $_current_page = get_post( $id );
            if ( in_array( $page->ID, $_current_page->ancestors ) )
                $css_class[] = 'current_page_ancestor active';
            if ( $page->ID == $id )
                $classes[] = 'current_page_item active';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $classes[] = 'current_page_parent active';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $classes[] = 'current_page_parent active';
        }

        $class_names = implode( ' ', apply_filters( 'page_css_class', array_filter( $classes ), $page, $depth, $args, $id ) );

        if ( $args['has_children'] )
            $class_names .= ' dropdown';

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = 'menu-item-'. $page->ID;
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $atts = array();
        $atts['title']  = apply_filters( 'the_title', $page->post_title, $page->ID );

        // If item has_children add atts to a.
        if ( $args['has_children'] && $depth === 0 ) {
            $atts['href']   		= '#';
            $atts['data-toggle']	= 'dropdown';
            $atts['class']			= 'dropdown-toggle';
        } else {
            $atts['href'] = get_permalink($page->ID);
        }

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $page_output = $args['before'];

        $page_output .= '<a' . $attributes . '>';
        $page_output .= $args['link_before'] . apply_filters( 'the_title', $page->post_title, $page->ID ) . $args['link_after'];
        $page_output .= ( $args['has_children'] && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
        $page_output .= $args['after'];

        if ( !empty($args['show_date']) ) {
            if ( 'modified' == $args['show_date'] )
                $time = $page->post_modified;
            else
                $time = $page->post_date;

            $page_output .= " " . mysql2date($args['date_format'], $time);
        }

        $output .= $page_output;
    }

}