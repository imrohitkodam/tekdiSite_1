<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

require __DIR__ . '/includes/params.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $headLanguage; ?>" dir="<?php echo $headDirection; ?>">
	<!--Head-->
	<head>
		<meta charset="UTF-8">
		<meta name="robots" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="theme-color" content="<?php echo $themeColor; ?>" />
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
		<meta name="generator" content="">
		<base href="<?php echo $siteUrl; ?>/">

		<?php if($csp): ?>
			<meta http-equiv="Content-Security-Policy" content="<?php echo $csp; ?>">
		<?php endif;?>

		<?php if($googleFonts): ?>
			<link href="https://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $googleFonts) ; ?>" rel="stylesheet" />
		<?php endif;?>

		<?php if($loadMaterialIconCDN): ?>
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
		<?php endif;?>

		<?php if($addStylesheetsHead){
			$addStylesheetsHeadArray = explode(',',$addStylesheetsHead);
			foreach ($addStylesheetsHeadArray as $addStylesheetFile){
				if (file_exists($sitePath.$addStylesheetFile)){ ?>
					<link href="<?php echo $siteUrl.$addStylesheetFile; ?>" rel="stylesheet" />
					<?php
					};
				};
			};
   		?>

		<?php if($addScriptsHead){
			$addScriptsHeadArray = explode(',',$addScriptsHead);
			foreach ($addScriptsHeadArray as $addScriptsFile){
				if (file_exists($sitePath.$addScriptsFile)){ ?>
					<script src="<?php echo $siteUrl.$addScriptsFile; ?>" type="text/javascript"></script>
				<?php
				};
			};
		};
		?>

		<?php if ($pageLoadingProgress): ?>
			<script src="<?php echo $siteUrl.'/templates/tjbase/core/js/pace-1.0.0.min.js'; ?>" type="text/javascript"></script>
	  	<?php endif; ?>

		<?php if ($enableaccessibilityChecker): ?>
			<link href="https://rawgit.com/ffoodd/a11y.css/master/css/a11y-en.css" rel="stylesheet" />
	  	<?php endif; ?>

	</head>
	<!--/Head-->
	<!--Body-->
	<body class="<?php echo 'error-page '.$usertype.' '.$device; ?>">

		<?php
			require_once __DIR__ .'/layouts/'.$defaultLayout.'.php';

						if ($this->debug) : ?>
							<blockquote>
								<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
								<?php if ($this->debug) : ?>
									<br/><?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->error->getLine(); ?>
								<?php endif; ?>
							</blockquote>
							<div>
								<?php echo $this->renderBacktrace(); ?>
								<?php // Check if there are more Exceptions and render their data as well ?>
								<?php if ($this->error->getPrevious()) : ?>
									<?php $loop = true; ?>
									<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
									<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
									<?php $this->setError($this->_error->getPrevious()); ?>
									<?php while ($loop === true) : ?>
										<p><strong><?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
										<p>
											<?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
											<br/><?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->_error->getLine(); ?>
										</p>
										<?php echo $this->renderBacktrace(); ?>
										<?php $loop = $this->setError($this->_error->getPrevious()); ?>
									<?php endwhile; ?>
									<?php // Reset the main error object to the base error ?>
									<?php $this->setError($this->error); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>

		<?php
			if($addCSSBodyEnding){
				$addCSSBodyEndingArray = explode(',',$addCSSBodyEnding);
				foreach ($addCSSBodyEndingArray as $addStylesheetFile){
					if (file_exists($sitePath.$addStylesheetFile)){ ?>
						<link href="<?php echo $siteUrl.$addStylesheetFile; ?>" rel="stylesheet" type="text/css" />
					<?php
					};
				};
			};
		?>
		<?php
			if($addJSBodyEnding){
				$addJSBodyEndingArray = explode(',',$addJSBodyEnding);
				foreach ($addJSBodyEndingArray as $addScriptsFile){
					if (file_exists($sitePath.$addScriptsFile)){ ?>
						<script src="<?php echo $siteUrl.$addScriptsFile; ?>" type="text/javascript"></script>
					<?php
					};
				};
			};
		?>
	</body>
	<!--/Body-->
</html>
