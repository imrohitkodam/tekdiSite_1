<?php
/**
* @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
* @license     GNU General Public License version 3 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

/*==============================
    Template Paths and URL
=================================*/

$tplUrl   = JUri::root(true) . '/templates/' . $this->template;
$tplPath  = JPATH_SITE . '/templates/' . $this->template;
$siteUrl  = JUri::root(true);
$sitePath = JPATH_SITE;

/**
* We will load our own jQuery & Bootstrap HTML classes
* These libraries doesn't work (jQuery & Bootstrap are loaded from template directly)
* This is here to avoid JHtml errors and improve compatibility
*/

if (version_compare(JVERSION, '3.0', '<')) {
	JHtml::addIncludePath($tplPath . '/includes/html');
}

/*==============================
    Core Variables
=================================*/

$app                = JFactory::getApplication();
$doc                = JFactory::getDocument();
$lang               = JFactory::getLanguage();
$user               = JFactory::getUser();
$browser            = JBrowser::getInstance();

/*==============================
    Browser and OS Variables
=================================*/

$browsername        = $browser->getBrowser();
$browserVersion     = $browser->getVersion();
$platform           = $browser->getPlatform();
$isMobile           = $browser->isMobile();
$isRobot            = $browser->isRobot();

/*==============================
    Component Variables
=================================*/

$option             = $app->input->getCmd('option', '');
$view               = $app->input->getCmd('view', '');
$layout             = $app->input->getCmd('layout', '');
$task               = $app->input->getCmd('task', '');
$itemid             = $app->input->getCmd('Itemid', '');

/*==============================
    Menu Variables
=================================*/

$menu               = $app->getMenu();

// Default Menuitem
$defaultmenu        = $menu->getDefault();

// Active Menuitem
$activemenu         = $menu->getActive();

$activemenuparams						= $activemenu->getParams();

// Page Class
$pageclass = '';
if (is_object($activemenu)) {
  $pageclass  = $activemenuparams->get('pageclass_sfx');
}

// is Homepage
$isHomepage = '';
if ($activemenu == $defaultmenu) {
	$isHomepage = 'home';
}

// Menuitem parentId
$parentId = '';
if (is_object($activemenu)) {
    $parentId = $activemenu->tree[0];
}

/*==============================
    Device Variables
=================================*/

if($isMobile == 1) {
    $device = 'mobile';
} else {
    $device = 'desktop';
}

/*==============================
    Device Variables
=================================*/

if($user->guest) {
    $usertype = 'guest';
} else {
    $usertype = 'registered';
}

/*==============================
    Head Variables
=================================*/

$headData           = $doc->getHeadData();
$sitename           = $app->getCfg('sitename');
$headtitle          = $headData['title'];
$headMetaDesc       = $headData['description'];
//$headMetaKeywords   = $headData['metaTags']['name']['keywords'];
$headAuthor         = (isset($headData['metaTags']['name']['author'])) ? $headData["metaTags"]["name"]["author"] : '';
$headScripts        = $headData['scripts'];
$headInlineJs       = $headData['script'];
$headStyleSheets    = $headData['styleSheets'];
$headInlineCSS      = $headData['style'];
$headLanguage       = $this->language;
$headDirection      = $this->direction;
$headBaseURL        = $this->base;
$currentURL         = JURI::current();

/*==============================
    Template Variables
=================================*/

$template           = $app->getTemplate(true);
$params             = $template->params;

/*==============================
    Template Param Variables
=================================*/

