<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu.min.js', [], ['defer' => true]);

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}


// Note. It is important to remove spaces between elements.

$is_navbar = strpos(' ' . $class_sfx . ' ', ' navbar-nav ') !== false;
?>
<div class="<?php echo $params->get('moduleclass_sfx'); ?>">
	<div class="hamburger-menu">
		<div class="hamburger-toggle-btn" title="Navigation">
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		</div>
	<div class="hamburger-toggle-block">

	<ul class="nav <?php echo ($is_navbar ? '' : ' nav-pills '),  $class_sfx;?>"<?php
		$tag = '';
		if ($params->get('tag_id') != null)
		{
			$tag = $params->get('tag_id').'';
			echo ' id="'.$tag.'"';
		}
	?>>
	<?php
	$level=0;
	if (is_array($list)) :
		foreach ($list as $i => &$item) :
			$itemParams = $item->getParams();
			$class = 'item-'.$item->id;
			if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id))
			{
				$class .= ' current';
			}

			if (in_array($item->id, $path))
			{
				$class .= ' active';
			}
			elseif ($item->type === 'alias')
			{
				$aliasToId = $itemParams->get('aliasoptions');

				if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
				{
					$class .= ' active';
				}
				elseif (in_array($aliasToId, $path))
				{
					$class .= ' alias-parent-active';
				}
			}
			if ($item->type === 'separator')
			{
				$class .= ' divider';
			}

			if ($item->deeper)
			{
				if ($item->level > 1){
					$class .= ' dropdown-submenu';
				} else {
					$class .= ' deeper dropdown';
				}
			}

			if ($item->parent)
			{
				$class .= ' parent';
			}

			if (!empty($class)) {
				$class = ' class="nav-item '.trim($class) .'"';
			}

			echo '<li'.$class.' data-menulevel='.$item->level.' onClick="void(0);">';

			// Render the menu item.
			switch ($item->type) :
				case 'separator':
				case 'url':
				case 'component':
				case 'heading':
					require JModuleHelper::getLayoutPath('mod_menu', 'mobile_'.$item->type);
					break;

				default:
					require JModuleHelper::getLayoutPath('mod_menu', 'mobile_url');
					break;
			endswitch;

			// The next item is deeper.
			if ($item->deeper) {
				echo '<ul class="dropdown-menu">';
				echo '<li> Back </li>';
			}
			// The next item is shallower.
			elseif ($item->shallower) {
				echo '</li>';
				echo str_repeat('</ul></li>', $item->level_diff);
			}
			// The next item is on the same level.
			else {
				echo '</li>';
			}
		endforeach;
		$level++;
	endif;
	?></ul>
	</div>
	</div>
</div>

<script>
	// jQuery(document).ready(function(){
	// 	jQuery('.hamburger-toggle-block a.dropdown-toggle').removeAttr("href");
	// 	jQuery(".hamburger-toggle-btn").click(function(){
	// 		jQuery(this).toggleClass("is-active");
	// 		jQuery('.hamburger-toggle-block').toggleClass('open');
	// 		jQuery('.tj-overlay ').toggleClass('hide');
	//  		jQuery('body').toggleClass('noscroll');
	// 	});
	// });

	// jQuery('.dropdown.parent').click(function(){
	// 	jQuery('.hamburger-toggle-btn').text('< Back');
	// 	jQuery(this).addClass('open');
	// });
	// jQuery('.dropdown-submenu.parent').click(function(){
	// 	jQuery(this).toggleClass('open');
	// });

	var $menuTrigger = jQuery('.js-menuToggle');
var $topNav = jQuery('.js-topPushNav');
var $openLevel = jQuery('.js-openLevel');
var $closeLevel = jQuery('.js-closeLevel');
var $closeLevelTop = jQuery('.js-closeLevelTop');
var $navLevel = jQuery('.js-pushNavLevel');

function openPushNav() {
  $topNav.addClass('isOpen');
  jQuery('body').addClass('pushNavIsOpen');
}

function closePushNav() {
  $topNav.removeClass('isOpen');
  $openLevel.siblings().removeClass('isOpen');
  jQuery('body').removeClass('pushNavIsOpen');
}

$menuTrigger.on('click touchstart', function(e) {
  e.preventDefault();
  if ($topNav.hasClass('isOpen')) {
    closePushNav();
  } else {
    openPushNav();
  }
});

$openLevel.on('click touchstart', function(){
	jQuery(this).next($navLevel).addClass('isOpen');
});

$closeLevel.on('click touchstart', function(){
	jQuery(this).closest($navLevel).removeClass('isOpen');
});

$closeLevelTop.on('click touchstart', function(){
  closePushNav();
});

$('.screen').click(function() {
    closePushNav();
});
</script>
