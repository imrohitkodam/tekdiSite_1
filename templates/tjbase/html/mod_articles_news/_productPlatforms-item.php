<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

?>
<div class="secondArticle-cover">
    <?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)): ?>
        <figure class="newsflash-image">
            <?php echo LayoutHelper::render(
                'joomla.html.image',
                [
                    'src' => $item->imageSrc,
                    'alt' => $item->imageAlt,
                ]
            ); ?>
            <?php if (!empty($item->imageCaption)): ?>
                <figcaption>
                    <?php echo $item->imageCaption; ?>
                </figcaption>
            <?php endif; ?>
        </figure>
    <?php endif; ?>

    <?php if ($params->get('item_title')): ?>
        <?php $item_heading = $params->get('item_heading', 'h3'); ?>
        <<?php echo $item_heading; ?> class="secondArticles-sliders mb-2">
            <?php if ($item->link !== '' && $params->get('link_titles')): ?>
                <a href="<?php echo $item->link; ?>">
                    <?php echo $item->title; ?>
                </a>
            <?php else: ?>
                <?php echo $item->title; ?>
            <?php endif; ?>
        </<?php echo $item_heading; ?>>
    <?php endif; ?>

    <?php if (!$params->get('intro_only')): ?>
        <?php echo $item->afterDisplayTitle; ?>
    <?php endif; ?>

    <?php echo $item->beforeDisplayContent; ?>

    <?php if ($params->get('show_introtext', 1)): ?>

        <?php
        $introText = strip_tags($item->introtext);
        $introText = $item->introtext;
        if (strlen($introText) > 180) { ?>
            <div class="secondsliderArticles-content mb-0">
                <?php
                echo substr($introText, 0, 180) . '...'; ?>
            </div>
            <?php
        } else { ?>
            <div class="secondsliderArticles-content">
                <?php
                echo $introText; ?>
            </div>
            <?php
        }
        ?>
    <?php endif; ?>

    <?php echo $item->afterDisplayContent; ?>

    <?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')): ?>
        <?php echo LayoutHelper::render('joomla.content.readmore', ['item' => $item, 'params' => $item->params, 'link' => $item->link]); ?>
    <?php endif; ?>
</div>