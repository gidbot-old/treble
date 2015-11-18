<?php
################################################################################
# Welcome to "Zero" theme!
#===============================================================================
# thank you for purchasing. This is a functions.php file. Here you can find any
# theme specific functions ( for example ajax calls, custom post types and
# other things ). Most of the other functions are located in our plugin
# Fresh Framework, which has to be activated in order to run this template
# without any problems.
################################################################################



########################################################################################################################
# Framework Initialisation
#=======================================================================================================================
# this code initialise our fresh framework plugin. If the plugin is not
# presented, we run automatic installation which will result in installing
# and activating the plugin. Please do not change the framework initialisation ( lines 22 - 43 ), its complex
# and there is nothing you can gain by changing this
########################################################################################################################
require get_template_directory() . '/install/init.php';

if ( !class_exists('ffFrameworkVersionManager') && !is_admin() ) {
	echo '<span style="color:red; font-size:50px;">';
		echo __('The Fresh Framework plugin must be installed and activated in order to use this theme.', 'zero');
	echo '</span>';
	die();
} else if( !class_exists('ffFrameworkVersionManager') && is_admin() ) {
	if( !function_exists('zero__plugin_fresh_framework_notification') ) {
		function zero__plugin_fresh_framework_notification() {
			?>
			<div class="error">
				<p><?php echo __('Fresh themes require the Fresh Framework', 'zero'); ?></p>
			</div>
			<?php
		}
		add_action( 'admin_notices', 'zero__plugin_fresh_framework_notification' );
	}

	return;
}
require get_template_directory() . '/framework/init.php';

global $content_width;
if ( ! isset( $content_width ) ) $content_width = 1199;


################################################################################
# ENQUEUE STYLES
################################################################################

