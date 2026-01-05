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
$htag    = 'h1';

//Plugin trigger to add the schema for articles
Factory::getApplication()->triggerEvent("onTJArticleSchema", array($this->item, "Article"));

// Check if associations are implemented. If they are, define the parameter.
$assocParam        = (Associations::isEnabled() && $params->get('show_associations'));
$currentDate       = Factory::getDate()->format('Y-m-d H:i:s');
$isNotPublishedYet = $this->item->publish_up > $currentDate;
$isExpired         = !is_null($this->item->publish_down) && $this->item->publish_down < $currentDate;

foreach ($this->item->jcfields as $jcfield)
{
	$this->item->jcfields[$jcfield->name] = $jcfield;
}

?>
<div class="library-detail-view">
    <div class="fixed-top-bar">
        <div class="container">
			<div class="row">	
				<div class="col-sm-10 col-12">
						
                <?php if ($params->get('show_title')) : ?>
                    <div class="page-header">
                        <h1 class="mb-0" itemprop="headline">
                            <?php echo $this->escape($this->item->title); ?>
                        </h1>
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
            </div>
              
			<div class="col-sm-2 col-12">
				<?php  if(!empty($this->item->jcfields[2]->value)){ ?>
				<div class="download-section">
                  <div class="btn-download">
                     <?php
                $fileData = $this->item->jcfields[2]->value;

				$this->rsformlink = Route::_('index.php?option=com_rsform&formId=5&id='. $this->item->id.'&Itemid=129', true); 
                      ?> 
				<a class="float-end download-btn mt-2 mt-sm-0" href=<?php echo $this->rsformlink;   ?> target="" title="Download" rel="noreferrer noopener">Download<i class="fa fa-download ms-2" aria-hidden="true"></i>
				</a>	                    
                  </div>
                  
              </div>
              <?php }?>
            </div>
            </div>
        </div>
    </div>
    <div id="libId" class="libary-article-content com-content-article item-page  <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
        <div class="container pt-4 pb-5">
            <meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? Factory::getApplication()->get('language') : $this->item->language; ?>">
            <?php if ($this->params->get('show_page_heading')) : ?>
            <!--<div class="page-header">
                <h1> <?php //echo $this->escape($this->params->get('page_heading')); ?> </h1>
            </div>-->
            <?php endif;
            if (!empty($this->item->pagination) && !$this->item->paginationposition && $this->item->paginationrelative) {
                echo $this->item->pagination;
            }
            ?>

            <?php $useDefList = $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
            || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam; ?>

            <?php if ($params->get('show_title')) : ?>
            <div class="page-header">
                <!--<?php echo $htag; ?> itemprop="headline">
                    <?php echo $this->escape($this->item->title); ?>
                </<?php echo $htag; ?>-->
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
            <div class="article-info  mb-2 fw-bold"  style="color:#000;">
               
                <div class="row">
                <div class="col-sm-9 col-12 order-sm-1 order-2">

                    <?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
                        <?php $this->item->tagLayout = new FileLayout('joomla.content.tags'); ?>

                        <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
                    <?php endif; ?>
                </div>
                    <div class="col-sm-3 col-12 order-sm-2 order-1 text-end">
                        <?php
                            $article = JFactory::getDocument();

                            $category = JCategories::getInstance('Content')->get($this->item->catid);

                            //echo JText::sprintf('COM_CONTENT_CATEGORY', $category->title);
                            //echo ' | ';
                            echo 'Published Date: ';
                            echo JHtml::_('date', $this->item->publish_up, 'd F Y');
                        ?>
                    </div>
                    
                </div>
            </div>

            <?php if ($canEdit) : ?>
                <?php echo LayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item)); ?>
            <?php endif; ?>

            <?php // Content is generated by content plugin event "onContentAfterTitle" ?>
            <?php echo $this->item->event->afterDisplayTitle; ?>

            <!-- <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
                <?php //echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
            <?php endif; ?> -->


            <?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
            <?php // echo $this->item->event->beforeDisplayContent; ?>

            <?php if ((int) $params->get('urls_position', 0) === 0) : ?>
                <?php echo $this->loadTemplate('links'); ?>
            <?php endif; ?>
            <?php if ($params->get('access-view')) : ?>
                <div class="article-full-img">
                <?php echo LayoutHelper::render('joomla.content.full_image', $this->item); ?>
                </div>                
                <?php
                if (!empty($this->item->pagination) && !$this->item->paginationposition && !$this->item->paginationrelative) :
                    echo $this->item->pagination;
                endif;
                ?>
                <?php if (isset($this->item->toc)) :
                    echo $this->item->toc;
                endif; ?>
            <div itemprop="articleBody" class="com-content-article__body">
                <?php echo $this->item->text; ?>
            </div>

                <?php if ($info == 1 || $info == 2) : ?>
                    <?php if ($useDefList) : ?>
                        <?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
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
                    <?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
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
    </div>
    <!-- <div class="related-resources py-5">
        <div class="container">
            <h3 class="section-title text-center mb-5">Related Resources</h3>
            <?php //echo JHtml::_('content.prepare', '{loadposition related-resources}'); ?>
        </div>
    </div> -->
</div>


<script>
jQuery(document).ready(function(){
    var headerHeight= jQuery("#header").outerHeight();
    var fixedBarHeight= jQuery(".fixed-top-bar").outerHeight();
    var totalTopHeight = fixedBarHeight;

    jQuery(".fixed-top-bar").css("top",headerHeight);
    //jQuery(".libary-article-content ").css("padding-top",fixedBarHeight);

    jQuery(".btn-download").click(function () {
        //alert("test");
        jQuery(this).next(".download-list").slideToggle("fast");
    });
});

</script>
