<?php 
function your_theme_enqueue_styles() 
{
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style,  get_template_directory_uri() . '/style.css'); 
    wp_enqueue_style( 'child-style',       get_stylesheet_directory_uri() . '/style.css',      array($parent_style),       wp_get_theme()->get('Version')    );
}

add_action('wp_enqueue_scripts', 'your_theme_enqueue_styles');


/************** CREATE HELP SECTION, REQUIRES help-template.php *****************/
function help_support() {
	$args = array(
		'labels' => array(
			'name' => __('Help'),
			'singular_name' => __('Help'),
		),
		'public' => true,
		'rewrite' => array("slug" => "help"), 
		'supports' => array('thumbnail','editor','title','custom-fields','excerpt')
	);

	register_post_type( 'help' , $args );
}
add_action('init', 'help_support');

/*Plugin Name: Add Menu Order to Posts
Plugin URI: http://pmg.co/category/wordpress
Description: Adds menu order and template to post types.
Version: n/a
Author: Christopher Davis
Author URI: http://pmg.co/people/chris
*/
add_action( 'init', 'wpse31629_init' );
function wpse31629_init() { add_post_type_support( 'post', 'page-attributes' ); }
/* **************************** Change default WP sender ************************************ 
add_filter('wp_mail_from', 'set_default_from_email');
function set_default_from_email($email){
 if($email == 'wordpress@cchomelesscoalition.org')
 $email = 'DIRECTOR@CCHOMELESSCOALITION.ORG';
 return $email;
}
add_filter('wp_mail_from_name', 'set_default_name');
function set_default_name($name){
 if($name == 'WordPress'){
 $name = 'The Homeless Coaltion';
 }
 return $name;
}
*/

/*function cejay_magic_meta: CREATE META EXCERPT AND TITLE */
/*META DESCRIPTION: Meta description is created from: */
/* 1 - using a custom field called "cejay-description */
/* 2 - using the page or post if #1 is not available */
/* 3 -  uses the default description defined in this function */
/*META TITLE: is created from the custom field called "cejay-title" */
/* or the default title defined in this function is used */

function cejay_magic_meta() {
$metas= get_post_custom(get_the_ID());
	if($meta_description=  $metas['cejay-description']) // 1
		{echo '<meta name="description" content="'.$meta_description[0].'" />';}
	elseif (has_excerpt()) // 2
		{$des_post = strip_tags( get_the_excerpt() );
		echo '<meta name="description" content="'.$des_post.'" />';}
	else //3
		{echo '<meta name="description" content="" />';}
	
	if($meta_title= $metas['cejay-title']) 
		{echo '<meta name="title" content="'.$meta_title[0].'" />';}
	else {echo '<meta name="title" content="'.esc_html( get_the_title() ).'" />';}		
}
add_action( 'wp_head', 'cejay_magic_meta');

/* ************** function to add async and defer attributes ************** */
/*NEVER DEFER OR ASYNC: 'common.js','jquery.js','wp-embed.min.js','functions-init.js','color-picker.min.js',');*/

function defer_js_async($tag){
// 1: list of scripts to defer. (Edit with your script names)
$scripts_to_defer = array('custom.unified.js','woocommerce.min.js','notices.min.js', 'widget.js','recaptcha.js','mediaelement-and-player.min.js','cv.js','jquery-migrate.min.js','wp-embed.min.js','mediaelement-migrate.min.js','wp-mediaelement.min.js','jsapi_compiled_default_module.js','embed.js','search_impl.js','util.js','fbevents.js','identity.js');
// 2: list of scripts to async. (Edit with your script names)
$scripts_to_async = array('es6-promise.auto.min.js', 'recaptcha__en.js','custom.unified.js');
// 3: additional scripts to defer if user can't edit
 $current_user = wp_get_current_user();
 if ( !(current_user_can('edit_posts')) ){
	 array_push($scripts_to_defer,"frontend-builder-global-functions.js", "frontend-builder-scripts.js");
 }
//defer scripts
foreach($scripts_to_defer as $defer_script){
	if(true == strpos($tag, $defer_script ) )
	return str_replace( ' src', ' defer="defer" src', $tag );	
}
//async scripts
foreach($scripts_to_async as $async_script){
	if(true == strpos($tag, $async_script ) )
	return str_replace( ' src', ' async="async" src', $tag );	
}
return $tag;
}
add_filter( 'script_loader_tag', 'defer_js_async', 10 );


