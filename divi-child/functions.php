<?php 
function your_theme_enqueue_styles() 
{
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style,  get_template_directory_uri() . '/style.css'); 
    wp_enqueue_style( 'child-style',       get_stylesheet_directory_uri() . '/style.css',      array($parent_style),       wp_get_theme()->get('Version')    );
}
add_action('wp_enqueue_scripts', 'your_theme_enqueue_styles');

/***** Disable Automatic Sitemap ****/
add_filter('wp_sitemaps_enabled', '__return_false');


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

/* **************************** Change default WP sender ************************************ 
add_filter('wp_mail_from', 'set_default_from_email');
function set_default_from_email($email){
 if($email == 'wordpress@[domain]')
 $email = '[user]@[domain]';
 return $email;
}
add_filter('wp_mail_from_name', 'set_default_name');
function set_default_name($name){
 if($name == 'WordPress'){
 $name = '[Organization Name]';
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
/*META KEYWORDS: is created from the custom field called "cejay-keywords" */
/* or the default title keyword set in this function is used */


function cejay_magic_meta() {
$metas= get_post_custom(get_the_ID());
/** DESCRIPTION **/    
	if($meta_description==$metas['cejay-description']) // Use custom meta
		{echo '<meta name="description" content="'.$meta_description[0].'" />';}
	elseif (has_excerpt()) // Use post excerpt if no custom meta
		{$des_post = strip_tags( get_the_excerpt() );
		echo '<meta name="description" content="'.$des_post.'" />';}
	else // Fallback to this description
		{echo '<meta name="description" content="[fallback description here]" />';}
/** TITLE **/	
	if($meta_title==$metas['cejay-title']) 
		{echo '<meta name="title" content="'.$meta_title[0].'" />';}
	else  //fall back to the post title
        {echo '<meta name="title" content="'.esc_html( get_the_title() ).'" />';}		
/**KEYWORDS**/    
    if($meta_title==$metas['cejay-keywords'])
        {echo '<meta name="keywords" content="'.$meta_title[0].'" />';}	
    else  //fallback to these keywords
    {echo '<meta name="keywords" content="[fallback keywords here]" />';}

}
add_action( 'wp_head', 'cejay_magic_meta');


/* ************** function to add async and defer attributes for Divi Theme ************** */
/*NEVER DEFER OR ASYNC: 'common.js','jquery.js','wp-embed.min.js','functions-init.js','color-picker.min.js','notices.min.js');*/

function defer_js_async($tag){
// 1: list of scripts to defer. (Edit with your script names)
$scripts_to_defer = array('custom.unified.js','widget.js','recaptcha.js','mediaelement-and-player.min.js','cv.js','jquery-migrate.min.js','wp-embed.min.js','mediaelement-migrate.min.js','wp-mediaelement.min.js','waypoints.min.js','jquery.mobile.custom.min.js','smoothscroll.js','scripts.min.js','cvpro.min.js','jsapi_compiled_default_module.js','embed.js','search_impl.js','util.js','fbevents.js','identity.js');
// 2: list of scripts to async. (Edit with your script names)
$scripts_to_async = array( 'recaptcha__en.js','custom.unified.js','jquery.js','custom.js','jquery.magnific-popup.js','et_shortcodes_frontend.js','frontend-builder-global-functions.js','jquery.fitvids.js');
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


