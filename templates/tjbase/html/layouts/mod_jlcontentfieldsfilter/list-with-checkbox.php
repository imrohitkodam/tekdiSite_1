<?php
/**
 * JL Content Fields Filter
 *
 * @package     Prayas
 * @subpackage  mod_jlcontentfieldsfilter
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2019 Techjoomla. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

if (!key_exists('field', $displayData))
{
	return;
}

// Get the input array
$app = Factory::getApplication();
$inputArray = $app->input;
$decodedFocusArea = base64_decode($inputArray->get('focusArea'));
$decodedOurWorkType = base64_decode($inputArray->get('ourWorkType'));
$decodedAuthor = base64_decode($inputArray->get('author'));
$filterSelectedArray = $inputArray->get('jlcontentfieldsfilter');
$isClearForm = $inputArray->get('isClearForm');

$option ="com_content";
$catid = $inputArray->getInt('id', 0);
$context = $option.'.cat_'.$catid.'.jlcontentfieldsfilter';

$jlContentFieldsFilter = $app->getUserStateFromRequest($context, 'jlcontentfieldsfilter', array(), 'array');

// Set default selected option flag on & change it with respect filter values (None selected is also a one the filter as we are showing all options selected by default)
$defaultAllSelected = 1;

if (!is_null($filterSelectedArray) || !is_null($jlContentFieldsFilter[1]) || !is_null($jlContentFieldsFilter[4]))
{
	$defaultAllSelected = 0;
}

if ($isClearForm == '1')
{
	$defaultAllSelected = 1;
}

// Get module id
$moduleId = $displayData['moduleId'];

// Get the fields details
$field = $displayData['field'];
$label = Text::_($field->label);
$value = $field->value;

$fieldId = $field->id;
$currentField = $jlContentFieldsFilter[$fieldId];

$listOptions = (array)$field->fieldparams->get('options', array());
$options = array();

if(is_array($listOptions))
{
	foreach ($listOptions as $listOption)
	{
		$options[] = HTMLHelper::_('select.option', $listOption->value, $listOption->name);
	}
}

// Check options are available
if(!count($options)){
	return;
}
$session = Factory::getSession();
$filterTag = $session->get('filterTag');
$filterItemId = $session->get('filterItemId');

$currentFilterTag = $inputArray->get('filter_tag');
$currentItemId = $inputArray->get('Itemid');

// Add the bootstrap multiselect JS & CSS to show the list options with checkobox
HTMLHelper::script(Uri::root() . 'templates/tjbase/assets/custom/js/bootstrap-multiselect.min.js');
HTMLHelper::stylesheet(Uri::root() . 'templates/tjbase/assets/custom/css/bootstrap-multiselect.css');
?>

<!-- Start : load field layout -->
<label class="jlmf-label" for="<?php echo $field->name.'-'.$field->id; ?>">
    <?php echo $label; ?>
</label>
<select name="jlcontentfieldsfilter[<?php echo $field->id; ?>][]" id="<?php echo $field->name.'-'.$field->id; ?>" class="jlmf-select-MM-<?php echo $field->id; ?>" multiple>
    <?php foreach($options as $k => $v) : ?>
        <?php $selected = (in_array($v->value, $value)) ? ' selected="selected"' : ''; ?>
            <option value="<?php echo $v->value; ?>" <?php echo $selected; ?>>
                <?php echo $v->text; ?>
            </option>
            <?php endforeach; ?>
</select>
<div class="clearfix"></div>
<!-- End : load field layout -->

<script>
jQuery(function()
{
	var fieldId = '<?php echo $field->id; ?>';
	var fieldName = '<?php echo $label; ?>';
	var currentFilterTag = '<?php echo $currentFilterTag[0]; ?>';
	var filterTag = '<?php echo $filterTag; ?>';
	var filterValue = '<?php echo $jlContentFieldsFilter[1]; ?>';
	var statefilterValue = '<?php echo $jlContentFieldsFilter[4]; ?>';
	var issuefilterValue = '<?php echo $jlContentFieldsFilter[5]; ?>';
	var articlefilterValue = '<?php echo $jlContentFieldsFilter[19]; ?>';
	var filterItemId = '<?php echo $filterItemId; ?>';
	var currentItemId = '<?php echo $currentItemId; ?>';
	var focusAreaValue = '<?php echo htmlspecialchars_decode($decodedFocusArea); ?>';
	var OurWorkTypeValue = '<?php echo $decodedOurWorkType; ?>';
	var authorValue = '<?php echo $decodedAuthor; ?>';
	var actualName = '<?php echo $field->name; ?>';
	
	var currentFieldCount = '<?php echo count($currentField); ?>';

	if (fieldName == 'State(s)')
	{
		var allSelected = 'All Selected';
		var noSelected = 'None Selected';
	}
	else
	{
		var allSelected = 'All ' +fieldName+ ' Selected';
		var noSelected = 'No ' +fieldName+ ' Selected';
	}

	if (fieldName == 'Focus Area')
	{
		var allSelected = 'All Selected';
		var noSelected = 'None Selected';
	}
	else
	{
		var allSelected = 'All ' +fieldName+ ' Selected';
		var noSelected = 'No ' +fieldName+ ' Selected';
	}

	jQuery('.jlmf-select-MM-'+fieldId).multiselect({
		includeSelectAllOption: true,
		allSelectedText: allSelected,
		nonSelectedText: noSelected,
		selectAllText: 'Select All'
	});

	// By default, show all the list options selected
	var defaultAllSelected = '<?php echo $defaultAllSelected; ?>';

	if (defaultAllSelected == 1)
	{
		jQuery('.jlmf-select-MM-'+fieldId).multiselect('selectAll', false);
		jQuery('.jlmf-select-MM-'+fieldId).multiselect('updateButtonText');
	}

	// Hide the tooltip for selected criteria
	jQuery('button[class="multiselect dropdown-toggle btn btn-default"]').removeAttr("title");

	var parentNode = jQuery("#our-work-type-8").parent();
	var superParent = jQuery(parentNode).parent();
	jQuery(superParent).addClass('our-worktype-hide');
	
	var authorParent = jQuery("#author-name-6").parent();
	jQuery(authorParent).addClass('author-hide');
	
	var parentNodeField = jQuery(".jlmf-select-MM-"+fieldId).parent().parent();
	jQuery(parentNodeField).attr('id', actualName + '-field-' + fieldId);
	
	if (window.history.replaceState)
	{
		window.history.replaceState( null, null, window.location.href );
	}
});
</script>
