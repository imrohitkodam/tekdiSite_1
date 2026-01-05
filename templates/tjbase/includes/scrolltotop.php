<?php
/**
* @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
* @license     GNU General Public License version 3 or later; see LICENSE.txt
*/

if ($scrolltotop == 1) {
?>
	<span class="scrollToTop" title="Scroll to top" tabindex="0">
		<i class="fa fa-arrow-up fs-3"></i>
	</span>
	<script>
		jQuery(document).ready(function(){

			//Check to see if the window is top if not then display button
			jQuery(window).scroll(function(){
				if (jQuery(this).scrollTop() > 100) {
					jQuery('.scrollToTop').fadeIn();
				} else {
					jQuery('.scrollToTop').fadeOut();
				}
			});

			//Click event to scroll to top
			jQuery('.scrollToTop').click(function(){
				jQuery('html, body').animate({scrollTop : 0},800);
				return false;
			});

		});
	</script>
<?php
}
?>
