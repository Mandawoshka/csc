<?php
/*****************************************************************************
*                                                                            *
*                   All rights reserved! eCom Labs LLC                       *
* http://www.ecom-labs.com/about-us/ecom-labs-modules-license-agreement.html *
*                                                                            *
*****************************************************************************/

use Tygh\Registry;
use Tygh\Settings;
use Tygh\Addons\SchemesManager;
use Tygh\Languages\Languages;
use Tygh\BlockManager\ProductTabs;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    return;
}

if (!function_exists('fn_ecl_update_addon_settings')) {

    function fn_ecl_update_addon_settings($addon_scheme, $execute_functions = true)
    {
        $tabs = $addon_scheme->getSections();

        // If isset section settings in xml data and that addon settings is not exists
        if (!empty($tabs)) {
            Registry::set('runtime.database.skip_errors', true);

            // Get root settings section
            $addon_section = Settings::instance()->getSectionByName($addon_scheme->getId(), Settings::ADDON_SECTION);

            if (empty($addon_section) || empty($addon_section['section_id'])) {
                $addon_section_id = Settings::instance()->updateSection(array(
                    'parent_id'    => 0,
                    'edition_type' => $addon_scheme->getEditionType(),
                    'name'         => $addon_scheme->getId(),
                    'type'         => Settings::ADDON_SECTION,
                ));
            } else {
                $addon_section_id = $addon_section['section_id'];
            }

            $old_tabs = Settings::instance()->getSectionTabs($addon_section_id);
            $_old_settings = Settings::instance()->getList($addon_section_id, 0, true);
            $old_settings = array();
            if (!empty($_old_settings)) {
                foreach ($_old_settings as $_old_setting) {
                    $old_settings[$_old_setting['object_id']] = $_old_setting;
                }
            }

            foreach ($tabs as $tab_index => $tab) {
                // Add addon tab as setting section tab
                $_new_tab = array(
                    'parent_id'    => $addon_section_id,
                    'edition_type' => $tab['edition_type'],
                    'name'         => $tab['id'],
                    'position'     => $tab_index * 10,
                    'type'         => isset($tab['separate']) ? Settings::SEPARATE_TAB_SECTION : Settings::TAB_SECTION,
                );
                if (!empty($old_tabs) && !empty($old_tabs[$tab['id']])) {
                    $_new_tab['section_id'] = $old_tabs[$tab['id']]['section_id'];
                    unset($old_tabs[$tab['id']]);
                }

                $section_tab_id = Settings::instance()->updateSection($_new_tab);
                if (empty($section_tab_id) && !empty($_new_tab['section_id'])) {
                    $section_tab_id = $_new_tab['section_id'];
                }

                // Import translations for tab
                if (!empty($section_tab_id)) {
                    fn_update_addon_settings_descriptions($section_tab_id, Settings::SECTION_DESCRIPTION, $tab['translations']);
                    fn_update_addon_settings_originals($addon_scheme->getId(), $tab['id'], 'section', $tab['original']);

                    $settings = $addon_scheme->getSettings($tab['id']);

                    foreach ($settings as $k => $setting) {
                        if (!empty($setting['id'])) {

                            if (!empty($setting['parent_id'])) {
                                $setting['parent_id'] = Settings::instance()->getId($setting['parent_id'], $addon_scheme->getId());
                            }

                            $old_object_id = Settings::instance()->getId($setting['id'], $addon_scheme->getId());

                            $_new_setting = array(
                                'name'           => $setting['id'],
                                'section_id'     => $addon_section_id,
                                'section_tab_id' => $section_tab_id,
                                'type'           => $setting['type'],
                                'position'       => isset($setting['position']) ? $setting['position'] : $k * 10,
                                'edition_type'   => $setting['edition_type'],
                                'is_global'      => 'N',
                                'handler'        => $setting['handler'],
                                'parent_id'      => intval($setting['parent_id'])
                            );
                            if (!empty($old_object_id)) {
                                $_new_setting['object_id'] = $old_object_id;
                            }
                            $setting_id = Settings::instance()->update($_new_setting);
                            if (empty($setting_id) && !empty($old_object_id)) {
                                $setting_id = $old_object_id;
                            }
                            if (!empty($old_settings) && !empty($old_settings[$setting_id])) {
                                unset($old_settings[$setting_id]);
                            }

                            if (!empty($setting_id)) {
                                $old_value = Settings::instance()->getValue($setting['id'], $addon_scheme->getId());
                                if (empty($old_value)) {
                                    Settings::instance()->updateValueById($setting_id, $setting['default_value'], null, $execute_functions);
                                }

                                fn_update_addon_settings_descriptions($setting_id, Settings::SETTING_DESCRIPTION, $setting['translations']);
                                fn_update_addon_settings_originals($addon_scheme->getId(), $setting['id'], 'option', $setting['original']);

                                if (isset($setting['variants'])) {
                                    foreach ($setting['variants'] as $variant_k => $variant) {
                                        $old_variant = Settings::instance()->getVariant($addon_scheme->getId(), $setting['id'], $variant['id']);

                                        $_new_variant = array(
                                            'object_id'  => $setting_id,
                                            'name'       => $variant['id'],
                                            'position'   => isset($variant['position']) ? $variant['position'] : $variant_k * 10,
                                        );
                                        if (!empty($old_variant)) {
                                            $_new_variant['variant_id'] = $old_variant['variant_id'];
                                        }
                                        $variant_id = Settings::instance()->updateVariant($_new_variant);
                                        if (empty($variant_id) && !empty($_new_variant['variant_id'])) {
                                            $variant_id = $_new_variant['variant_id'];
                                        }

                                        if (!empty($variant_id)) {
                                            fn_update_addon_settings_descriptions($variant_id, Settings::VARIANT_DESCRIPTION, $variant['translations']);
                                            fn_update_addon_settings_originals($addon_scheme->getId(), $setting['id'] . '::' . $variant['id'], 'variant', $variant['original']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (!empty($old_settings)) {
                foreach ($old_settings as $setting_id => $setting) {
                    Settings::instance()->removeById($setting_id);
                }
            }
            if (!empty($old_tabs)) {
                foreach ($old_tabs as $tab) {
                    Settings::instance()->removeSection($tab['section_id']);
                }
            }

            Registry::set('runtime.database.skip_errors', false);

            $errors = Registry::get('runtime.database.errors');
            if (!empty($errors)) {
                $error_text = '';
                foreach ($errors as $error) {
                    $error_text .= '<br/>' . $error['message'] . ': <code>'. $error['query'] . '</code>';
                }
                fn_set_notification('E', __('addon_sql_error'), $error_text);

                return false;
            }
        }

        return true;
    }
}

if ($mode == 'update_addon') {

    $addon = $_REQUEST['addon'];
    $addon_scheme = SchemesManager::getScheme($addon);

    if (empty($addon_scheme) || Registry::get('addons.' . $addon . '.status') !== 'A') {
        die('Wrong addon ' . $addon . ' or it was not installed/activated!');
    }

    if ($addon_scheme->processQueries('install', Registry::get('config.dir.addons') . $addon) == false) {
        die('Error in Queries!');
    }

    if (fn_ecl_update_addon_settings($addon_scheme) == false) {
        die('Error in Settings!');
    }

    foreach ($addon_scheme->getLanguages() as $lang_code => $_v) {
        $lang_code = strtolower($lang_code);
        $path = $addon_scheme->getPoPath($lang_code);
        if (!empty($path)) {
            Languages::installLanguagePack($path, array(
                'reinstall' => true,
                'validate_lang_code' => $lang_code
            ));
        }
    }

    $settings = Settings::instance()->getValues($addon_scheme->getId(), Settings::ADDON_SECTION, false);
    if (!empty($settings)) {
        Registry::set('settings.' . $addon, $settings);
        $addon_data = Registry::get('addons.' . $addon);
        Registry::set('addons.' . $addon, fn_array_merge($addon_data, $settings));
    }
    fn_clear_cache();

    ProductTabs::instance()->deleteAddonTabs($addon);
    if (fn_allowed_for('ULTIMATE')) {
        foreach (fn_get_all_companies_ids() as $company) {
            ProductTabs::instance($company)->createAddonTabs($addon_scheme->getId(), $addon_scheme->getTabOrder());
        }
    } else {
        ProductTabs::instance()->createAddonTabs($addon_scheme->getId(), $addon_scheme->getTabOrder());
    }
    ProductTabs::instance()->updateAddonTabStatus($addon, Registry::get('addons.' . $addon . '.status'));
    
    fn_print_r('Done! Settings:');
    fn_print_die($settings);
}
