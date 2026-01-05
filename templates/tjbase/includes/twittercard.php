<?php
/**
 * @copyright   Copyright (C) 2016 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
if (!($option == 'com_content') && !($view == 'article')){
?>
	<meta name="twitter:card" content="<?php echo $twitterCardType ; ?>">
	<meta name="twitter:url" content="<?php echo $currentURL ; ?>">
	<meta name="twitter:title" content="<?php echo $headtitle ; ?>">
	<meta name="twitter:description" content="<?php echo $headMetaDesc ; ?>">
	<meta name="twitter:image" content="<?php echo $siteUrl.$shareDefaultImg; ?>">
	<meta name="twitter:site" content="<?php echo $twitterHandle  ; ?>">
	<meta name="twitter:creator" content="<?php echo $twitterHandle  ; ?>">
<?php
} else {
?>
	<meta name="twitter:card" content="<?php echo $twitterCardType ; ?>">
	<meta name="twitter:url" content="<?php echo $currentURL ; ?>">
	<meta name="twitter:title" content="<?php echo $headtitle ; ?>">
	<meta name="twitter:description" content="<?php echo $headMetaDesc ; ?>">
	<meta name="twitter:site" content="<?php echo $twitterHandle  ; ?>">
	<meta name="twitter:creator" content="<?php echo $twitterHandle  ; ?>">
<?php
}
?>
