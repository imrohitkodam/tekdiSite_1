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
					echo "<div class='text-right'><a class='view-all-link' href='".JRoute::_(ContentHelperRoute::getCategoryRoute($catID))."'><span>".JText::_('MOD_VIEW_ALL')."</span><span class='material-icons'>navigate_next</span></a></div>";
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
