<?php
/**
 * foto functions and definitions
 *
 * @package foto
 * @since foto 0.0.1
 */

/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 *
 * @package foto
 * @since foto 0.0.1
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/library/admin/' );
	require_once dirname( __FILE__ ) . '/library/admin/options-framework.php';
}

/**
 * Load all library files
 *
 * @package foto
 * @since foto 0.0.1
 */

require_once get_template_directory() . '/library/includes/setup.php';
require_once get_template_directory() . '/library/includes/enqueue.php';
require_once get_template_directory() . '/library/includes/extensions.php';
require_once get_template_directory() . '/library/includes/filters.php';
require_once get_template_directory() . '/library/includes/options-functions.php';
require_once get_template_directory() . '/library/includes/shortcodes.php';
require_once get_template_directory() . '/library/includes/templates.php';
require_once get_template_directory() . '/library/includes/widgets.php';

?>