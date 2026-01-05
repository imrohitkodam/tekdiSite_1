<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

if (!($option == 'com_content') && !($view == 'article')){
?>
	<meta property="og:title" content="<?php echo $headtitle ; ?>" />
	<meta property="og:type" content="<?php echo $ogType ;?>" />
	<meta property="og:image" content="<?php echo $siteUrl.$shareDefaultImg ; ?>" />
	<meta property="og:url" content="<?php echo $currentURL ; ?>" />
	<meta property="og:description" content="<?php echo $headMetaDesc ; ?>" />
	<meta property="og:site_name" content="<?php echo $sitename ;?>" />
	<meta property="fb:admins" content="<?php echo $fbAdminId ;?>" />
<?php
} else {
?>
	<meta property="og:title" content="<?php echo $headtitle ;?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo $currentURL ;?>" />
	<meta property="og:description" content="<?php echo $headMetaDesc ; ?>" />
	<meta property="og:site_name" content="<?php echo $sitename ;?>" />
	<meta property="fb:admins" content="<?php echo $fbAdminId ;?>" />
<?php
}
?>
