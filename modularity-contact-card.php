<?php

declare(strict_types=1);

/**
 * Plugin Name:       Modularity Contact Card
 * Description:       A Modularity module for rendering reusable contact cards.
 * Version:           0.1.0
 * Author:            Consid Webbteamet
 * Text Domain:       modularity-contact-card
 * Domain Path:       /languages
 */

namespace ModularityContactCard;

if (!defined('WPINC')) {
    die;
}

define('MODULARITYCONTACTCARD_PATH', plugin_dir_path(__FILE__));
define('MODULARITYCONTACTCARD_URL', plugins_url('', __FILE__));
define('MODULARITYCONTACTCARD_MODULE_PATH', MODULARITYCONTACTCARD_PATH . 'source/php/Module/');
define('MODULARITYCONTACTCARD_MODULE_VIEW_PATH', MODULARITYCONTACTCARD_PATH . 'source/php/Module/views');

add_action('init', static function (): void {
    load_plugin_textdomain('modularity-contact-card', false, plugin_basename(dirname(__FILE__)) . '/languages');
});

require_once MODULARITYCONTACTCARD_PATH . 'Public.php';

$autoload = MODULARITYCONTACTCARD_PATH . 'vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
} else {
    spl_autoload_register(static function (string $class): void {
        $prefix = __NAMESPACE__ . '\\';
        if (strpos($class, $prefix) !== 0) {
            return;
        }

        $relativeClass = substr($class, strlen($prefix));
        $relativePath = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
        $file = MODULARITYCONTACTCARD_PATH . 'source/php/' . $relativePath;

        if (file_exists($file)) {
            require_once $file;
        }
    });
}

add_action('acf/init', static function (): void {
    if (class_exists('\\AcfExportManager\\AcfExportManager')) {
        $acfExportManager = new \AcfExportManager\AcfExportManager();
        $acfExportManager->setTextdomain('modularity-contact-card');
        $acfExportManager->setExportFolder(MODULARITYCONTACTCARD_PATH . 'source/php/AcfFields/');
        $acfExportManager->autoExport([
            'contact-card-settings' => 'group_modularity_contact_card_settings',
        ]);
        $acfExportManager->import();

        return;
    }

    $acfFields = MODULARITYCONTACTCARD_PATH . 'source/php/AcfFields/php/contact-card-settings.php';
    if (file_exists($acfFields)) {
        require_once $acfFields;
    }
});

add_action('plugins_loaded', static function (): void {
    if (!class_exists(App::class)) {
        return;
    }

    new App();
});
