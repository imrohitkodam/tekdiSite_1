<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/*=====================
  Assets
=======================*/

// Google Fonts
if ($googleFonts) {
    $googleFontsArray = explode('|',$googleFonts);
    foreach($googleFontsArray as $googleFontsFile){
        $doc->addStyleSheet('https://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $googleFontsFile));
    }
};

// Material Icons
if ($loadMaterialIconCDN) {
	$doc->addStyleSheet('https://fonts.googleapis.com/icon?family=Material+Icons');
};

// Add CSS in head
if($addStylesheetsHead){
	$addStylesheetsHeadArray = explode(',',$addStylesheetsHead);
	foreach ($addStylesheetsHeadArray as $addStylesheetFile){
		if (file_exists($sitePath.$addStylesheetFile)){
			$doc->addStyleSheet($siteUrl.$addStylesheetFile);
		};
	};
};

// Add JS in head
if($addScriptsHead){
	$addScriptsHeadArray = explode(',',$addScriptsHead);
	foreach ($addScriptsHeadArray as $addScriptsFile){
		if (file_exists($sitePath.$addScriptsFile)){
			$doc->addScript($siteUrl.$addScriptsFile,'text/javascript');
		};
	};
};
if ($pageLoadingProgress){
	$doc->addScript($siteUrl.'/templates/' . $this->template . '/core/js/pace-1.0.0.min.js','text/javascript');
};

if ($enableaccessibilityChecker){
	$doc->addStyleSheet('https://rawgit.com/ffoodd/a11y.css/master/css/a11y-en.css');
};

/*********************************************
* Code for assets removal is added in foot file
* so that it cannot be override by components.
**********************************************/