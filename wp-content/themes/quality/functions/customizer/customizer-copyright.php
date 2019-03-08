<?php
// Footer copyright section 
	function quality_copyright_customizer( $wp_customize ) {
	
	$wp_customize->add_section(
        'copyright_section_one',
        array(
            'title' => __('Footer copyright settings','quality'),
            'priority' => 1100,
        )
    );
	
	$wp_customize->add_setting(
    'quality_pro_options[footer_copyright_text]',
    array(
         
		 'default' => '<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="designer">Quality</a> by Webriti', 'quality' ).'</p>',
		 'type' =>'option',
		'sanitize_callback' => 'quality_copyright_sanitize_text',
    )
	
);
$wp_customize->add_control(
    'quality_pro_options[footer_copyright_text]',
    array(
        'label' => __('Copyright text','quality'),
        'section' => 'copyright_section_one',
        'type' => 'textarea',
    ));
}

function quality_copyright_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

}

function quality_copyright_sanitize_html( $input ) {

    return force_balance_tags( $input );

}


add_action( 'customize_register', 'quality_copyright_customizer' );

/**
 * Add selective refresh for Front page section section controls.
 */
function quality_register_home_copy_right_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'quality_pro_options[footer_copyright_text]', array(
		'selector'            => '.qua_footer_area .col-md-12',
		'settings'            => 'quality_pro_options[footer_copyright_text]',
	
	) );

}
add_action( 'customize_register', 'quality_register_home_copy_right_section_partials' );
?>