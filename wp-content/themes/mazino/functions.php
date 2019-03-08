<?php
add_action( 'wp_enqueue_scripts', 'mazino_theme_css',999);
function mazino_theme_css() {
    wp_enqueue_style( 'mazino-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('bootstrap', QUALITY_TEMPLATE_DIR_URI . '/css/bootstrap.css');
	wp_enqueue_style('theme-menu', QUALITY_TEMPLATE_DIR_URI . '/css/theme-menu.css');
    wp_enqueue_style( 'mazino-child-style',get_stylesheet_directory_uri() . '/style.css',array('parent-style'));
	wp_enqueue_script('mazino-mp-masonry-js', get_stylesheet_directory_uri() . '/js/masonry/mp.mansory.js');
}


add_action( 'after_setup_theme', 'mazino_setup' );
function mazino_setup()
{	
	//Load text domain for translation-ready
load_theme_textdomain( 'mazino', get_stylesheet_directory() . '/languages' );

require( get_stylesheet_directory() . '/functions/customizer/customizer-copyright.php' );
}

// Read more tag to formatting in blog page 
  	function mazino_new_content_more($more)
	{  global $post;
		return '<div class="blog-btn-col"><a href="' . get_permalink() . "#more-{$post->ID}\" class=\"more-link\">Read More</a></div>";
	}   
	add_filter( 'the_content_more_link', 'mazino_new_content_more' );
	
	
function mazino_child_theme_setup() {
    remove_filter( 'the_content_more_link', 'mazino_new_content_more' );
    add_filter( 'the_content_more_link', 'mazino_new_content_more' );
	
		if ( is_admin() ) {
           require get_stylesheet_directory() . '/admin/admin-init.php';
       }
}

add_action( 'after_setup_theme', 'mazino_child_theme_setup' );

// footer custom script
function mazino_footer_custom_script()
{
?>
<script>
jQuery(document).ready(function ( jQuery ) {
	jQuery("#blog-masonry").mpmansory(
		{
			childrenClass: 'item', // default is a div
			columnClasses: 'padding', //add classes to items
			breakpoints:{
				lg: 4, //Change masonry column here like 2, 3, 4 column
				md: 6, 
				sm: 6,
				xs: 12
			},
			distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
			onload: function (items) {
				//make somthing with items
			} 
		}
	);
});
</script>
<?php
}
add_action('wp_footer','mazino_footer_custom_script');


function mazino_default_data(){
	return array(
	// general settings
	'footer_copyright_text' => '<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="designer">Mazino</a> by Webriti', 'mazino' ).'</p>',
	);
}

add_action( 'customize_register', 'mazino_remove_custom', 1000 );
function mazino_remove_custom($wp_customize) {
 $wp_customize->remove_section( 'theme_color' );
}
?>