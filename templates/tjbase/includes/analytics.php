<?php
/**
* @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
* @license     GNU General Public License version 3 or later; see LICENSE.txt
*/

if ($googleAnalytics) {
?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $googleAnalytics; ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo $googleAnalytics; ?>');
	</script>
<?php
}
?>