<?php

/**
 * Plugin Name: Progressive Dental
 * Plugin URI: https://progressivedentalmarketing.com
 * Description: Custom Website Functionality.
 * Version: 1.0
 * Author: Holiday
 * Author URI: http://madeby.holiday
 * License: GPL2
 */

define('PD_PLUGIN_URL', plugin_dir_url( __FILE__ ));

require WPMU_PLUGIN_DIR . '/pd/admin.php';
require WPMU_PLUGIN_DIR . '/pd/utils.php';
require WPMU_PLUGIN_DIR . '/pd/theme.php';
require WPMU_PLUGIN_DIR . '/pd/acf.php';
require WPMU_PLUGIN_DIR . '/pd/graphql.php';
require WPMU_PLUGIN_DIR . '/pd/gravityforms-highlevel/highlevel.php';
require WPMU_PLUGIN_DIR . '/pd/gravityforms-highlevel2/highlevel2.php';
require WPMU_PLUGIN_DIR . '/pd/schema-pro/customize.php';
require WPMU_PLUGIN_DIR . '/pd/schema-pro/graphql.php';