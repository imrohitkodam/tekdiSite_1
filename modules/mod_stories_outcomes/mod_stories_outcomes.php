<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_stories_outcomes
 *
 * @copyright   Copyright (C) 2025 Your Company. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;
// die('Test');
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

// Include the helper
require_once __DIR__ . '/helper.php';
// die('Test');

// Get module parameters - ensure it's a Registry object
if (!($module->params instanceof Registry)) {
    $params = new Registry($module->params);
} else {
    $params = $module->params;
}

// Get Stories Outcomes data
$helper = new ModStoriesOutcomesHelper();
$items = $helper->getStoriesOutcomes($params);
// echo '<pre>';
// print_r($items);
// echo '</pre>';
// die('Test');

// Check if we should display the module
$showEmpty = (int) $params->get('show_empty', 0);

if (empty($items) && !$showEmpty) {
    // Don't display module if no items and show_empty is disabled
    return;
}

// Prepare variables for template
$moduleClass = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8');
$headingTag = $params->get('heading_tag', 'h3');

// Extract group and field information from first item if available
$groupTitle = '';
$groupLabel = '';
$fieldLabel = '';
$titleFieldLabel = '';
$descFieldLabel = '';

if (!empty($items) && isset($items[0])) {
    $groupTitle = $items[0]['group_title'] ?? '';
    $groupLabel = $items[0]['group_label'] ?? '';
    $fieldLabel = $items[0]['field_label'] ?? '';
    $titleFieldLabel = $items[0]['title_label'] ?? '';
    $descFieldLabel = $items[0]['description_label'] ?? '';
}

// Load the template
require ModuleHelper::getLayoutPath('mod_stories_outcomes', $params->get('layout', 'default'));
