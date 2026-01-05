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
<div class="article-wrapper">
    <div class="industries article-cover text-white">
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
        <div class="industriesArticle-Img">
          
         <h1>
           <?php echo $item->image_intro; ?>
          </h1> 
      </div>
        <?php if ($params->get('item_title')): ?>
            <?php $item_heading = $params->get('item_heading', 'h3'); ?>
            <<?php echo $item_heading; ?> class="articles-sliders mt-4 mb-2">
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
            if (strlen($introText) > 120) { ?>
                <div class="sliderArticles-content industries-intro mt-2" style="height: 150px;">
                    <?php
                    echo substr(strip_tags($introText), 0, 120) . '...'; ?>
                </div>
                <?php
            } else { ?>
                <div class="sliderArticles-content industries-intro mt-2" style="height: 150px;">
                    <?php
                    echo strip_tags($introText); ?>
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
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const industryCards = document.querySelectorAll(".article-cover.industries");

  // Calculate and set the maximum height once on page load
  let maxHeight = 0;
  industryCards.forEach(c => {
    maxHeight = Math.max(maxHeight, c.offsetHeight);
  });
  industryCards.forEach(c => {
    c.style.height = maxHeight + "px";
  });

  // Add hover effect (only style changes, no height manipulation)
  industryCards.forEach(card => {
    card.addEventListener("mouseenter", () => {
      card.classList.add("hovered");
    });

    card.addEventListener("mouseleave", () => {
      card.classList.remove("hovered");
    });
  });
});
</script>