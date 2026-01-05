<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

require_once __DIR__ . '/includes/params.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $headLanguage; ?>" dir="<?php echo $headDirection; ?>">
	<!--Head-->
	<head>
		<?php require_once __DIR__ . '/includes/head.php'; ?>
	</head>
	<!--/Head-->
	<!--Body-->
	<body class="<?php echo $pageclass.' '.$isHomepage.' parentid-'.$parentId.' itemid-' .$itemid.' '.$option.' view-'.$view.' '.$usertype.' '.$device ; ?>">
		<div class="wrapper" role="main">
			<jdoc:include type="component" />
		</div>
		<?php require_once __DIR__ . '/includes/analytics.php'; ?>
	</body>
	<!--/Body-->
</html>

