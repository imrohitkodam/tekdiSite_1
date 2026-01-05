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

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('mod_articles_news_horizontal', 'mod_articles_news/template.css');

if (empty($list)) {
	return;
}
foreach ($list as $item) {
	foreach ($item->jcfields as $jcfield) {
		$item->jcFields[$jcfield->name] = $jcfield;
	}
}
?>

<div class="initiatives1">
	<div id="splide_slider_<?php echo $module->id; ?>" class="splide owl-carousel-initiatives slider animation">
		<div class="splide__track p-0">
			<div class="splide__list">

				<?php foreach ($list as $item): ?>
					<div class="splide__slide">
						<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_successStories-item'); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<script>
	new Splide('#splide_slider_<?php echo $module->id; ?>', {
		type: 'slide',
		cover: true,
		lazyLoad: 'nearby',
		pagination: false,
        speed: 3000,

		type: 'loop',
		arrows: true,
		perPage: 4,
		// gap: '20px',
		breakpoints: {
			1024: {
				perPage: 2,

			},
			767: {
				perPage: 2,

			},
			640: {
				perPage: 1,

			},
		},
	}).mount();
</script>