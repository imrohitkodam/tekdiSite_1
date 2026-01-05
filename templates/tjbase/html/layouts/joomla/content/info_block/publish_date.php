<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

?>
<div class="published">
      <time class="font-medium" datetime="<?php echo HTMLHelper::_('date', $displayData['item']->publish_up, 'c'); ?>"
            itemprop="datePublished">
            <div class="start-date info_main">
                  <?php echo Text::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', '<span itemprop="genre">' . HTMLHelper::_('date', $displayData['item']->publish_up, Text::_('DATE_FORMAT_LC3'))). '</span>'; ?>
            </div>

      </time>
</div>