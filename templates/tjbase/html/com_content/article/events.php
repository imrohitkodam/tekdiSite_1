<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;

// Create shortcuts to some parameters.
$params  = $this->item->params;
$canEdit = $params->get('access-edit');
$user    = Factory::getUser();
$info    = $params->get('info_block_position', 0);
$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

// Check if associations are implemented. If they are, define the parameter.
$assocParam        = (Associations::isEnabled() && $params->get('show_associations'));
$currentDate       = Factory::getDate()->format('Y-m-d H:i:s');
$isNotPublishedYet = $this->item->publish_up > $currentDate;
$isExpired         = !is_null($this->item->publish_down) && $this->item->publish_down < $currentDate;


foreach ($this->item->jcfields as $jcfield)
{
    $this->item->jcfields[$jcfield->name] = $jcfield;
}

$eventPhotosList = $this->item->jcfields['event-photo-list']->rawvalue;
$eventPhotosList = json_decode($eventPhotosList);
?>

<div class="com-content-article event-article event-article-detail container item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
    <meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? Factory::getApplication()->get('language') : $this->item->language; ?>">
    <div id="banner" class="tjbase-banner">
        <?php //echo JHtml::_('content.prepare', '{loadposition event-banner}'); ?>
    </div>

    <div class="max-width py-5">
        <div class="row">
            <div class="col-sm-6 col-12">
                <?php if ($this->params->get('show_page_heading')) : ?>
                    <div class="page-header">
                        <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
                    </div>
                <?php endif;
                if (!empty($this->item->pagination) && !$this->item->paginationposition && $this->item->paginationrelative) {
                    echo $this->item->pagination;
                }
                ?>

                <?php $useDefList = $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
                || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam; ?>

                <?php if ($params->get('show_title')) : ?>
                    <div class="page-header">
                        <<?php echo $htag; ?> itemprop="headline">
                            <?php echo $this->escape($this->item->title); ?>
                        </<?php echo $htag; ?>>
                        <?php if ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED) : ?>
                            <span class="badge bg-warning text-light"><?php echo Text::_('JUNPUBLISHED'); ?></span>
                        <?php endif; ?>
                        <?php if ($isNotPublishedYet) : ?>
                            <span class="badge bg-warning text-light"><?php echo Text::_('JNOTPUBLISHEDYET'); ?></span>
                        <?php endif; ?>
                        <?php if ($isExpired) : ?>
                            <span class="badge bg-warning text-light"><?php echo Text::_('JEXPIRED'); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ($canEdit) : ?>
                    <?php echo LayoutHelper::render('joomla.content.icons', ['params' => $params, 'item' => $this->item]); ?>
                <?php endif; ?>

                <!-- <div class="event-info">
                    <div class="event-date">
                        <?php echo  $this->item->jcfields['event-date-and-time']->value;  ?>
                    </div>
                    <div class="event-address">
                        <?php echo  $this->item->jcfields['event-address']->value;  ?>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <?php
                        // Get Metadata Author
                        $metaAuthor = $this->item->metadata->get('author');

                        // Prefer Metadata Author if available, otherwise use Created By
                        $authorName = !empty($metaAuthor) ? $metaAuthor : $this->item->author;
                        ?>

                        <div class="event-meta d-flex align-items-center gap-2 mb-4">
                            <span class="event-author">
                                <?php echo $this->escape($authorName); ?>
                            </span>
                            <span class="">|</span>
                            <span class="event-date">
                                <?php echo HTMLHelper::_('date', $this->item->publish_up, Text::_('DATE_FORMAT_LC3')); ?>
                            </span>
                        </div>
                        <?php if (!empty($this->item->tags->itemTags)) : ?>
                            <div class="event-tags mt-2">
                                <?php 
                                
                                foreach ($this->item->tags->itemTags as $tag) : 
                                ?>
                                    <a href="https://www.tekdi.net/component/tags/tag/<?php echo htmlspecialchars($tag->alias, ENT_QUOTES, 'UTF-8'); ?>"
                                        class="event-tag me-3">
                                        #<?php echo $this->escape($tag->title); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
               
    


            </div>
                <?php // Content is generated by content plugin event "onContentAfterTitle" ?>
                <?php // echo $this->item->event->afterDisplayTitle; ?>

                <?php /* if ($useDefList && ($info == 0 || $info == 2)) : ?>
                    <?php echo LayoutHelper::render('joomla.content.info_block', ['item' => $this->item, 'params' => $params, 'position' => 'above']); ?>
                <?php endif; */ ?>

                <?php /* if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
                    <?php $this->item->tagLayout = new FileLayout('joomla.content.tags'); ?>

                    <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
                <?php endif; */ ?>

                <?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
                <?php //echo $this->item->event->beforeDisplayContent; ?>
            <div class="col-sm-6 col-12">
                 <?php
                    $images = json_decode($this->item->images);

                    if (!empty($images->image_fulltext)) {
                        // Show full image if available
                        echo LayoutHelper::render('joomla.content.full_image', $this->item);
                    } elseif (!empty($images->image_intro)) {
                        // Otherwise show intro image
                        echo LayoutHelper::render('joomla.content.intro_image', $this->item);
                    }
                ?>

                <!-- <?php if ((int) $params->get('urls_position', 0) === 0) : ?>
                    <?php //echo $this->loadTemplate('links'); ?>
                <?php endif; ?>
                <?php if ($params->get('access-view')) : ?>
                <?php //echo LayoutHelper::render('joomla.content.full_image', $this->item); ?>
                <?php
                if (!empty($this->item->pagination) && !$this->item->paginationposition && !$this->item->paginationrelative) :
                    //echo $this->item->pagination;
                endif;
                ?>
                <?php if (isset($this->item->toc)) :
                   // echo $this->item->toc;
                endif; ?> -->
            </div>
        </div>
        <div itemprop="articleBody" class="com-content-article__body mt-4">
            <div class="article-content">
                <!-- <h2 class="section-title">About <?php echo $this->escape($this->item->title); ?></h2> -->
                <?php echo $this->item->text; ?>
            </div>

            <?php if ($eventPhotosList == 1): ?>
                
                <!-- <div class="photos-cover">
                    <h2 class="section-title">
                        A Sneak Peek into the Event
                    </h2>            
                    <div class="event-img-cover">
                        <?php
                            foreach($eventPhotosList as $eventPhotos){
                        ?>
                            <div class="event-img">
                                <a class="image-popup" href="<?php echo $eventPhotos->field9->imagefile; ?>" title="<?php echo $eventPhotos->field9->alt_text ?>">
                                    <img src="<?php echo $eventPhotos->field9->imagefile; ?>" alt="<?php echo $eventPhotos->field9->alt_text ?>">
                                </a>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div> -->

                <div class="photos-cover">
                    <h2 class="section-title">
                        A Sneak Peek into the Event
                    </h2>            
                    <div class="event-img-cover">
                        <?php foreach($eventPhotosList as $eventPhotos){ ?>
                            <div class="event-img">
                                <a data-fancybox="event-gallery" 
                                href="<?php echo $eventPhotos->field9->imagefile; ?>" 
                                data-caption="<?php echo $eventPhotos->field9->alt_text; ?>">
                                    <img src="<?php echo $eventPhotos->field9->imagefile; ?>" 
                                        alt="<?php echo $eventPhotos->field9->alt_text ?>">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <?php endif; ?>
                <?php if ($info == 1 || $info == 2) : ?>
                    <?php if ($useDefList) : ?>
                        <?php echo LayoutHelper::render('joomla.content.info_block', ['item' => $this->item, 'params' => $params, 'position' => 'below']); ?>
                    <?php endif; ?>
                    <?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
                        <?php $this->item->tagLayout = new FileLayout('joomla.content.tags'); ?>
                        <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php
                if (!empty($this->item->pagination) && $this->item->paginationposition && !$this->item->paginationrelative) :
                    echo $this->item->pagination;
                    ?>
                <?php endif; ?>
                <?php if ((int) $params->get('urls_position', 0) === 1) : ?>
                    <?php echo $this->loadTemplate('links'); ?>
                <?php endif; ?>
                <?php // Optional teaser intro text for guests ?>
            <?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
                <?php echo LayoutHelper::render('joomla.content.intro_image', $this->item); ?>
                <?php echo HTMLHelper::_('content.prepare', $this->item->introtext); ?>
                <?php // Optional link to let them register to see the whole article. ?>
                <?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
                    <?php $menu = Factory::getApplication()->getMenu(); ?>
                    <?php $active = $menu->getActive(); ?>
                    <?php $itemId = $active->id; ?>
                    <?php $link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
                    <?php $link->setVar('return', base64_encode(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
                    <?php echo LayoutHelper::render('joomla.content.readmore', ['item' => $this->item, 'params' => $params, 'link' => $link]); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            if (!empty($this->item->pagination) && $this->item->paginationposition && $this->item->paginationrelative) :
                echo $this->item->pagination;
                ?>
            <?php endif; ?>
            <?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
            <?php echo $this->item->event->afterDisplayContent; ?>

        </div>  
        <div class="realted-blogs">
            <?php echo JHtml::_('content.prepare', '{loadposition relatedblogs}'); ?>
        </div>       
    </div>
</div>

<script>
jQuery(document).ready(function(){
    jQuery('.image-popup').magnificPopup({
        type: 'image',
    mainClass: 'mfp-with-zoom', 
    gallery:{
        enabled: true,
            navigateByImgClick: true,
            preload: [0,1]
            },

    zoom: {
        enabled: true, 

        duration: 300, 
        easing: 'ease-in-out', 

        opener: function(openerElement) {

        return openerElement.is('img') ? openerElement : openerElement.find('img');
    }
    }

    });

});

document.addEventListener("DOMContentLoaded", function() {
  Fancybox.bind("[data-fancybox='event-gallery']", {
    Thumbs: {
      autoStart: true
    },
    Toolbar: {
      display: ["zoom","slideshow","fullscreen","close"]
    },
    infinite: true, // prev/next loop
  });
});
</script>
