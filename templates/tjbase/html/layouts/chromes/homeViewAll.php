<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.TJBase
 *
 * @copyright   (C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Table\Table;
use Joomla\Utilities\ArrayHelper;

$module  = $displayData['module'];
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

if ($module->content === null || $module->content === '')
{
	return;
}

$moduleClassSfx  = htmlspecialchars($params->get('moduleclass_sfx'));
$moduleId        = $module->id;
$catIdArray      = $params->get('catid');
$tags            = $params->get('tag');
$headerTag       = htmlspecialchars($params->get('header_tag', 'h2'));
$headerClass     = htmlspecialchars($params->get('header_class', ''));

if ($module->content)
{
	?>
	<div class="<?php echo $params->get('moduleclass_sfx'); ?>" id="tjmod-<?php echo $moduleId ?>">

		<?php
			if ($module->showtitle){
				?>
				<div class="module-header">
					<?php
					echo '<' . $headerTag . ' class="' . $headerClass . 'module-title font-semibold mb-2 text-center">' . $module->title . '</' . $headerTag . '>';
					$catID = $catIdArray[0];
					
					$categoryTable = Table::getInstance('Category');
					$categoryTable->load(array('alias' => "our-work"));
					
					$menu = Factory::getApplication()->getMenu();
					$link = 'index.php?option=com_content&view=category&layout=blog&id=' . $categoryTable->id . '&filter_tag[0]=' . $tags[0];
					$menuItem = $menu->getItems('link', $link, true);

					echo "<div class='text-right'><a class='view-all-link' href='". Route::_($link . '&Itemid=' . $menuItem->id, false) ."'><span>".JText::_('MOD_VIEW_ALL')."</span><span class='material-icons'>navigate_next</span></a></div>";
					?>
					<div class="clearfix"></div>
				</div>
				<?php
				}
				?>
				<div class="module-content">
					<?php echo $module->content; ?>
				</div>
	</div>

	<?php
}
