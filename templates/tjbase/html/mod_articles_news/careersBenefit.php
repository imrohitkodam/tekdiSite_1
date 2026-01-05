<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

foreach ($item->jcfields as $jcfield)
{
    $item->jcfields[$jcfield->name] = $jcfield;
}

if (!$list) {
    return;
}

?>
<div class="mod-articlesnews newsflash">
    <div class="careers-benefits-at-tekdi">
        <?php foreach ($list as $item) : ?> 
            <div class="mod-articlesnews__item" itemscope itemtype="https://schema.org/Article">
                <?php require ModuleHelper::getLayoutPath('mod_articles_news', '_careersBenefit-item'); ?>
            </div>        
        <?php endforeach; ?>
    </div>
</div>