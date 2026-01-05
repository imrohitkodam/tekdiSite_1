<?php
/**
 * @copyright   Copyright (C) 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
?>

<?php if($addAtBodyBeginning): { echo $addAtBodyBeginning; } endif; ?>

<?php

// Check if current page itemid in layout array
if (array_key_exists($itemid,$templateLayoutArray)) {
  require_once __DIR__ .'/../layouts/'.$templateLayoutArray[$itemid].'.php';
}
// Check if current page view in layout array
elseif (array_key_exists($option.'-'.$view,$templateLayoutArray)) {
  require_once __DIR__ .'/../layouts/'.$templateLayoutArray[$option.'-'.$view].'.php';
}
// Check if current page component in layout array
elseif (array_key_exists($option,$templateLayoutArray)) {
  require_once __DIR__ .'/../layouts/'.$templateLayoutArray[$option].'.php';
}
// If not in layout array, render default layout
else {
  require_once __DIR__ .'/../layouts/'.$defaultLayout.'.php';
};
?>

<?php require_once __DIR__ . '/foot.php'; ?>

<?php if($addAtBodyEnding): { echo $addAtBodyEnding; } endif; ?>