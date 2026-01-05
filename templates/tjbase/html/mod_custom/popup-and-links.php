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
		echo '<h2 class="module-title font-semibold mb-4 sm:mb-6 lg:mb-8 text-center">' .$module->title .'</h2>';
	}
	?>
	<?php echo $module->content; ?>
</div>
<script>
jQuery(document).ready(function(){
	jQuery(".modal-toggle").click(function(e) {
		jQuery(this).siblings(".modal").toggleClass("is-visible");
		jQuery("body").addClass("overflow-hidden");
	});

	jQuery(".modal-close").click(function(e) {
	  jQuery(".modal").removeClass("is-visible");
		jQuery("body").removeClass("overflow-hidden");
	});

	jQuery(".modal").click(function(e) {
	  jQuery(".modal").removeClass("is-visible");
		jQuery("body").removeClass("overflow-hidden");
	});

	jQuery(".modal-wrapper").click(function(e) {
		e.stopPropagation();
	});

});

</script>
