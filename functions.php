<?php


function theme_styles() {

	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function theme_js() {

	global $wp_scripts;

	wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );
	wp_register_script( 'respond_js', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );

	$wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' );
	$wp_scripts->add_data( 'respond_js', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'bio_js', get_template_directory_uri() . '/bio.js', '', '', false );

}
add_action( 'wp_enqueue_scripts', 'theme_js' );

// if ( ! current_user_can( 'edit-posts' ) ) {
//     add_filter( 'show_admin_bar', '__return_false' );
// }

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' ); 

function register_theme_menus() {
	register_nav_menus(
		array(
			'header-menu'	=> __( 'Header Menu' )
		)
	);
}
add_action( 'init', 'register_theme_menus' );


function create_widget( $name, $id, $description ) {

	register_sidebar(array(
		'name' => __( $name ),	 
		'id' => $id, 
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

}

create_widget( 'Front Page Left', 'front-left', 'Displays on the left of the homepage' );
create_widget( 'Front Page Center', 'front-center', 'Displays in the center of the homepage' );
create_widget( 'Front Page Right', 'front-right', 'Displays on the right of the homepage' );


create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar' );
create_widget( 'Blog Sidebar', 'blog', 'Displays on the side of pages in the blog section' );
create_widget( 'Goat Gallery', 'goat_gal', 'Displays on Single Goat page, under main image');

add_image_size( 'caprathumb', 288, 9999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

// add_filter('pre_get_posts', 'query_post_type');
// function query_post_type($query) {
//   if(is_category() || is_tag()) {
//     $post_type = get_query_var('post_type');
// 	if($post_type)
// 	    $post_type = $post_type;
// 	else
// 	    $post_type = array('post','review');
//     $query->set('post_type',$post_type);
// 	return $query;
//     }
// }



function capra_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
		?>
	</div>
	<div class="comment-author vcard">
<!-- 	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?> -->

	<?php printf( __( '<cite class="fn" style="opacity: 0.6">%s:</cite>' ), get_comment_author_link() ); 
	?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
		<br />
	<?php endif; ?>


	<div class="comment-content">
	<?php comment_text(); ?>
	

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '• Reply' ) ) ); ?>
	</div>
	</div>
	<br>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

function mytheme_setup() {
	// Set default values for the upload media box
	update_option('image_default_align', 'center' );
	update_option('image_default_link_type', 'media' );

}
add_action('after_setup_theme', 'mytheme_setup');

// Custom filter function to modify default gallery shortcode output
// function my_post_gallery( $output, $attr ) {
 
// 	// Initialize
// 	global $post, $wp_locale;
 
// 	// Gallery instance counter
// 	static $instance = 0;
// 	$instance++;
 
// 	// Validate the author's orderby attribute
// 	if ( isset( $attr['orderby'] ) ) {
// 		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
// 		if ( ! $attr['orderby'] ) unset( $attr['orderby'] );
// 	}
 
// 	// Get attributes from shortcode
// 	extract( shortcode_atts( array(
// 		'order'      => 'ASC',
// 		'orderby'    => 'menu_order ID',
// 		'id'         => $post->ID,
// 		'itemtag'    => 'dl',
// 		'icontag'    => 'dt',
// 		'captiontag' => 'dd',
// 		'columns'    => 3,
// 		'size'       => 'thumbnail',
// 		'include'    => '',
// 		'exclude'    => ''
// 	), $attr ) );
 
// 	// Initialize
// 	$id = intval( $id );
// 	$attachments = array();
// 	if ( $order == 'RAND' ) $orderby = 'none';
 
// 	if ( ! empty( $include ) ) {
 
// 		// Include attribute is present
// 		$include = preg_replace( '/[^0-9,]+/', '', $include );
// 		$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
 
// 		// Setup attachments array
// 		foreach ( $_attachments as $key => $val ) {
// 			$attachments[ $val->ID ] = $_attachments[ $key ];
// 		}
 
// 	} else if ( ! empty( $exclude ) ) {
 
// 		// Exclude attribute is present 
// 		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
 
// 		// Setup attachments array
// 		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
// 	} else {
// 		// Setup attachments array
// 		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
// 	}
 
// 	if ( empty( $attachments ) ) return '';
 
// 	// Filter gallery differently for feeds
// 	if ( is_feed() ) {
// 		$output = "\n";
// 		foreach ( $attachments as $att_id => $attachment ) $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
// 		return $output;
// 	}
 
// 	// Filter tags and attributes
// 	$itemtag = tag_escape( $itemtag );
// 	$captiontag = tag_escape( $captiontag );
// 	$columns = intval( $columns );
// 	$itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
// 	$float = is_rtl() ? 'right' : 'left';
// 	$selector = "gallery-{$instance}";
 
// 	// Filter gallery CSS
// 	$output = apply_filters( 'gallery_style', "
// 		<style type='text/css'>
// 			#{$selector} {
// 				margin: auto;
// 			}
// 			#{$selector} .gallery-item {
// 				float: {$float};
// 				margin-top: 10px;
// 				text-align: center;
// 				width: {$itemwidth}%;
// 			}
// 			#{$selector} img {
// 				border: 0px solid #cfcfcf;
// 			}
// 			#{$selector} .gallery-caption {
// 				margin-left: 0;
// 			}
// 		</style>
// 		<!-- see gallery_shortcode() in wp-includes/media.php -->
// 		<div id='$selector' class='gallery galleryid-{$id}'>"
// 	);
 
// 	// Iterate through the attachments in this gallery instance
// 	$i = 0;
// 	foreach ( $attachments as $id => $attachment ) {
 
// 		// Attachment link
// 		$link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false ); 
 
// 		// Start itemtag
// 		$output .= "<{$itemtag} class='gallery-item'>";
 
// 		// icontag
// 		$output .= "
// 		<{$icontag} class='gallery-icon'>
// 			$link
// 		</{$icontag}>";
 
// 		if ( $captiontag && trim( $attachment->post_excerpt ) ) {
 
// 			// captiontag
// 			$output .= "
// 			<{$captiontag} class='gallery-caption'>
// 				" . wptexturize($attachment->post_excerpt) . "
// 			</{$captiontag}>";
 
// 		}
 
// 		// End itemtag
// 		$output .= "</{$itemtag}>";
 
// 		// Line breaks by columns set
// 		if($columns > 0 && ++$i % $columns == 0) $output .= '<br style="clear: both">';
 
// 	}
 
// 	// End gallery output
// 	$output .= "
// 		<br style='clear: both;'>
// 	</div>\n";
 
// 	return $output;
 
// }
 
// Apply filter to default gallery shortcode
// add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );

// function split_content() {

// 	global $more;
// 	$more = true;
// 	$content = preg_split('~<p><span id="more-d+"></span></p>/i~', get_the_content('more'));
// 	for($c = 0, $csize = count($content); $c < $csize; $c++) {
// 		$content[$c] = apply_filters('the_content', $content[$c]);
// 	}
// 	return $content;

// }

// function strip_shortcode_gallery( $content ) {
//     preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

//     if ( ! empty( $matches ) ) {
//         foreach ( $matches as $shortcode ) {
//             if ( 'gallery' === $shortcode[2] ) {
//                 $pos = strpos( $content, $shortcode[0] );
//                 if( false !== $pos ) {
//                     return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
//                 }
//             }
//         }
//     }

//     return $content;
// }


// function js_async_attr($tag){

# Add async to all remaining scripts
// return str_replace( ' src', ' async="async" src', $tag );
// }
// add_filter( 'script_loader_tag', 'js_async_attr', 10 );





?>