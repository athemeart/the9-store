<?php
/**
 * Theme-native storefront homepage.
 *
 * @package the9-store
 */

defined( 'ABSPATH' ) || exit;

get_header();
The9_Store_Homepage::render();
get_footer();
