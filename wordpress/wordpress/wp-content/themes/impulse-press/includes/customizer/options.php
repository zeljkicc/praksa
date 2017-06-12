<?php

function impulse_press_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'impulse_press_options',
        array(
            'title' => __( 'Theme Options', 'impulse-press' ),
            'description' => __( 'These are the Impulse Press options', 'impulse-press' ),
            'capability'  => 'edit_theme_options',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting( 'impulse_press_logo',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'impulse_press_logo',
            array(
                'label'      => __( 'Logo. (Recommended 300x80 pixels)', 'impulse-press' ),
                'section'    => 'impulse_press_options',
            )
        )
    );

    $wp_customize->add_setting( 'impulse_press_copyright',
        array(
            'default' => '',
            'sanitize_callback' => 'impulse_press_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'impulse_press_copyright',
        array(
            'label' => 'Copyright text',
            'section' => 'impulse_press_options',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting( 'impulse_press_powered',
            array(
                'default' => '',
                'sanitize_callback' => 'impulse_press_sanitize_text',
            )
        );

        $wp_customize->add_control(
            'impulse_press_powered',
            array(
                'label' => 'Powered By text',
                'section' => 'impulse_press_options',
                'type' => 'text',
            )
        );



}
add_action( 'customize_register', 'impulse_press_customizer' );


function impulse_press_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
