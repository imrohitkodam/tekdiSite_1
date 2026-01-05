<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


<div class="mod-custom custom <?php echo $params->get('moduleclass_sfx'); ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?>>
	<?php if ($module->showtitle)	{
		echo '<h2 class="module-title">' .$module->title .'</h2>';
	}
	?>
	<?php echo $module->content; ?>
</div>

<script>
jQuery(function() {
  jQuery('.acc-title').click(function(j) {

    var dropDown = $(this).closest('.acc-card').find('.acc-panel');
    jQuery(this).closest('.acc').find('.acc-panel').not(dropDown).slideUp();

    if (jQuery(this).hasClass('active')) {
      jQuery(this).removeClass('active');
    } else {
      jQuery(this).closest('.acc').find('.acc-title.active').removeClass('active');
      jQuery(this).addClass('active');
    }

    dropDown.stop(false, true).slideToggle();
    j.preventDefault();
  });
});
</script>
