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

jimport( 'joomla.application.module.helper' );
$module = JModuleHelper::getModule('breadcrumbs');
$attribs['style'] = 'xhtml';
?>


    <?php foreach ($list as $item) : ?>

        <?php $link = Route::_('index.php?option=com_banners&task=click&id=' . $item->id); ?>

        <?php if ($item->type == 1) : ?>

            <div class="mod-video-banners">
                <?php // Text based banners ?>
                <?php echo str_replace(array('{CLICKURL}', '{NAME}'), array($link, $item->name), $item->custombannercode); ?>
                <div class="banner-overlay"></div>
                    <div class="banner-items text-white">
                        <div class="banner-items-top"></div>
                        
                        <?php echo JModuleHelper::renderModule( $module, $attribs );?>

                        <?php if ($headerText) : ?>
                            <div class="bannerheader">
                                <?php echo $headerText; ?>
                            </div>
                        <?php endif; ?>

                        <?php echo $item->description; ?>

                        <?php if ($footerText) : ?>
                            <div class="bannerfooter">
                                <?php echo $footerText; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else : ?>

            <?php $imageurl = $item->params->get('imageurl'); ?>
            <?php $baseurl = strpos($imageurl, 'http') === 0 ? '' : Uri::base(); ?>

            <!-- <div class="mod-banners" style="background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(72, 126, 159, 80%)), url('<?php //echo $baseurl . $imageurl; ?>') center/cover no-repeat;"> -->
            <div class="mod-banners" style="background: linear-gradient(90deg, rgba(4, 28, 59, 0.1) 10%, rgba(4, 28, 59, 0.1) 20%, rgba(4, 28, 59, 0.1) 30%, rgba(12, 54, 109, 0) 70%), url('<?php echo $baseurl . $imageurl; ?>') center/cover no-repeat;">
                <!-- <div class="banner-overlay"></div> -->

                <div class="banner-items text-white px-4">
                    <div class="container">

                        <div class="banner-items-top"></div>

                        <?php echo JModuleHelper::renderModule( $module, $attribs );?>

                        <?php if ($headerText) : ?>
                            <div class="bannerheader">
                                <?php echo $headerText; ?>
                            </div>
                        <?php endif; ?>

                        <?php echo $item->description; ?>

                        <?php if ($footerText) : ?>
                            <div class="bannerfooter">
                                <?php echo $footerText; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

