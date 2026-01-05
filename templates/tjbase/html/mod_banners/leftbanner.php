<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Banners\Site\Helper\BannerHelper;

?>

<div>
    <?php foreach ($list as $item) : ?>

        <?php $link = Route::_('index.php?option=com_banners&task=click&id=' . $item->id); ?>

        <?php $imageurl = $item->params->get('imageurl'); ?>
        <?php $baseurl = strpos($imageurl, 'http') === 0 ? '' : Uri::base(); ?>

        <div class="mod-banners left-aligned-banners" style="background-image: url('<?php echo $baseurl . $imageurl; ?>');">
            <div class="container text-white">
                <div class="banner-items-top"></div>
                <div class="banner-content">

                    <?php if ($headerText) : ?>
                        <div class="bannerheader">
                            <?php echo $headerText; ?>
                        </div>
                    <?php endif; ?>

                    <div class="banner-items">
                        <?php echo $item->description; ?>
                    </div>

                    <?php if ($footerText) : ?>
                        <div class="bannerfooter">
                            <?php echo $footerText; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
