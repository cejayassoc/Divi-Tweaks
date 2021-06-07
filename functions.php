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
		{echo '<meta name="description" content="" />';}
/** TITLE **/	
	if($meta_title==$metas['cejay-title']) 
		{echo '<meta name="title" content="'.$meta_title[0].'" />';}
	else  //fall back to the post title
        {echo '<meta name="title" content="'.esc_html( get_the_title() ).'" />';}		
/**KEYWORDS**/    
    if($meta_title==$metas['cejay-keywords'])
        {echo '<meta name="keywords" content="'.$meta_title[0].'" />';}	
    else  //fallback to these keywords
    {echo '<meta name="keywords" content="" />';}

}
add_action( 'wp_head', 'cejay_magic_meta');
