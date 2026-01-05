<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

unset($headData['metaTags']['http-equiv']);
$doc->setHeadData($headData);
$doc->setMetaData( 'X-UA-Compatible', 'IE=edge', true);
$doc->setMetaData( 'viewport', 'width=device-width, initial-scale=1');
$doc->setMetaData( 'theme-color', $themeColor);
$doc->setGenerator('');

require_once __DIR__ . '/assets.php';

if($csp) {
	$doc->setMetaData( 'Content-Security-Policy', $csp, true);
};
?>

<meta charset="UTF-8">
<?php if($addAtHeadBeginning): { echo $addAtHeadBeginning; } endif; ?>
<link rel="shortcut icon" href="<?php echo $favicon ;?>" />
<jdoc:include type="head" />
<?php if($manifest && file_exists($sitePath.'/manifest.json')):?>
	<link rel="manifest" href="<?php echo $siteUrl.'/manifest.json';?>" />
<?php endif;?>
<link rel="canonical" href="<?php echo $headBaseURL; ?>" />
<meta name="theme-color" content="<?php $themeColor; ?>">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- <link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png"> -->
<!-- <link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png"> -->
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<!-- <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png"> -->
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-2PX2F8QRJH&amp;cx=c&amp;_slc=1"></script>
<script async="" src="https://www.google-analytics.com/analytics.js"></script>
<script src="https://tekdi.mynexthire.com/employer/ui/js/jobboard/careers-integration.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

<?php
if ($ogTag) {
	require_once __DIR__ . '/ogtag.php';
};
if ($twitterCard) {
	require_once __DIR__ . '/twittercard.php';
};
if ($schema) {
	require_once __DIR__ . '/schema.php';
};
require_once __DIR__ . '/footer-fixed.php';
?>
<?php if($addAtHeadEnding):{ echo $addAtHeadEnding; } endif;

if ($zohoTrackingCode) {
?>
	<script>
		var $zoho=$zoho || {};
		$zoho.salesiq = $zoho.salesiq || {widgetcode:'<?php echo $zohoTrackingCode; ?>', values:{},ready:function(){}};
		var d=document;s=d.createElement("script");
		s.type="text/javascript";
		s.id="zsiqscript";
		s.defer=true;
		s.src="https://salesiq.zoho.com/widget";
		t=d.getElementsByTagName("script")[0];
		t.parentNode.insertBefore(s,t);
		d.write("<div id='zsiqwidget'></div>");
	</script>
<?php
}
?>


