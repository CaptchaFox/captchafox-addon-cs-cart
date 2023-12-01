<?php
use Tygh\Settings;

defined('BOOTSTRAP') or die('Access denied');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        $mode === 'update'
        && isset($_REQUEST['addon'], $_REQUEST['captchafox_use_for'])
        && $_REQUEST['addon'] === 'captchafox'
    ) {
        $captchafox_use_for_settings = $_REQUEST['captchafox_use_for'];

        $new_value_for_core = $new_value_for_addon = [];

        $use_for_settings_variants = fn_settings_variants_image_verification_use_for();
        foreach (array_keys($use_for_settings_variants) as $variant) {
            if (!empty($captchafox_use_for_settings[$variant])) {
                $new_value_for_core[] = $variant;
                $new_value_for_addon[$variant] = $captchafox_use_for_settings[$variant];
            } else {
                $new_value_for_addon[$variant] = '';
            }
        }

        $settings_manager = Settings::instance(['storefront_id' => $storefront_id]);
        $settings_manager->updateValue('use_for', $new_value_for_core, 'Image_verification');
        $settings_manager->updateValue('captchafox_use_for_value', serialize($new_value_for_addon));
    }

    return [CONTROLLER_STATUS_OK];
}
