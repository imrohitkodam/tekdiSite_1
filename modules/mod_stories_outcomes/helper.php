<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_stories_outcomes
 *
 * @copyright   Copyright (C) 2025 Your Company. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Text;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;
use Joomla\Registry\Registry;

/**
 * Helper for mod_stories_outcomes
 *
 * @since  1.0.0
 */
class ModStoriesOutcomesHelper
{
    /**
     * Get Stories Outcomes data
     *
     * @param   Registry|string  $params  Module parameters
     *
     * @return  array  Array of stories outcomes items
     *
     * @since   1.0.0
     */
    public function getStoriesOutcomes($params)
    {
        // Ensure params is a Registry object
        if (!($params instanceof Registry)) {
            $params = new Registry($params);
        }
        
        // Get article ID based on source mode
        $articleId = $this->getArticleId($params);
        // echo '<pre>';
        // print_r($articleId);
        // echo '</pre>';
        // die('Test');

        if (!$articleId) {
            return [];
        }

        // Load the article
        $article = $this->getArticle($articleId);
        // echo '<pre>';
        // print_r($article);
        // echo '</pre>';
        // die('Test');

        if (!$article) {
            return [];
        }

        // Get the subform field value and field object
        $subformFieldName = $params->get('subform_field_name', 'stories-outcomes-field');
        $subformField = $this->getCustomField($article->id, $subformFieldName);

        if (!$subformField || empty($subformField->rawvalue)) {
            return [];
        }

        // Parse subform data with field and group information
        $items = $this->parseSubformData(
            $subformField->rawvalue,
            $params->get('title_field_key', 'stories-outcomes-title'),
            $params->get('description_field_key', 'stories-outcomes-description'),
            $subformField,
            $article->id
        );

        // Apply limit if set
        $limit = (int) $params->get('limit', 0);
        if ($limit > 0 && count($items) > $limit) {
            $items = array_slice($items, 0, $limit);
        }

        return $items;
    }

    /**
     * Get article ID based on source mode
     *
     * @param   Registry  $params  Module parameters
     *
     * @return  int|null  Article ID or null
     *
     * @since   1.0.0
     */
    protected function getArticleId($params)
    {
        $sourceMode = $params->get('source_mode', 'current');

        if ($sourceMode === 'specific') {
            // Use specific article ID from parameters
            return (int) $params->get('article_id', 0);
        }

        // Get current article ID from request
        $app = Factory::getApplication();
        $input = $app->input;

        // Check if we're on an article view
        $option = $input->get('option', '');
        $view = $input->get('view', '');

        if ($option === 'com_content' && $view === 'article') {
            return (int) $input->get('id', 0);
        }

        return null;
    }

    /**
     * Load article and check access
     *
     * @param   int  $articleId  Article ID
     *
     * @return  object|null  Article object or null
     *
     * @since   1.0.0
     */
    protected function getArticle($articleId)
    {
        if (!$articleId) {
            return null;
        }

        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select('a.*')
            ->from($db->quoteName('#__content', 'a'))
            ->where($db->quoteName('a.id') . ' = ' . (int) $articleId);

        // Check published state
        $query->where($db->quoteName('a.state') . ' = 1');

        $db->setQuery($query);

        try {
            $article = $db->loadObject();
        } catch (RuntimeException $e) {
            return null;
        }

        if (!$article) {
            return null;
        }

        // Check access level
        $user = Factory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        if (!in_array($article->access, $groups)) {
            return null;
        }

        return $article;
    }

    /**
     * Get custom field object for an article
     *
     * @param   int     $articleId  Article ID
     * @param   string  $fieldName  Field name
     *
     * @return  object|null  Field object or null
     *
     * @since   1.0.0
     */
    protected function getCustomField($articleId, $fieldName)
    {
        // First get the article to include category info
        $article = $this->getArticle($articleId);
        if (!$article) {
            return null;
        }
        
        // Prepare article object with category for fields
        $articleForFields = (object) [
            'id' => $articleId,
            'catid' => $article->catid ?? 0
        ];
        
        // Load fields for this article with category context
        // Third parameter (true) means prepareValue - we want rawvalue so use false
        // But we need to include subform fields, so we need to check the 4th parameter
        $fields = FieldsHelper::getFields('com_content.article', $articleForFields, false, null, true);

        if (empty($fields)) {
            return null;
        }

        // Find the field by name
        foreach ($fields as $field) {
            if ($field->name === $fieldName) {
                return $field;
            }
        }

        return null;
    }

    /**
     * Get field group title with translation
     *
     * @param   int  $groupId  Field group ID
     * @param   int  $articleId  Article ID
     *
     * @return  string  Translated group title
     *
     * @since   1.0.0
     */
    protected function getFieldGroupTitle($groupId, $articleId)
    {
        if ($groupId == 0) {
            return Text::_('JGLOBAL_FIELDS');
        }

        // Load fields to get group information
        $fields = FieldsHelper::getFields('com_content.article', (object) ['id' => $articleId], true);

        if (empty($fields)) {
            return '';
        }

        // Find a field from this group to get group_title
        foreach ($fields as $field) {
            if ($field->group_id == $groupId && !empty($field->group_title)) {
                // Translate the group title if it's a language constant
                return Text::_($field->group_title);
            }
        }

        return '';
    }

