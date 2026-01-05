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

// Ensure heading tag is valid
$allowedTags = ['h2', 'h3', 'h4', 'h5', 'h6'];
if (!in_array($headingTag, $allowedTags)) {
    $headingTag = 'h3';
}
?>

<div class="stories-outcomes <?php echo $moduleClass; ?>">
    <?php if (!empty($items)) : ?>
        <div class="stories-outcomes-section">
            <div class="container1">
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
        </div>
    <?php else : ?>
        <p class="stories-outcomes__empty">No stories outcomes available.</p>
    <?php endif; ?>
</div>
