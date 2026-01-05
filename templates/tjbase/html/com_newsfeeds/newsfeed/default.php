<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;

?>

<?php if (!empty($this->msg)) : ?>
    <?php echo $this->msg; ?>
<?php else : ?>
    <?php $lang      = Factory::getLanguage(); ?>
    <?php $myrtl     = $this->item->rtl; ?>
    <?php $direction = ' '; ?>
    <?php $isRtl     = $lang->isRtl(); ?>
    <?php if ($isRtl && $myrtl == 0) : ?>
        <?php $direction = ' redirect-rtl'; ?>
    <?php elseif ($isRtl && $myrtl == 1) : ?>
        <?php $direction = ' redirect-ltr'; ?>
    <?php elseif ($isRtl && $myrtl == 2) : ?>
        <?php $direction = ' redirect-rtl'; ?>
    <?php elseif ($myrtl == 0) : ?>
        <?php $direction = ' redirect-ltr'; ?>
    <?php elseif ($myrtl == 1) : ?>
        <?php $direction = ' redirect-ltr'; ?>
    <?php elseif ($myrtl == 2) : ?>
        <?php $direction = ' redirect-rtl'; ?>
    <?php endif; ?>
    <?php $images = json_decode($this->item->images); ?>
    <div class="container mt-2  buzz-list-view">
        <div class="com-newsfeeds-newsfeed library-list-view newsfeed<?php echo $direction; ?>">
            <?php //if ($this->params->get('display_num')) : ?>
             <div class="page-header tt">
            <h1 class="text-center">
                <?php echo $this->escape($this->params->get('page_heading')); ?>
               </h1></div>
            <?php //endif; ?>
            <!-- <h2 class="<?php echo $direction; ?>">
                <?php if ($this->item->published == 0) : ?>
                    <span class="badge bg-warning text-light"><?php echo Text::_('JUNPUBLISHED'); ?></span>
                <?php endif; ?>
                <a href="<?php echo $this->item->link; ?>" target="_blank" rel="noopener">
                    <?php //echo str_replace('&apos;', "'", $this->item->name); ?>
                </a>
            </h2> -->

            <?php if ($this->params->get('show_tags', 1)) : ?>
                <?php $this->item->tagLayout = new FileLayout('joomla.content.tags'); ?>
                <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
            <?php endif; ?>

            <!-- Show Images from Component -->
            <?php if (isset($images->image_first) && !empty($images->image_first)) : ?>
                <?php $imgfloat = empty($images->float_first) ? $this->params->get('float_first') : $images->float_first; ?>
                <div class="com-newsfeeds-newsfeed__first-image img-intro-<?php echo $this->escape($imgfloat); ?>">
                    <figure>
                        <?php echo LayoutHelper::render(
                            'joomla.html.image',
                            [
                                'src' => $images->image_first,
                                'alt' => empty($images->image_first_alt) && empty($images->image_first_alt_empty) ? false : $images->image_first_alt,
                            ]
                        ); ?>
                        <?php if ($images->image_first_caption) : ?>
                            <figcaption class="caption"><?php echo $this->escape($images->image_first_caption); ?></figcaption>
                        <?php endif; ?>
                    </figure>
                </div>
            <?php endif; ?>

            <?php if (isset($images->image_second) and !empty($images->image_second)) : ?>
                <?php $imgfloat = empty($images->float_second) ? $this->params->get('float_second') : $images->float_second; ?>
                <div class="com-newsfeeds-newsfeed__second-image float-<?php echo $this->escape($imgfloat); ?> item-image">
                    <figure>
                        <?php echo LayoutHelper::render(
                            'joomla.html.image',
                            [
                                'src' => $images->image_second,
                                'alt' => empty($images->image_second_alt) && empty($images->image_second_alt_empty) ? false : $images->image_second_alt,
                            ]
                        ); ?>
                        <?php if ($images->image_second_caption) : ?>
                            <figcaption class="caption"><?php echo $this->escape($images->image_second_caption); ?></figcaption>
                        <?php endif; ?>
                    </figure>
                </div>
            <?php endif; ?>
            <!-- Show Description from Component -->
            <?php echo $this->item->description; ?>
            <!-- Show Feed's Description -->

            <?php if ($this->params->get('show_feed_description')) : ?>
                <!-- <div class="com-newsfeeds-newsfeed__description feed-description">
                    <?php //echo str_replace('&apos;', "'", $this->rssDoc->description); ?>
                </div> -->
            <?php endif; ?>

            <!-- Show Image -->
            <!-- <?php if ($this->rssDoc->image && $this->params->get('show_feed_image')) : ?> -->
                <div class="com-newsfeeds-newsfeed__feed-image">
                    <?php echo LayoutHelper::render(
                        'joomla.html.image',
                        [
                            'src' => $this->rssDoc->image->uri,
                            'alt' => $this->rssDoc->image->title,
                        ]
                    ); ?>
                </div>
            <!-- <?php endif; ?> -->

            <!-- Show items -->
          
            <?php if (!empty($this->rssDoc[0])) : ?>
                
                <div class="row com-newsfeeds-newsfeed__items">
                    <?php for ($i = 0; $i < $this->item->numarticles; $i++) : ?>
                        <?php if (empty($this->rssDoc[$i])) : ?>
                            <?php break; ?>
                        <?php endif; ?>
                        <?php $uri  = $this->rssDoc[$i]->uri || !$this->rssDoc[$i]->isPermaLink ? trim($this->rssDoc[$i]->uri) : trim($this->rssDoc[$i]->guid); ?>
                        <?php $uri  = !$uri || stripos($uri, 'http') !== 0 ? $this->item->link : $uri; ?>
                        <?php $text = $this->rssDoc[$i]->content !== '' ? trim($this->rssDoc[$i]->content) : ''; 
                  
