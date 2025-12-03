<?php

/**
 * Plugin Name: Bengel Compress
 * Description: Compress your WordPress site assets for better performance.
 * Version: 1.0.0
 * Author: Thijmen Rierink | Bengelmedia
 * Author URI: https://bengelmedia.nl
 */

use Bengelmedia\BengelCompress\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('BENGEL_COMPRESS_VERSION', '1.0.0');
define('BENGEL_COMPRESS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BENGEL_COMPRESS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BENGEL_COMPRESS_PLUGIN_FILE', __FILE__);

if (!file_exists(BENGEL_COMPRESS_PLUGIN_DIR . 'vendor/autoload.php')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>';
        echo 'Bengel Compress plugin requires Composer dependencies. Please run <code>composer install</code> in the plugin directory.';
        echo '</p></div>';
    });
    return;
}

require_once BENGEL_COMPRESS_PLUGIN_DIR . 'vendor/autoload.php';
Plugin::getInstance();