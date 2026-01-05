<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

require_once __DIR__ . '/includes/params.php';

?>

<!DOCTYPE html>
<html lang="<?php echo $headLanguage; ?>" dir="<?php echo $headDirection; ?>">
	<!--Head-->
	<head>
		<?php require_once __DIR__ . '/includes/head.php'; ?>
		<!-- <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
		<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	</head>
	<!--/Head-->
	<!--Body-->
	<body class="<?php echo $pageclass.' '.$isHomepage.' parentid-'.$parentId.' itemid-' .$itemid.' '.$option.' view-'.$view.' '.$usertype.' '.$device ; ?>">
		<?php require_once __DIR__ . '/includes/layouts.php'; ?>
      <!-- ONCE SHOWN MODAL -->
		<div style="display:none" id="once-popup" class="d-none">
			<div class="inner">
				
					<h2>I am attending</h2>
					<div class="devlearn-img">
						<img src="images/popup/devlearn.png"/>
					</div>
					<div class="date-grp-img">
						<img src="images/popup/date-group.png"/>
					</div>

					<div class="speaker-cover">
						<div class="speaker-img">
							
						</div>
						<div class="speaker-bio">
							<div class="speaker-name">Parth Lawate</div>
							<div class="speaker-designation">
								CEO & Co-Founder 
								<a href="https://www.linkedin.com/in/parthlawate/" target="_blank"><img class="linkedin-img" src="images/popup/linkedin-white.png"/></a>
							</div>
						</div>
					</div>

					<div id="popup-close">
						<div class="button-close">close</div>
					</div>
			</div>
		</div>
		<!-- END ONCE SHOWN MODAL -->
	</body>
	<!--/Body-->
  <script>

	jQuery(document).ready(function() {
		(function () {

			var lastclear = localStorage.getItem('lastclear'),
				time_now  = (new Date()).getTime();

			if ((time_now - lastclear) > 1000 * 60 * 120) {

				localStorage.clear();

				jQuery("#once-popup").delay(100).fadeIn();
				localStorage.setItem('lastclear', time_now);
			}

		})();
		jQuery('#popup-close').click(function(e) // You are clicking the close button
		{
			jQuery('#once-popup').fadeOut(); // Now the pop up is hiden.
		});
		
		jQuery('#once-popup').click(function(e) 
		{
			jQuery('#once-popup').fadeOut(); 
		});
	});
  </script>
</html>