// Assets
$favicon                     = $params->get('favicon', 'templates/tjbase/core/images/favicon.ico');
$logoDesktop                 = $params->get('logoDesktop', 'templates/tjbase/core/images/logo.png');
$logoMobile                  = $params->get('logoMobile', 'templates/tjbase/core/images/logo.png');
$themeColor                  = $params->get('themeColor', '#45B3D0');
$mainmenu                    = $params->get('mainmenu', 'mainmenu');
$footermenu                  = $params->get('footermenu', 'footermenu');
$facebookLink                = $params->get('facebookLink', '');
$twitterLink                 = $params->get('twitterLink', '');
$pinterestLink               = $params->get('pinterestLink', '');
$linkedinLink                = $params->get('linkedinLink', '');
$googlePlusLink              = $params->get('googlePlusLink', '');
$youTubeLink                 = $params->get('youTubeLink', '');
$addressDetail               = $params->get('addressDetail', '');
$telephoneNumber             = $params->get('telephoneNumber', '');
$googleAnalytics             = $params->get('googleAnalytics', '');
$googleFonts                 = $params->get('googleFonts', '');
$loadMaterialIconCDN         = $params->get('loadMaterialIconCDN', '0');
$addStylesheetsHead          = $params->get('addStylesheetsHead', '');
$addScriptsHead              = $params->get('addScriptsHead', '');
$addCSSBodyEnding            = $params->get('addCSSBodyEnding', '');
$addJSBodyEnding             = $params->get('addJSBodyEnding', '');
$addAtHeadBeginning          = $params->get('addAtHeadBeginning', '');
$addAtHeadEnding             = $params->get('addAtHeadEnding', '');
$addAtBodyBeginning          = $params->get('addAtBodyBeginning', '');
$addAtBodyEnding             = $params->get('addAtBodyEnding', '');
$removeStylesheets           = $params->get('removeStylesheets', '');
$removeScripts               = $params->get('removeScripts', '');
$zohoTrackingCode            = $params->get('zohoTrackingCode', '');

//Layout
$layoutsDefault              = $params->get('layoutsDefault', '0');
$layoutsMenu                 = $params->get('layoutsMenu', '0');
$layoutsComponents           = $params->get('layoutsComponents', '0');
$stickyheader                = $params->get('stickyheader', '0');
$scrolltotop                 = $params->get('scrolltotop', '0');
$pageLoadingProgress         = $params->get('pageLoadingProgress', '0');

//Social Sharing
$ogTag                        = $params->get('ogTag', '0');
$ogType                       = $params->get('ogType', '');
$shareDefaultImg              = $params->get('shareDefaultImg', '');
$fbAdminId                    = $params->get('fbAdminId', '');
$twitterCard                  = $params->get('twitterCard', '');
$twitterCardType              = $params->get('twitterCardType', '');
$twitterHandle                = $params->get('twitterHandle', '');
$schema                       = $params->get('schema', '0');

//Error Messages
$error404                     = $params->get('message_404', '');
$error500                     = $params->get('message_500', '');


//Advanced
$csp                          = $params->get('csp', '0');
$manifest           	      = $params->get('manifest', '0');
$enableServiceWorker          = $params->get('enableServiceWorker', '0');
$enableBrowserNotSupported    = $params->get('enableBrowserNotSupported', '0');
$supportedBrowserConfig       = $params->get('supportedBrowserConfig', '');
$message_browserNotSupported  = $params->get('message_browserNotSupported', '');
$enableaccessibilityChecker   = $params->get('enableaccessibilityChecker', '0');

/*==============================
    Layouts Index
=================================*/

// All Layout index in $templateLayoutArray
$templateLayoutArray=[];

// Layout Index based on Menuitem
if($layoutsMenu) {
    foreach ($layoutsMenu as $layoutsMenuIndex) {
        foreach ($layoutsMenuIndex->menuitems as $itemId) {
            if($itemId){
                if($layoutsMenuIndex->layoutFolder == 'core') {
                    $templateLayoutArray[$itemId] = 'core/'.$layoutsMenuIndex->coreLayoutFile;
                } else {
                    $templateLayoutArray[$itemId] = 'custom/'.$layoutsMenuIndex->customLayoutFile;
                }
            };
        };
    };
};

// Layout Index based on Components
if($layoutsComponents) {
    foreach ($layoutsComponents as $layoutsComponentsIndex) {
        $componentsArray = explode(',',$layoutsComponentsIndex->components);
        foreach($componentsArray as $componentsArrayItem){
            if($componentsArrayItem){
                $componentsArrayItem = str_replace(["(",")"],"",$componentsArrayItem);
                if($layoutsComponentsIndex->layoutFolder == 'core') {
                    $templateLayoutArray[$componentsArrayItem] = 'core/'.$layoutsComponentsIndex->coreLayoutFile;
                } else {
                    $templateLayoutArray[$componentsArrayItem] = 'custom/'.$layoutsComponentsIndex->customLayoutFile;
                }
            };
        };
    };
};

// Default Layout
if ($layoutsDefault) {
    if($layoutsDefault->layoutFolder == 'core') {
        $defaultLayout = 'core/'.$layoutsDefault->coreLayoutFile;
    } else {
        $defaultLayout = 'custom/'.$layoutsDefault->customLayoutFile;
    }
}
?>
