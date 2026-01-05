<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
if (!($option == 'com_content') && !($view == 'article')){
?>
  <meta itemprop="name" content="<?php echo $headtitle; ?>" />
	<meta itemprop="image" content="<?php echo $siteUrl.$shareDefaultImg; ?>" />
	<meta itemprop="description" content="<?php echo $headMetaDesc; ?>" />
<?php
} else {
?>
	<meta itemprop="name" content="<?php echo $headtitle; ?>" />
	<meta itemprop="description" content="<?php echo $headMetaDesc ; ?>" />
<?php
}
?>