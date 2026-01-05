<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_categories
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\ Component\ Fields\ Administrator\ Helper\ FieldsHelper;

$input  = $app->input;
$option = $input->getCmd('option');
$view   = $input->getCmd('view');
$id     = $input->getInt('id');

// Get category details
JTable::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_categories/tables' );
$categoryTable = JTable::getInstance('category');
$categoryTable->load(19);

// Get category custom fields
$catFieldDetails = FieldsHelper::getFields('com_content.categories', $categoryTable, true);
 

foreach ($catFieldDetails as $jcfield)
{
	$catFieldDetails[$jcfield->name] = $jcfield;
    
}

foreach ($catFieldDetails as $catdata){
   
    $profile_data = $catdata->subform_rows;
 //foreach ($profile_data as $data){?>
 <?php
//    echo "<pre>";print_r($profile_data);
//    die;
    ?>
    <p><?php echo $profile_data[0]['expert-name']->value ?></p>
    <p><?php echo $profile_data[0]['expert-designation']->value ?></p>

    <?php
  
 }
//}
foreach ($list as $item) : ?>
    <li<?php if ($id == $item->id && in_array($view, array('category', 'categories')) && $option == 'com_content') {
        echo ' class="active"';
       } ?>> <?php $levelup = $item->level - $startLevel - 1; ?>
        <a href="<?php echo Route::_(RouteHelper::getCategoryRoute($item->id, $item->language)); ?>">
        <?php echo $item->title; ?>
            <?php if ($params->get('numitems')) : ?>
                (<?php echo $item->numitems; ?>)
            <?php endif; ?>
        </a>

        <?php if ($params->get('show_description', 0)) : ?>
            <?php echo HTMLHelper::_('content.prepare', $item->description, $item->getParams(), 'mod_articles_categories.content'); ?>
        <?php endif; ?>
        <?php
        if (
            $params->get('show_children', 0) && (($params->get('maxlevel', 0) == 0)
            || ($params->get('maxlevel') >= ($item->level - $startLevel)))
            && count($item->getChildren())
        ) : ?>
            <?php echo '<ul>'; ?>
            <?php $temp = $list; ?>
            <?php $list = $item->getChildren(); ?>
            <?php require ModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default') . '_items'); ?>
            <?php $list = $temp; ?>
            <?php echo '</ul>'; ?>
        <?php endif; ?>


    </li>
<?php endforeach; ?>
