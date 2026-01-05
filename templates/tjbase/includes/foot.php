<?php
/**
* @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
* @license     GNU General Public License version 3 or later; see LICENSE.txt
*/

// Add CSS in Foot
if($addCSSBodyEnding){
  $addCSSBodyEndingArray = explode(',',$addCSSBodyEnding);
  foreach ($addCSSBodyEndingArray as $addStylesheetFile){
    if (file_exists($sitePath.$addStylesheetFile)){ ?>
      <link href="<?php echo $siteUrl.$addStylesheetFile; ?>" rel="stylesheet" type="text/css" />
    <?php
    };
  };
};

// Add JS in Foot
if($addJSBodyEnding){
  $addJSBodyEndingArray = explode(',',$addJSBodyEnding);
  foreach ($addJSBodyEndingArray as $addScriptsFile){
    if (file_exists($sitePath.$addScriptsFile)){ ?>
      <script src="<?php echo $siteUrl.$addScriptsFile; ?>" type="text/javascript"></script>
    <?php
    };
  };
};

require_once __DIR__ . '/scrolltotop.php';
require_once __DIR__ . '/analytics.php';

/*********************************************
* Code for assets removal is added in foot file
* so that it cannot be override by components.
**********************************************/

// Remove CSS
if($removeStylesheets){
  $removeStylesheetsArray = explode(',',$removeStylesheets);
  foreach ($removeStylesheetsArray as $removeStylesheetFile){
    unset($doc->_styleSheets[$siteUrl.$removeStylesheetFile]);
  };
};

// Remove CSS
if($removeScripts){
  $removeScriptsArray = explode(',',$removeScripts);
  foreach ($removeScriptsArray as $removeScriptFile){
    unset($doc->_scripts[$siteUrl.$removeScriptFile]);
  };
};
?>