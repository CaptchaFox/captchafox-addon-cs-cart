<?php
use Tygh\Registry;
use Tygh\Settings;

/**
 * Get verification settings
 *
 * @param int|null $storefront_id Storefront ID.
 *
 * @return array<string, string>
 */
function fn_captchafox_get_use_for_settings($storefront_id = null)
{
    $addon_use_for_value = Registry::get('addons.captchafox.captchafox_use_for_value');
    $addon_use_for_value = unserialize($addon_use_for_value);
    $core_use_for_setting = Registry::get('settings.Image_verification.use_for');

    if ($storefront_id !== null) {
        $settings_manager = Settings::instance(['storefront_id' => $storefront_id]);
        
        $addon_use_for_value = $settings_manager->getValue('captchafox_use_for_value', 'captchafox');
        $addon_use_for_value = unserialize($addon_use_for_value);
        $core_use_for_setting = $settings_manager->getValue('use_for', 'Image_verification');
    }

    $settings = [];

    foreach (array_keys($core_use_for_setting) as $key) {
        if (isset($addon_use_for_value[$key])) {
            $settings[$key] = $addon_use_for_value[$key];
        } else {
            $settings[$key] = 'Y';
        }
    }

    return $settings;
}
