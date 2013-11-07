<?php
/**
 * geobiota functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, geobiota_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage geobiota
 * @since geobiota 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run geobiota_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'geobiota_setup' );

if ( ! function_exists( 'geobiota_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override geobiota_setup() in a child theme, add your own geobiota_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function geobiota_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// Create Theme Logotype Options Page
    require_once ( get_template_directory() . '/theme-admin/theme-options.php' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'geobiota', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'geobiota' ),
	) );
	
	


	// This theme allows users to set a custom background
	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) ) 
     	add_theme_support( 'custom-background' ); 
    else
	add_custom_background( $args );
	
	// This theme allows users to set a custom header
	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) )
		add_theme_support( 'custom-header' );
	else
		add_custom_image_header( $args );
		
	$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/headers/header_01.jpg',
	'random-default'         => false,
	'width'                  => 970,
	'height'                 => 220,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );


	}
endif;

if ( ! function_exists( 'geobiota_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in geobiota_setup().
 *
 * @since Twenty Ten 1.0
 */
function geobiota_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function geobiota_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'geobiota' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'geobiota' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'geobiota' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'geobiota_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function geobiota_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'geobiota_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function geobiota_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'geobiota_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function geobiota_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class=\"meta-nav\">&rarr;</span>', 'geobiota' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and geobiota_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function geobiota_auto_excerpt_more( $more ) {
	return ' &hellip;' . geobiota_continue_reading_link();
}
add_filter( 'excerpt_more', 'geobiota_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function geobiota_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= geobiota_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'geobiota_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function geobiota_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'geobiota_remove_gallery_css' );

if ( ! function_exists( 'geobiota_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own geobiota_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function geobiota_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">dice:</span>', 'geobiota' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'geobiota' ); ?></em>
				<br />
			<?php endif; ?>
			<footer class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'geobiota' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'geobiota' ), ' ' );
				?>
			</footer><!-- .comment-meta .commentmetadata -->
			<div class="comment-body"><?php comment_text(); ?></div>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-##  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'geobiota' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'geobiota'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override geobiota_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function geobiota_widgets_init() {

	// Area 1, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'geobiota' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer', 'geobiota' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'geobiota' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer', 'geobiota' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'geobiota' ),
		'id' => 'three-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer', 'geobiota' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Area Four', 'geobiota' ),
		'id' => 'four-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer', 'geobiota' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

}
/** Register sidebars by running geobiota_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'geobiota_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function geobiota_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'geobiota_remove_recent_comments_style' );

if ( ! function_exists( 'geobiota_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function geobiota_posted_on() {
	// BP: slight modification to Twenty Ten function, converting single permalink to multi-archival link
	// Y = 2012
	// F = September
	// m = 01–12
	// j = 1–31
	// d = 01–31
printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'geobiota' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'geobiota' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists( 'geobiota_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function geobiota_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s.', 'geobiota' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s.', 'geobiota' );
	} else {
		$posted_in = __( 'Bookmark the <a href="/%3$s/" rel="bookmark">permalink</a>.', 'geobiota' );
	}

	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/**
********************* GENERAL OPTIONS*****************
*/
require_once(TEMPLATEPATH . '/theme-admin/general-options.php');


function geobiota_complete_version_removal() {
	return '';
}
add_filter('the_generator', 'geobiota_complete_version_removal');


/**
********************* SEARCH*****************
*/
function geobiota_search_form ( $form ) {
$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
<input type="search" placeholder="Search for..." value="' . get_search_query() . '" name="s" id="s" />
<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
</div>
</form>';
return $form;
}
add_filter( 'get_search_form', 'geobiota_search_form' );

/**
********************* THUMBNAILS IN POST*****************
*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

/**
********************* EXCERPT IN PAGES*****************
*/
add_post_type_support( 'page', 'excerpt');


/**
********************* ADD SCRIPT and CSS*****************
*/

function my_scripts_method() {
	wp_enqueue_script(
		'custom-js',
		get_template_directory_uri() . '/js/custom-js.js', false );
}

add_action( 'admin_enqueue_scripts', 'my_scripts_method' );

// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
function custom_table() {
   echo '<style type="text/css">
          .mceEditor table.mceLayout {background:white;border: 1px solid #dfdfdf !important; }

         </style>';
}

add_action('admin_head', 'custom_table');

/**
********************* CUSTOM META FIELDS PAGES*****************
*/
// Add the Meta Box
function add_custom_meta_box() {
    add_meta_box(
		'custom_meta_box', // $id
		'Contenido adicional', // $title
		'show_custom_meta_box', // $callback
		'page', // $page
		'normal', // $context
		'default'); // $priority
}

add_action('add_meta_boxes', 'add_custom_meta_box');
add_action('save_post', 'save_custom_meta_one');  

// Field Array
$prefix = 'custom_';
$custom_meta_fields = array(
	array(
		'label'=> 'Columna Derecha',
		'desc'	=> 'Agregar texto columna derecha.',
		'id'	=> $prefix.'left',
		'type'	=> 'textareatiny'
	),
	array(
		'label'=> 'Columna Central',
		'desc'	=> 'Agregar texto columna central.',
		'id'	=> $prefix.'center',
		'type'	=> 'textareatiny'
	),
	array(
		'label'=> 'Columna Izquierda',
		'desc'	=> 'Agregar texto columna izquierda.',
		'id'	=> $prefix.'right',
		'type'	=> 'textareatiny'
	),
	array(
		'label'=> 'Columna Izquierda',
		'desc'	=> 'Agregar texto columna izquierda.',
		'id'	=> $prefix.'thum',
		'type'	=> 'supertextareatiny'
	)
);

// The Callback
function show_custom_meta_box() {
	global $custom_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
		// Begin the field table and loop
		echo '<div class="form-table">';
		foreach ($custom_meta_fields as $field) {
			// get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, $field['id'], true);
			// begin a table row with
			echo '<div style="padding:20px 20px; 10px">
					<span><label style="font-size:14px;" for="'.$field['id'].'">'.$field['label'].'</label><br />
					<span class="description">'.$field['desc'].'</span><br /><br />';
					switch($field['type']) {
					
					// text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
							<br /><span class="description">'.$field['desc'].'</span>';
					break;						
					
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
							<br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					// textarea tiny MCE
					case 'textareatiny':
						echo '<textarea class="textareaID" name="'.$field['id'].'" id="'.$field['id'].'">'.wpautop($meta).'</textarea><br />';
					break;
					
					// textarea tiny MCE
					case 'supertextareatiny':
						echo '<textarea class="textareaID custom_preview_image" name="'.$field['id'].'" id="'.$field['id'].'">'.$meta.'</textarea><br />';
						
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }   
						
						echo '<input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
						
					             <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small> 
					            <br clear="all" /><span class="description">'.$field['desc'].'';  
					break;
					
					// checkbox  
					case 'checkbox':  
					    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
					        <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
					break; 
					
					// image  
					case 'image':  
					$image = get_template_directory_uri().'/images/image-add.jpg';    
					echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';  
					if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }                 
					echo    '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" /> 
					        <img src="'.$image.'" class="custom_preview_image" alt="" /><br /> 
					            <input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
					             <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small> 
					            <br clear="all" /><span class="description">'.$field['desc'].'';  
					break;  
					
					// select
					case 'select':
					echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
					foreach ($field['options'] as $option) {
						echo '<option', $meta == $option['value'] ? ' selected=""' : '', ' value="'.$option['value'].'">'.			$option['label'].'</option>';
					}
					echo '</select><br /><span class="description">'.$field['desc'].'</span>';
					break;

					
					} //end switch
			echo '</span></div>';
		} // end foreach
		echo '</div>'; // end table	
}


// Save the Data
function save_custom_meta_one ($post_id) {
    global $custom_meta_fields;
	// verify nonce
	if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('post' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)){
			return $post_id;}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}
	// loop through fields and save the data
	foreach ($custom_meta_fields as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		update_post_meta($post_id, $field['id'], $new);
	} // end foreach
}



/**
********************* CUSTOM FIELDS IN PAGE FOR FRONT PAGE*****************
*/
function add_custom_meta_box_frontpage() {
    add_meta_box(
		'custom_meta_box_frontpage', // $id
		'Publicar en Página de Inicio', // $title
		'show_custom_meta_box_frontpage', // $callback
		'page', // $page
		'side', // $context
		'default'); // $priority
}

add_action('add_meta_boxes', 'add_custom_meta_box_frontpage');
add_action('save_post', 'save_custom_meta');  

// Field Array
$prefix = 'custom_';
$custom_meta_fields_two = array(
	array(
		'label'=> 'Habilitar esta opción para mostrar en página de inicio:',
		'desc'	=> 'Contenido Destacado',
		'id'	=> $prefix.'featured_page',
		'type'	=> 'checkbox'
	)
);

// The Callback
function show_custom_meta_box_frontpage() {
	global $custom_meta_fields_two, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
		// Begin the field table and loop
		echo '<div class="form-table">';
		foreach ($custom_meta_fields_two as $field) {
			// get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, $field['id'], true);
			// begin a table row with
			echo '<div class="inside" style="margin-top:10px;">
          <span id="timestamp"><label style="font-size:13px;" for="'.$field['id'].'">'.$field['label'].'</label><br/><br/>';
					switch($field['type']) {
										
					// checkbox  
					case 'checkbox':  
					    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
					        <label for="'.$field['id'].'">'.$field['desc'].'</label><br/><br/>';  
					break; 
					
					} //end switch
			echo '</span></div>';
		} // end foreach
		echo '</div>'; // end table	
}


// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields_two;
	// verify nonce
	if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('post' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)){
			return $post_id;}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}
	// loop through fields and save the data
	foreach ($custom_meta_fields_two as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		update_post_meta($post_id, $field['id'], $new);
	} // end foreach
}

?>