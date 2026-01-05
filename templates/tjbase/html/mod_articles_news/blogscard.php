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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

if (!$list) {
    return;
}

// Load Bootstrap JS
HTMLHelper::_('bootstrap.framework');

// Group items into chunks of 3 for desktop (will be overridden for mobile)
$chunks = array_chunk($list, 3);
$id = 'blogCarousel' . $module->id;

// Calculate maximum width based on container
$maxWidth = '1200px'; // Adjust this value based on your layout

// Add custom CSS for the carousel
// Add responsive CSS for mobile
$css = "
/* Mobile styles */
@media (max-width: 767.98px) {
    #{$id} .carousel-inner .row > [class*='col-'] {
        flex: 0 0 100%;
        max-width: 100%;
        padding: 0 5px;
    }
    #{$id} .carousel-inner {
        padding: 10px 15px;
    }
    #{$id} .carousel-control-prev {
        left: 0;
    }
    #{$id} .carousel-control-next {
        right: 0;
    }
}


#{$id} {
    max-width: 100%;
    margin: 0 auto;
    overflow: hidden;
}
#{$id} .carousel-inner {
    padding: 20px 0;
    overflow: visible;
    max-width: 100%;
}
#{$id} .carousel-item {
    transition: transform 1s ease-in-out;
}
#{$id} .carousel-control-prev,
#{$id} .carousel-control-next {
    width: 40px;
    height: 40px;
    top: 40%;
    border-radius: 50%;
    opacity: 1;
    transition: all 0.3s ease;
    z-index: 10;
    position: absolute;
    display: flex !important;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
    box-shadow: 1px 1px 4px 0px #00000040;
gap: 10px;
angle: 0 deg;
border-width: 1px;
padding: 15px;


}
#{$id} .carousel-control-prev {
    left: 0;
    right: auto;
}
#{$id} .carousel-control-prev-icon,
#{$id} .carousel-control-next-icon {
    width: 1.5rem;
    height: 1.5rem;
}
#{$id} .carousel-control-next {
    right: 0;
    left: auto;
}
/* Ensure the carousel inner has enough padding for controls */
#{$id} .carousel-inner {
    padding: 20px 0px;
}

#{$id} .carousel-control-prev,
#{$id} .carousel-control-next {
    width: 40px;
    height: 40px;
background:none;
    border: none;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 1;
    
}

#{$id} .carousel-control-prev-icon,
#{$id} .carousel-control-next-icon {
width: 1.5rem;
    height: 1.5rem;
    background-size: 100% 100%;
    filter: invert(0.1) sepia(1) saturate(15) hue-rotate(210deg) brightness(0.6);

}
#{$id} .carousel-indicators button {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin: 0 5px;
    background-color: #ddd;
    opacity: 0.7;
}
#{$id} .carousel-indicators .active {
    background-color: #484848;
    opacity: 1;
}
";

$doc = JFactory::getDocument();
$doc->addStyleDeclaration($css);
?>

<div class="position-relative">
    <div id="<?php echo $id; ?>" 
         class="carousel slide" 
         data-bs-interval="false"  >
         
    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php 
        $isMobile = (bool)preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $_SERVER['HTTP_USER_AGENT']);
        $chunkSize = $isMobile ? 1 : 3;
        $chunks = array_chunk($list, $chunkSize);
        
        foreach ($chunks as $i => $chunk): ?>
            <div class="carousel-item px-1 <?php echo $i === 0 ? 'active' : ''; ?>">
                <div class="row g-5 justify-content-center">
                    <?php foreach ($chunk as $item): ?>
                        <div class="<?php echo $isMobile ? 'col-12' : 'col-md-4'; ?>">
                            <div class="mod-articlesnews__item h-100" itemscope itemtype="https://schema.org/Article">
                                <?php 
                                $currentItem = $item;
                                require ModuleHelper::getLayoutPath('mod_articles_news', 'blogscard_item'); 
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Carousel controls -->
    <?php if (count($chunks) > 1): ?>
        <div class="d-flex justify-content-end mb-3 px-1">
            <button class="carousel-control-prev position-static border-0 bg-transparent" 
                    type="button" 
                    data-bs-target="#<?php echo $id; ?>" 
                    data-bs-slide="prev" 
                    style="width: auto; height: auto; margin-right: 10px;">
                <i class="fa-solid fa-arrow-left" style="font-size: 1rem; color: #1C1B1F;"></i>
                <span class="visually-hidden"><?php echo Text::_('JPREVIOUS'); ?></span>
            </button>
            <button class="carousel-control-next position-static border-0 bg-transparent" 
                    type="button" 
                    data-bs-target="#<?php echo $id; ?>" 
                    data-bs-slide="next" 
                    style="width: auto; height: auto;">
                <i class="fa-solid fa-arrow-right" style="font-size: 1rem; color: #1C1B1F;"></i>
                <span class="visually-hidden"><?php echo Text::_('JNEXT'); ?></span>
            </button>
        </div>
    <?php endif; ?>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carouselEl = document.getElementById('<?php echo $id; ?>');
    
    // Initialize carousel with ONLY manual navigation
    new bootstrap.Carousel(carouselEl, {
        interval: false,   // disable auto sliding
        ride: false,       // don't auto-start
        touch: true,
        wrap: true
    });
});


</script>
