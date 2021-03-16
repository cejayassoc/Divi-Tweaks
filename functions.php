
/***function cejay_magic_meta ***/
/* Programatically add meta tags for description, title and keywoards: */
/* META DESCRIPTION: Use the excerpt to create the meat description */
/*  if there is no excerpt, - using the custom field called "cejay-description */
/*  if neither exist, use default description */
/* META TITLE: is created from the custom field called "cejay-title" */
/* if no custom field is defiend, the default title is used*/
/* META TITLE: is created from the custom field called "keywords" */
/* is custom field is not defined, default is used */

function cejay_magic_meta() {
$metas= get_post_custom(get_the_ID());
	if($meta_description=  $metas['cejay-description']) 
		{echo '<meta name="description" content="'.$meta_description[0].'" />';}
	elseif (has_excerpt()) 
		{$des_post = strip_tags( get_the_excerpt() );
		echo '<meta name="description" content="'.$des_post.'" />';}
	else //3
		{echo '<meta name="description" content="DEFAULT META DESCRIPTION HERE" />';}
	
	if($meta_title= $metas['cejay-title']) 
	   {echo '<meta name="title" content="'.$meta_title[0].'" />';}
	else 
	   { echo '<meta name="title" content="DEFAULT TITLE HERE" />';}	
    
    if($meta_title= $metas['keywords'])
		{echo '<meta name="keywords" content="'.$meta_title[0].'" />';}
    else 
		{echo '<meta name="keywords" content="DEFAULT META HERE" />';}
}
add_action( 'wp_head', 'cejay_magic_meta');
