<?php
/**
 * JL Content Fields Filter
 *
 * @version 	2.0.0
 * @author		Joomline
 * @copyright	(C) 2017-2020 Arkadiy Sedelnikov, Joomline. All rights reserved.
 * @license 	GNU General Public License version 2 or later; see	LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;

if (!key_exists('field', $displayData))
{
	return;
}

$moduleId = $displayData['moduleId'];
$field = $displayData['field'];
if(!empty($field->hidden)){
	return;
}

$app = Factory::getApplication();
$inputArray = $app->input;

$session = Factory::getSession();
$filterTag = $session->get('filterTag');
$currentFilterTag = $inputArray->get('filter_tag');

$filterItemId = $session->get('filterItemId');
$currentItemId = $inputArray->get('Itemid');

$option ="com_content";
$catid = $inputArray->getInt('id', 0);
$context = $option.'.cat_'.$catid.'.jlcontentfieldsfilter';

$jlContentFieldsFilter = $app->getUserStateFromRequest($context, 'jlcontentfieldsfilter', array(), 'array');

$label = JText::_($field->label);
$value = $field->value;
?>

<label class="jlmf-label" for="<?php echo $field->name.'-'.$field->id; ?>"><?php echo $label; ?></label>
<input
    type="text"
    value="<?php echo $value; ?>"
    id="<?php echo $field->name.'-'.$field->id; ?>"
    name="jlcontentfieldsfilter[<?php echo $field->id; ?>]"
    class="jlmf-input"
/>