$etnImagePath =  $this->rssDoc[$i]->links[0]->uri;
                  ?>
                        <div class="col-xl-4 col-sm-6 col-12 mb-4 library-pin ">
                            <div class="card-zoomin library-pin-cover">
                            <div class="bg-cover bg-repn library-bg-img" style="background-image: url('<?php echo $etnImagePath; ?>')">
                                    </div>
                                <div class="caption library__caption px-4 pt-4 pb-2">
                                    <div class="d-inline-block mb-1 start-date">
                                        <?php echo date('d M Y',strtotime($this->rssDoc[$i]->publishedDate));?>
                                    </div>
                                    <div class="d-inline-block mb-1 start-date float-end category">
                                  <?php echo array_keys($this->rssDoc[$i]->categories)[0]; ?>                                              </div>
                                  <div class="clearfix">
                                    
                                  </div>
                                    <?php if (!empty($uri)) : ?>
                                        <div class="library-title">
                                            <h2 class="feed-link">
                                                <a href="<?php echo htmlspecialchars($uri); ?>" target="_blank" rel="noopener">
                                                    <?php echo trim($this->rssDoc[$i]->title); ?>
                                                </a>
                                            </h2>
                                        </div>    
                                    <?php else : ?>
                                        <h3 class="feed-link"><?php echo trim($this->rssDoc[$i]->title); 
                                           
                                          ?></h3>
                                    <?php endif; ?>
                                    
                                    <?php if ($this->params->get('show_item_description') && $text !== '') : ?>
                                        <div class="feed-item-description intro-text">
                                            <?php if ($this->params->get('show_feed_image', 0) == 0) : ?>
                                                <?php $text = OutputFilter::stripImages($text); 
                                          
                                          ?>
                                            <?php endif; ?>
                                            <?php $text = HTMLHelper::_('string.truncate', $text, $this->params->get('feed_character_count')); ?>
                                            <?php echo str_replace('&apos;', "'", $text); ?>
                                        </div>
                                    <?php endif; ?>
                                                                    
                                </div>
                                
                            </div>    
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>    
<?php endif; ?>
<script>
jQuery(document).ready(function(){
    
    var fixedBarHeight= jQuery(".header-menu-bar").outerHeight();
    //var totalTopHeight = fixedBarHeight;
//console.log(fixedBarHeight);
   
   jQuery(".buzz-list-view").css("padding-top",fixedBarHeight);

   
});

</script> 