if( !function_exists( 'zero__fonts_url') ) {
	function zero__fonts_url() {
		$fonts_url = '';

		$font_families = array();
		$fontQuery = ffThemeOptions::getQuery('font');

		$all_font_selectors = array(
			'body-text',
			'inputs',
			'buttons',
			'code',
			'blockquote',
			'headers',
			'page-post-title',
			'small-text',
			'menu-button-label',
			'side-menu-navigation',
			'footer-body-text',
			'footer-widget-title',
		);


		// Check if it is google font
		foreach ($all_font_selectors as $font_selector) {
			$font_name = $fontQuery->get($font_selector);
			if (FALSE !== strpos($font_name, ',')) {
				// THIS IS NOT GOOGLE FONT
				continue;
			}
			$font_name = str_replace("'", "", $font_name);
			$font_families[ $font_name ] = $font_name . ':300,400,500,600,700,400italic,700italic';
		}

		// Create google font CSS uri if possible
		if (!empty($font_families)) {

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw($fonts_url);
	}
}



if( !function_exists( 'zero__wp_enqueue_theme_styles') ) {
	function zero__wp_enqueue_theme_styles() {

		// Libs Styles
		wp_enqueue_style( 'zero-bootstrap-css', get_template_directory_uri() . '/assets/libs/bootstrap/css/bootstrap.min.css' );

		wp_enqueue_style( 'zero-simple-line-icons-css', get_template_directory_uri() . '/assets/libs/fonts/simple-line-icons/simple-line-icons.css' );
		wp_enqueue_style( 'zero-font-awesome-css', get_template_directory_uri() . '/assets/libs/fonts/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_style( 'zero-font-zocial-css', get_template_directory_uri() . '/assets/libs/fonts/ff-font-zocial/ff-font-zocial.css' );

		wp_enqueue_style( 'zero-swiper-css', get_template_directory_uri() . '/assets/libs/swiper/swiper.css' );


		// Global Styles
		wp_enqueue_style( 'zero-style-css', get_stylesheet_uri() );

		// Blocks Styles
		wp_enqueue_style( 'zero-loader-1-css', get_template_directory_uri() . '/templates/blocks/loader-1/loader-1.css' );
		wp_enqueue_style( 'zero-comments-list-1-css', get_template_directory_uri() . '/templates/blocks/comments-list-1/comments-list-1.css' );
		wp_enqueue_style( 'zero-comments-form-1-css', get_template_directory_uri() . '/templates/blocks/comments-form-1/comments-form-1.css' );
		wp_enqueue_style( 'zero-comments-modal-1-css', get_template_directory_uri() . '/templates/blocks/comments-modal-1/comments-modal-1.css' );
		wp_enqueue_style( 'zero-contact-form-1-css', get_template_directory_uri() . '/templates/blocks/contact-form-1/contact-form-1.css' );

		wp_enqueue_style( 'zero-responsive-image-1-css', get_template_directory_uri() . '/templates/blocks/responsive-image-1/responsive-image-1.css' );
		wp_enqueue_style( 'zero-twitter-widget-1-css', get_template_directory_uri() . '/templates/blocks/twitter-widget-1/twitter-widget-1.css' );

		// Sections Styles
		wp_enqueue_style( 'zero-header-1-css', get_template_directory_uri() . '/templates/sections/header-1/header-1.css' );
		wp_enqueue_style( 'zero-featured-area-1-css', get_template_directory_uri() . '/templates/sections/featured-area-1/featured-area-1.css' );
		wp_enqueue_style( 'zero-featured-slider-1-css', get_template_directory_uri() . '/templates/sections/featured-slider-1/featured-slider-1.css' );
		wp_enqueue_style( 'zero-featured-video-1-css', get_template_directory_uri() . '/templates/sections/featured-video-1/featured-video-1.css' );
		wp_enqueue_style( 'zero-blog-post-1-css', get_template_directory_uri() . '/templates/sections/blog-post-1/blog-post-1.css' );
		wp_enqueue_style( 'zero-portfolio-cat-1-css', get_template_directory_uri() . '/templates/sections/portfolio-cat-1/portfolio-cat-1.css' );
		wp_enqueue_style( 'zero-pagination-1-css', get_template_directory_uri() . '/templates/sections/pagination-1/pagination-1.css' );
		wp_enqueue_style( 'zero-footer-1-css', get_template_directory_uri() . '/templates/sections/footer-1/footer-1.css' );
		wp_enqueue_style( 'zero-footer-2-css', get_template_directory_uri() . '/templates/sections/footer-2/footer-2.css' );
		wp_enqueue_style( 'zero-side-menu-1-css', get_template_directory_uri() . '/templates/sections/side-menu-1/side-menu-1.css' );


		$styleEnqueuer = ffContainer()->getStyleEnqueuer();
		$wpLayer = ffContainer()->getWPLayer();
		$fontQuery = ffThemeOptions::getQuery('font');


		$fonts_url = zero__fonts_url();
		if( !empty( $fonts_url ) ){
			$styleEnqueuer->addStyle('zero-google-fonts', $fonts_url);
		}

		// Create inline style to fonts
		$wpLayer->wp_add_inline_style('zero-style-css',
			''
			. zero__get_font_selectors('body-text') . '{font-family: ' . zero__wp_kses( $fontQuery->get('body-text') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('inputs') . '{font-family: ' . zero__wp_kses( $fontQuery->get('inputs') ) . ', monospace; }' . "\n"
			. zero__get_font_selectors('buttons') . '{font-family: ' . zero__wp_kses( $fontQuery->get('buttons') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('code') . '{font-family: ' . zero__wp_kses( $fontQuery->get('code') ) . ', monospace; }' . "\n"
			. zero__get_font_selectors('blockquote') . '{font-family: ' . zero__wp_kses( $fontQuery->get('blockquote') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('headers') . '{font-family: ' . zero__wp_kses( $fontQuery->get('headers') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('page-post-title') . '{font-family: ' . zero__wp_kses( $fontQuery->get('page-post-title') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('small-text') . '{font-family: ' . zero__wp_kses( $fontQuery->get('small-text') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('menu-button-label') . '{font-family: ' . zero__wp_kses( $fontQuery->get('menu-button-label') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('side-menu-navigation') . '{font-family: ' . zero__wp_kses( $fontQuery->get('side-menu-navigation') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('footer-body-text') . '{font-family: ' . zero__wp_kses( $fontQuery->get('footer-body-text') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
			. zero__get_font_selectors('footer-widget-title') . '{font-family: ' . zero__wp_kses( $fontQuery->get('footer-widget-title') ) . ', Helvetica, Arial, sans-serif; }' . "\n"
		);
	}

	add_action( 'wp_enqueue_scripts', 'zero__wp_enqueue_theme_styles' );
}

################################################################################
# ENQUEUE SCRIPTS
################################################################################
if( !function_exists( 'zero__wp_enqueue_framework_scripts') ) {
	function zero__wp_enqueue_framework_scripts()	{

		////////////////////////////////////////////
		// Framework Scripts
		////////////////////////////////////////////

		$scriptEnqueuer = ffContainer()->getScriptEnqueuer();

		$scriptEnqueuer->addScriptFramework('ff-frslib', '/framework/frslib/src/frslib.js', array( 'jquery' ), null, true);
		$scriptEnqueuer->addScriptFramework('ff-imagesloaded-js', '/framework/extern/imagesloaded/imagesloaded.min.js',null,null,true);
	}

	add_action('wp_enqueue_scripts', 'zero__wp_enqueue_framework_scripts', 9);
}


if( !function_exists( 'zero__wp_enqueue_theme_scripts') ) {
	function zero__wp_enqueue_theme_scripts(){

		////////////////////////////////////////////
		// Libs Scripts
		////////////////////////////////////////////

		// Logo color changing - required always, even in 404 and search-nothing-found
		// JS: zero-header-1-js
		wp_enqueue_script( 'zero-background-check-js', get_template_directory_uri() . '/assets/libs/background-check/background-check.min.js', array(), null, true );

		// Swiper - ( gallery ) slider - required only in:
		// JS: zero-twitter-widget-1-js
		// JS: zero-featured-slider-1-js
		wp_register_script( 'zero-swiper-js', get_template_directory_uri() . '/assets/libs/swiper/jquery.swiper.min.js', array('jquery'), null, true );


		// Isotope gallery - required only in:
		// JS: zero-portfolio-cat-1-js
		wp_register_script( 'zero-isotope-js', get_template_directory_uri() . '/assets/libs/isotope/isotope.pkgd.min.js', array('jquery', 'ff-imagesloaded-js'), null, true );

		////////////////////////////////////////////
		// Global Scripts
		////////////////////////////////////////////

		wp_enqueue_script( 'zero-global-js', get_template_directory_uri() . '/assets/js/global.js', array(), null, true );

		////////////////////////////////////////////
		// Blocks Scripts
		////////////////////////////////////////////

		// Loader - required only in:
		// /templates/blocks/loader-1/loader-1.php
		wp_register_script( 'zero-loader-1-js', get_template_directory_uri() . '/templates/blocks/loader-1/loader-1.js', array('jquery'), null, true );

		// Contact form script - required only in:
		// /templates/blocks/contact-form-1/contact-form-1.php
		wp_register_script( 'zero-contact-form-1-js', get_template_directory_uri() . '/templates/blocks/contact-form-1/contact-form-1.js', array('jquery'), null, true );

		// Comment form modal window script - required only in:
		// /templates/sections/blog-post-1/blog-post-1.php
		wp_register_script( 'zero-comments-form-1-js', get_template_directory_uri() . '/templates/blocks/comments-form-1/comments-form-1.js', array('jquery'), null, true );

		// Script to show Image optimized for browser width - required only in:
		// /templates/blocks/responsive-image-1/responsive-image-1.php
		// /templates/blocks/responsive-image-2/responsive-image-2.php
		wp_register_script( 'zero-responsive-image-1-js', get_template_directory_uri() . '/templates/blocks/responsive-image-1/responsive-image-1.js', array('jquery'), null, true );

		// Script for Twitter widget swiping - required only in:
		// /framework/components/widgets/twitter/class.ffComponent_TwitterWidget_Printer.php
		wp_register_script( 'zero-twitter-widget-1-js', get_template_directory_uri() . '/templates/blocks/twitter-widget-1/twitter-widget-1.js', array('jquery', 'zero-swiper-js'), null, true );

		////////////////////////////////////////////
		// Sections Scripts
		////////////////////////////////////////////

		// required always, even in 404 and search-nothing-found
		wp_enqueue_script( 'zero-header-1-js', get_template_directory_uri() . '/templates/sections/header-1/header-1.js', array('jquery'), null, true );

		// required only in post types and taxonomies, NOT in 404 and search-nothing-found - required "only" in:
		// /templates/sections/blog-post-1/blog-post-1.php
		wp_register_script( 'zero-blog-post-1-js', get_template_directory_uri() . '/templates/sections/blog-post-1/blog-post-1.js', array('jquery','ff-frslib'), null, true );

		// Video featured area - required only in:
		// /templates/sections/featured-area-1/featured-area-1.php
		wp_register_script( 'zero-featured-video-1-js', get_template_directory_uri() . '/templates/sections/featured-video-1/featured-video-1.js', array('jquery'), null, true );

		// Required in "Portfolio Category" taxonomy and "Portfolio Page" page template
		wp_register_script( 'zero-portfolio-cat-1-js', get_template_directory_uri() . '/templates/sections/portfolio-cat-1/portfolio-cat-1.js', array('jquery', 'zero-isotope-js'), null, true );


		// required always, even in 404 and search-nothing-found
		wp_enqueue_script( 'zero-side-menu-1-js', get_template_directory_uri() . '/templates/sections/side-menu-1/side-menu-1.js', array('jquery'), null, true );


		// For gallery featured area - required only in:
		// /templates/helpers/func.zero__gallery.php
		wp_register_script( 'zero-featured-slider-1-js', get_template_directory_uri() . '/templates/sections/featured-slider-1/featured-slider-1.js', array('jquery', 'zero-swiper-js', 'zero-responsive-image-1-js'), null, true );

		// Required only if "Primary Footer - Widgets" is enabled in WP Admin menu > Appearance > Theme Options - required only in:
		// /templates/sections/footer-1/footer-1.php
		wp_register_script( 'zero-footer-1-js', get_template_directory_uri() . '/templates/sections/footer-1/footer-1.js', array('jquery'), null, true );

	}
	add_action('wp_enqueue_scripts', 'zero__wp_enqueue_theme_scripts', 11);
}
################################################################################
# ADD POST FORMATS AND FEATURED IMAGE
################################################################################


add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array(
// 'aside',
'gallery',
// 'link',
// 'image',
// 'quote',
// 'status',
'video',
// 'audio',
// 'chat',
) );

add_theme_support('title-tag');


################################################################################
# FEATURED AREAS
################################################################################


locate_template('templates/helpers/class.Zero__Featured_Area.php', true, true);
locate_template('templates/helpers/func.zero__gallery.php', true, true);
locate_template('templates/helpers/func.zero__video.php', true, true);
locate_template('templates/helpers/class.Zero__Transparent_Imager.php', true, true);

add_filter('embed_oembed_html', array('Zero__Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
add_filter('post_gallery',      array('Zero__Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);


################################################################################
# REGISTER MENU
################################################################################


if( ! function_exists('zero__register_menu') ) {
	function zero__register_menu(){
		register_nav_menus(
			array(
				'navigation' => __('Navigation', ''),
			)
		);
	}
}
add_action( 'after_setup_theme', 'zero__register_menu' );


################################################################################
# REGISTER SIDEBAR WIDGETS
################################################################################

if( ! function_exists('zero__register_sidebar') ) {
	function zero__register_sidebar(){
		$query = ffThemeOptions::getQuery('footer')->get('primary');
		$widgets = $query->get('widgets');
		$index = 0;
		foreach ($widgets as $oneWidget) {
			$index++;
			register_sidebar(array(
				'name' => __('Footer', 'zero') . ' #' . absint( $index ),
				'id' => 'footer-' . absint( $index ),
				'description' => __('Add widgets here to appear in one of your footer columns.', 'zero'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
	}
}
add_action( 'widgets_init', 'zero__register_sidebar' );


################################################################################
# USER DATA ESCAPING FUNCTION
################################################################################

// Sorry I know that this is ugly global variable, but I want to call
// this function just once

global $zero__wp_kses_allowed_html;
$zero__wp_kses_allowed_html = wp_kses_allowed_html('post');

if( ! function_exists('zero__wp_kses') ) {
	function zero__wp_kses($html){
		global $zero__wp_kses_allowed_html;
		$html = wp_kses($html, $zero__wp_kses_allowed_html);
		return $html;
	}
}


################################################################################
# JAVASCRIPT CONSTANTS
################################################################################


if( !function_exists('zero__print_js_constants') ) {
	add_action('wp_head', 'zero__print_js_constants', 1);
	function zero__print_js_constants(){
		echo '<script type="text/javascript">';
		echo "\n";
		echo 'var ajaxurl = "' . admin_url('admin-ajax.php') . '";';
		echo "\n";
		echo 'var ff_template_url = "' . get_template_directory_uri() . '";';
		echo "\n";
		echo '</script>';
		echo "\n";
	}
}


################################################################################
# SOCIAL FEEDER: awesome -> zocial
################################################################################

if( !function_exists('zero__fontawesome_to_zocial') ) {
	function zero__fontawesome_to_zocial($awesome_iconfont){
		switch ($awesome_iconfont) {

			case 'google-plus':
				return 'gplus';
			case 'ff-font-zocial icon-google':
				return 'ff-font-zocial icon-gplus';

			default:
				return $awesome_iconfont;

		}
	}
}

add_filter('to_zocial', 'zero__fontawesome_to_zocial');




################################################################################
# COMMENT FORM AJAX
################################################################################
ffContainer()->getWPLayer()->getHookManager()->addAjaxRequestOwner('get-comment-form', 'zero__get_comment_form');

if( !function_exists('zero__get_comment_form') ) {
	function zero__get_comment_form(ffAjaxRequest $ajaxRequest){
		$data = $ajaxRequest->data;
		$postId = $data['postId'];

		global $wp_query;

		$wp_query = new WP_Query('post_type=any&p=' . absint( $postId ));

		the_post();

		comments_template('', true);
	}
}



// Allow shortcodes in widgets

add_filter('widget_text', 'do_shortcode');



// Nicer Submit Buttons for Comment Form, needed to use BUTTON instead of default INPUT (because pseudo-elements)
if( !function_exists('zero__nicer_submit_comment_button') ) {
	function zero__nicer_submit_comment_button(){
		echo '<p class="form-submit"><button name="submit" class="btn btn-default" type="submit">';
		echo ffThemeOptions::getQuery('comments comments-form submit-button');
		echo '</button></p>';
	}
}
add_action( 'comment_form', 'zero__nicer_submit_comment_button' );


/**********************************************************************************************************************/
/* CONTACT FORM
/**********************************************************************************************************************/
if( !function_exists('zero__contact_form_send_ajax') ) {

	ffContainer()->getWPLayer()->getHookManager()->addAjaxRequestOwner('contactform-send-ajax', 'zero__contact_form_send_ajax');

	function zero__contact_form_send_ajax(  ffAjaxRequest $ajaxRequest ) {

		$data = $ajaxRequest->data;
		$formSerialize = $data['formInput'];

		$output = array();
		parse_str( $formSerialize, $output);

		$contactInfo = $data['contactInfo'];

		$contactInfoDecoded = ffContainer::getInstance()->getCiphers()->freshfaceCipher_decode( $contactInfo );
		$contactInfoParsed = json_decode($contactInfoDecoded);

		$message = '';
		$message .= 'Name: '.esc_attr($output['name']) ."\n";
		$message .= 'Email: '.esc_attr($output['email']) ."\n";
		$message .= 'Subject: '.esc_attr($contactInfoParsed->subject) ."\n";
		$message .= "\n";
		$message .= 'Message: '.esc_attr($output['message']) ."\n";

		if( !empty( $contactInfoParsed->email ) ) {
			$result = wp_mail( $contactInfoParsed->email, $contactInfoParsed->subject, $message );

			if( $result == false ) {
				echo 'false';
			} else {
				echo 'true';
			}
		}
	}
}

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**********************************************************************************************************************/
/* GOOGLE FONTS
/**********************************************************************************************************************/


if( !function_exists('zero__get_font_selectors') ) {
	function zero__get_font_selectors($font){
		switch ($font) {
			case 'body-text'   :
				return 'body, html';
			case 'inputs':
				return 'input, textarea';
			case 'buttons':
				return 'input[type=submit], button[type=submit]';
			case 'code' :
				return 'code, pre';
			case 'blockquote':
				return 'blockquote';
			case 'headers':
				return 'h1, h2, h3, h4, h5, h6';
			case 'page-post-title':
				return 'h3.post-title, .insert-article-title, .portfolio-cat-1.ff-section .portfolio-cat-1__item h3, .punchline';
			case 'small-text':
				return '
.blog-post-1.ff-section .post-footer,
.blog-post-1.ff-section .read-more-button,
.blog-post-1.ff-section .post-meta__block,
.blog-post-1.ff-section .post-date,
.pagination-1.ff-section .pagination,
.portfolio-cat-1.ff-section .portfolio-cat-1__filter,
.portfolio-cat-1.ff-section .portfolio-cat-1__tags,
.comment-respond #cancel-comment-reply-link,
.comments-list-1.ff-block .comment-reply-link,
.comments-list-1.ff-block .comment-meta__date';
			case 'menu-button-label':
				return '.header-1.ff-section .menu-button__label';
			case 'side-menu-navigation':
				return '.side-menu-1.ff-section .navigation';
			case 'footer-body-text':
				return '.footer-1.ff-section, .footer-2.ff-section';
			case 'footer-widget-title':
				return 'h3.widget-title';
		}
		return '';
	}
}


if( !function_exists('zero__comment_form') ) {
	function zero__comment_form()
	{
		// See /templates/onePage/blocks/comments-form/comments-form.php
		comment_form();
	}
}

if( !function_exists('zero__the_tags') ) {
	function zero__the_tags()
	{
		// See /templates/sections/blog-post-1/blog-post-1.php
		// Search for: $postMetaGetter->getPostTagsHtml()
		the_tags();
	}
}

if( !function_exists('zero__paginate_links') ) {
	function zero__paginate_links()
	{
		// See /templates/sections/pagination-1/pagination-1.php and /templates/sections/pagination-single-1/pagination-single-1.php
		paginate_links();
	}
}

if( !function_exists('zero__paginate_comments_links') ) {
	function zero__paginate_comments_links()
	{
		// See /templates/sections/pagination-1/pagination-1.php and /templates/sections/pagination-single-1/pagination-single-1.php
		paginate_comments_links();
	}
}

if( !function_exists('zero__next_comments_link') ) {
	function zero__next_comments_link()
	{
		// See /templates/sections/pagination-1/pagination-1.php and /templates/sections/pagination-single-1/pagination-single-1.php
		next_comments_link();
	}
}

if( !function_exists('zero__previous_comments_link') ) {
	function zero__previous_comments_link()
	{
		// See /templates/sections/pagination-1/pagination-1.php and /templates/sections/pagination-single-1/pagination-single-1.php
		previous_comments_link();
	}
}

/**********************************************************************************************************************/
/* DEMO CONTENT INSTALLER NOTICE
/**********************************************************************************************************************/

add_action('admin_footer', 'ff_import_notice');

function ff_import_notice() {

    if( ffContainer()->getRequest()->get('import') == 'wordpress' ){
        $listOfActivePlugins = ffContainer()->getPluginLoader()->getActivePluginClasses();

        if( !isset( $listOfActivePlugins['p-zero-core'] ) && !isset( $listOfActivePlugins['zero-core'] )  ) {
            ?>
            <script>
                jQuery(document).ready(function($){
                    var htmlToInsert = '';

                    htmlToInsert += '<div style="background-color:red; color:white; padding: 20px; margin: 20px 0;">';
                        htmlToInsert += 'Before you can start using the Zero theme, you need to activate the Zero Theme Core plugin first. <a href="<?php echo admin_url( 'plugins.php');?>">Click here to go to plugin page</a>';
                    htmlToInsert += '<div>';


                    $('.wrap h2').after( htmlToInsert );

                    $('#import-upload-form').hide();
                    $('.narrow').hide();
                });
            </script>
            <?php
        }

    }


}


// TGM plugin installer
require_once get_template_directory() . "/install/install-plugins-by-tgm.php";


add_action('admin_footer', 'zero__import_notice');

function zero__import_notice() {

	if( ffContainer()->getRequest()->get('import') == 'wordpress' ){
		$listOfActivePlugins = ffContainer()->getPluginLoader()->getActivePluginClasses();

		if( !isset( $listOfActivePlugins['p-zero-core'] ) && !isset( $listOfActivePlugins['zero-core'] )  ) {
			?>
			<script>
				jQuery(document).ready(function($){
					var htmlToInsert = '';

					htmlToInsert += '<div style="background-color:red; color:white; padding: 20px; margin: 20px 0;">';
					htmlToInsert += 'Before you can start using the Zero theme, you need to activate the Zero Theme Core plugin first.';
					htmlToInsert += '<div>';


					$('.wrap h2').after( htmlToInsert );

					$('#import-upload-form').hide();
					$('.narrow').hide();
				});
			</script>
			<?php
		}

	}


}
