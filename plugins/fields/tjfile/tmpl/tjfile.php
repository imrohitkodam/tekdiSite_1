<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  PlgFieldsTjFile
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2021 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$destination = $fieldParams->get('destination');

$value = $field->value;

$filepath = Uri::root() . $destination . '/' . $value;

HTMLHelper::_('jquery.framework');
HTMLHelper::script(Uri::root() . '/plugins/fields/tjfile/assets/file.js');
?>

<?php
if ((!empty($value)))
{
?>
	<a class="float-end download-btn" href="<?php echo $filepath;?>" target="_blank" title="<?php echo TEXT::_("PLG_FIELDS_TJFILE_DOWNLOAD");?>" rel="noreferrer noopener"><?php echo TEXT::_("PLG_FIELDS_TJFILE_DOWNLOAD");?>
		<i class="fa fa-download ms-2" aria-hidden="true"></i>
	</a>
	<?php
}
?>