    /**
     * Parse subform JSON data with field and group information
     *
     * @param   string  $jsonValue         JSON string from subform field
     * @param   string  $titleFieldKey     Key for title field
     * @param   string  $descFieldKey      Key for description field
     * @param   object  $subformField      Subform field object
     * @param   int     $articleId         Article ID
     *
     * @return  array  Parsed items with field and group information
     *
     * @since   1.0.0
     */
    protected function parseSubformData($jsonValue, $titleFieldKey, $descFieldKey, $subformField, $articleId)
    {
        $items = [];

        // Get field group information
        $groupTitle = '';
        $groupLabel = '';
        if (!empty($subformField->group_id)) {
            $groupTitle = $this->getFieldGroupTitle($subformField->group_id, $articleId);
            // Also get the raw group_title for reference
            $groupLabel = !empty($subformField->group_title) ? $subformField->group_title : '';
        }

        // Get field label (translated)
        $fieldLabel = !empty($subformField->label) ? Text::_($subformField->label) : '';

        // Load all fields to get subform field labels and map field IDs
        $allFields = FieldsHelper::getFields('com_content.article', (object) ['id' => $articleId], true);
        
        // Get field IDs from subform field params (fieldparams->options)
        $titleFieldId = null;
        $descFieldId = null;
        $titleFieldLabel = '';
        $descFieldLabel = '';
        
        // Extract field IDs from subform field params
        if (!empty($subformField->fieldparams) && $subformField->fieldparams instanceof Registry) {
            $options = $subformField->fieldparams->get('options');
            if (is_object($options)) {
                $optionIndex = 0;
                foreach ($options as $option) {
                    if (is_object($option) && isset($option->customfield)) {
                        $fieldId = (int) $option->customfield;
                        // First option is title, second is description
                        if ($optionIndex == 0) {
                            $titleFieldId = $fieldId;
                        } elseif ($optionIndex == 1) {
                            $descFieldId = $fieldId;
                        }
                        $optionIndex++;
                    }
                }
            }
        }
        
        // Find field labels by name or ID
        foreach ($allFields as $field) {
            // Match by name first
            if ($field->name === $titleFieldKey || $field->id == $titleFieldId) {
                $titleFieldLabel = !empty($field->label) ? Text::_($field->label) : '';
                if (!$titleFieldId) {
                    $titleFieldId = $field->id;
                }
            }
            if ($field->name === $descFieldKey || $field->id == $descFieldId) {
                $descFieldLabel = !empty($field->label) ? Text::_($field->label) : '';
                if (!$descFieldId) {
                    $descFieldId = $field->id;
                }
            }
        }

        // Decode JSON
        $data = json_decode($jsonValue, true);

        if (!is_array($data)) {
            return $items;
        }

        // Process each row (row0, row1, etc.)
        foreach ($data as $rowKey => $row) {
            if (!is_array($row)) {
                continue;
            }

            // Extract title and description
            // Joomla subform uses field IDs as keys (field20, field21, etc.)
            $title = '';
            $description = '';
            
            // Try field ID first (field20, field21, etc.)
            if ($titleFieldId) {
                $fieldIdKey = 'field' . $titleFieldId;
                if (isset($row[$fieldIdKey])) {
                    if (is_object($row[$fieldIdKey]) && isset($row[$fieldIdKey]->value)) {
                        $title = trim($row[$fieldIdKey]->value);
                    } elseif (is_string($row[$fieldIdKey])) {
                        $title = trim($row[$fieldIdKey]);
                    }
                }
            }
            
            // Fallback to field name if field ID not found
            if (empty($title) && isset($row[$titleFieldKey])) {
                if (is_object($row[$titleFieldKey]) && isset($row[$titleFieldKey]->value)) {
                    $title = trim($row[$titleFieldKey]->value);
                } elseif (is_string($row[$titleFieldKey])) {
                    $title = trim($row[$titleFieldKey]);
                }
            }
            
            // Try field ID first for description
            if ($descFieldId) {
                $fieldIdKey = 'field' . $descFieldId;
                if (isset($row[$fieldIdKey])) {
                    if (is_object($row[$fieldIdKey]) && isset($row[$fieldIdKey]->value)) {
                        $description = trim($row[$fieldIdKey]->value);
                    } elseif (is_string($row[$fieldIdKey])) {
                        $description = trim($row[$fieldIdKey]);
                    }
                }
            }
            
            // Fallback to field name if field ID not found
            if (empty($description) && isset($row[$descFieldKey])) {
                if (is_object($row[$descFieldKey]) && isset($row[$descFieldKey]->value)) {
                    $description = trim($row[$descFieldKey]->value);
                } elseif (is_string($row[$descFieldKey])) {
                    $description = trim($row[$descFieldKey]);
                }
            }

            // Skip empty rows (both title and description empty)
            if (empty($title) && empty($description)) {
                continue;
            }

            $items[] = [
                'title' => $title,
                'description' => $description,
                'title_label' => $titleFieldLabel,
                'description_label' => $descFieldLabel,
            ];
        }

        // Add group and field information to the first item or as separate metadata
        if (!empty($items)) {
            // Add group and field info to all items
            foreach ($items as &$item) {
                $item['group_title'] = $groupTitle;
                $item['group_label'] = $groupLabel;
                $item['field_label'] = $fieldLabel;
                $item['group_id'] = $subformField->group_id ?? 0;
            }
        }

        return $items;
    }
}
