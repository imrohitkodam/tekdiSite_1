<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_stories_outcomes
 *
 * @copyright   Copyright (C) 2025 Your Company. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;

// Ensure heading tag is valid
$allowedTags = ['h2', 'h3', 'h4', 'h5', 'h6'];
if (!in_array($headingTag, $allowedTags)) {
    $headingTag = 'h3';
}

// Check if we need horizontal scroll (more than 4 items)
$totalItems = count($items);
$useHorizontalScroll = $totalItems > 4;
$scrollContainerId = 'storiesOutcomesScroll' . $module->id;

// Add CSS for horizontal scroll
$doc = Factory::getDocument();
$css = "
#{$scrollContainerId} {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: #566376 #f0f0f0;
    padding-bottom: 10px;
}
#{$scrollContainerId}::-webkit-scrollbar {
    height: 8px;
}
#{$scrollContainerId}::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 4px;
}
#{$scrollContainerId}::-webkit-scrollbar-thumb {
    background: #566376;
    border-radius: 4px;
}
#{$scrollContainerId}::-webkit-scrollbar-thumb:hover {
    background: #09225A;
}
#{$scrollContainerId} .row {
    flex-wrap: nowrap;
    margin: 0;
}
#{$scrollContainerId} .col-md-6,
#{$scrollContainerId} .col-lg-3 {
    flex: 0 0 25%;
    max-width: 25%;
    min-width: 280px;
}
@media (max-width: 992px) {
    #{$scrollContainerId} .col-md-6,
    #{$scrollContainerId} .col-lg-3 {
        flex: 0 0 50%;
        max-width: 50%;
        min-width: 250px;
    }
}
@media (max-width: 576px) {
    #{$scrollContainerId} .col-md-6,
    #{$scrollContainerId} .col-lg-3 {
        flex: 0 0 100%;
        max-width: 100%;
        min-width: 100%;
    }
}
";
$doc->addStyleDeclaration($css);
?>

<div class="stories-outcomes <?php echo $moduleClass; ?>">
    <?php if (!empty($items)) : ?>
        <div class="stories-outcomes-section">
            <div class="container1">
                <?php if ($useHorizontalScroll) : ?>
                    <!-- Horizontal scroll container for more than 4 items -->
                    <div id="<?php echo $scrollContainerId; ?>" class="stories-outcomes-scroll">
                        <div class="row">
                            <?php foreach ($items as $item) : ?>
                                <?php if (!empty($item['title']) || !empty($item['description'])) : ?>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="stories-card shadow-sm border-0">
                                            <div class="stories-outcomes-body">
                                                <?php if (!empty($item['title'])) : ?>
                                                    <h5 class="stories-outcomes-title card-title">
                                                        <?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </h5>
                                                <?php endif; ?>
                                                
                                                <?php if (!empty($item['description'])) : ?>
                                                    <p class="stories-outcomes-text card-text">
                                                        <?php echo nl2br(htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8')); ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Normal grid for 4 or fewer items -->
                    <div class="row">
                        <?php foreach ($items as $item) : ?>
                            <?php if (!empty($item['title']) || !empty($item['description'])) : ?>
                                <div class="col-md-6 col-lg-3">
                                    <div class="stories-card shadow-sm border-0">
                                        <div class="stories-outcomes-body">
                                            <?php if (!empty($item['title'])) : ?>
                                                <h5 class="stories-outcomes-title card-title">
                                                    <?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
                                                </h5>
                                            <?php endif; ?>
                                            
                                            <?php if (!empty($item['description'])) : ?>
                                                <p class="stories-outcomes-text card-text">
                                                    <?php echo nl2br(htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8')); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <p class="stories-outcomes__empty">No stories outcomes available.</p>
    <?php endif; ?>
</div>
