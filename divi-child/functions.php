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
/************** ENABLE CORS  *****************/

add_filter( 'allowed_http_origins', 'add_allowed_origins' );
function add_allowed_origins( $origins ) {
/* allow origins from ssl and non-ssl addresses */
    $origins[] = 'http://MyWebsite.com';
    $origins[] = 'https://MyWebsite.com';    
/*allow origins from specific supdomain with or without SSL */
    $origins[] = 'http://subdomain.MyWebsite.com';
	$origins[] = 'https://subdomain.MyWebsite.com';
/*allow these specific origins */	
	$origins[] = 'https://reputationdatabase.com';
	$origins[] = 'https://www.youtube-nocookie.com';
	$origins[] = 'https://googleads.g.doubleclick.net/pagead/id';
    return $origins;
}

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
	//Set defaults:
	$title="Charlotte Local Education Foundation, Charlotte County FL";
	$description= "Helping Charlotte County students reach their full potential is what the Education Foundation is all about. We bring resources and people together to support and enhance education for our students. Through financial resources, mentoring, and goal setting, we are helping young leaders improve the world around them and building a stronger community for all of us.";
	$keywords="CLEF,Charlotte Local Education Foundation, Take Stock in Children, Golden Apple Awards, Teacher of the Year, Support Employee of the Year, Mentors, Scholarships,Teacher Supply Depot" ;


/** TITLE **/	
	if(isset($cstmMeta['cejay-title'][0]) && $cstmMeta['cejay-title'][0]!='') 
		{$title=$cstmMeta['cejay-title'][0];}
	elseif(get_the_title())  //fall back to the post title
        {$title=esc_html( get_the_title() );}	

/** DESCRIPTION **/    
if(isset($cstmMeta['cejay-description'][0]) && $cstmMeta['cejay-description'][0] !='') // Use custom meta
		{$description=$cstmMeta['cejay-description'][0];}
	elseif (has_excerpt()) // Use post excerpt if no custom meta
		{$description= strip_tags( get_the_excerpt() );}

/**KEYWORDS**/    
  if($cstmMeta['cejay-keywords'][0]!='')
       {$keywords=$cstmMeta['cejay-keywords'][0];}	
/*** Featured Image for Open Graph Meta **/
	global $post;
    $post_thumbnail_id = get_post_thumbnail_id( $post );
 
    if ( $imageURL=wp_get_attachment_image_url( $post_thumbnail_id, $size ))
		{echo '<meta property="og:image" content="'.$imageURL.'" />';}
	else 
		{echo '<meta property="og:image" content="https://charlotteschoolfoundation.org/wp-content/uploads/2018/10/CLEF-2019Logo2.jpg" />';}
	

	
	echo '<meta name="title" content="'.$title.'" />';
	echo '<meta property="og:title" content="'.$title.'" />';
	echo '<meta name="description" content="'.$description.'" />';
	echo '<meta property="og:description" content="'.$description.'" />';
	echo '<meta name="keywords" content="'.$keywords.'" />';
	

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


/**************** WooCommerce Scripts *****************/
/*put out of stock items at the bottom of search results, respective of current searh paramaters. Exclude for admins */
add_filter( 'woocommerce_get_catalog_ordering_args', 'mihanwp_sort_by_stock', 9999 );
 
function mihanwp_sort_by_stock( $args ) {
	if(is_search()) //disable sort for admins
	{
   $args['orderby'] = 'meta_value';
   $args['order'] = 'ASC';
   $args['meta_key'] = '_stock_status';
   return $args;
	}
}


