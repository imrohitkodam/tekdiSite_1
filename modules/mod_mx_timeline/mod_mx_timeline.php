<?php
/**
 * @package Mx timeline
 * @version 4.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2016 Mixwebtemplates. All Rights Reserved.
 * @author Mixwebtemplates http://www.mixwebtemplates.com
 * 
 */
defined('_JEXEC') or die;
if(!isset($params) || !(count($params) > 0)) return;

if (JVERSION >= 4) require_once dirname(__FILE__).'/core/helper4.php';
if (JVERSION < 4) require_once dirname(__FILE__).'/core/helper.php';

$layout_name = $params->get('layout', 'default');
$cacheid = md5(serialize(array ($layout_name, $module->module)));
$cacheparams = new stdClass;
$cacheparams->cachemode = 'id';
$cacheparams->class = 'MxTimeLineHelper';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = $cacheid;
$list = JModuleHelper::moduleCache ($module, $params, $cacheparams);
$moduleclass_sfx = $params->get('moduleclass_sfx');
require JModuleHelper::getLayoutPath('mod_mx_timeline', $params->get('get_style', 'default'));
