<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_tags_similar_wci
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$width      = $params->get('width', '75');
$align      = $params->get('align', 'left');
$what       = $params->get('what', 'all');
$sort      	= $params->get('sort', 'down');
$showintro  = $params->get('showintro', '1');
$autohide   = $params->get('autohide', '1');
$alt		="";
$patterns = '/src="([^"]*)"/';
$itemId = JRequest::getVar('Itemid');
?>
<?php if ($list) : ?>
	<div class="tagswci<?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $i => $item) : ?>
		<div class="item">
		<?php 
		$link=JRoute::_("index.php?option=com_content&view=article&id=".$item->content_item_id.":".$item->core_alias."&catid=".$item->core_catid."&Itemid=".$itemId);
		?>
		<a href="<?php echo $link; ?>" class="title">
		<?php if (!empty($item->core_title)) :
			echo htmlspecialchars($item->core_title);
		endif; ?>
		</a>
        <?php
		$text="";
		if($showintro)
			$text=$item->core_body;
		$core_images=json_decode($item->core_images,true);
		switch($what){
			case 'intro':
				if($core_images["image_intro"]){
					$src=$core_images["image_intro"];
					if($core_images["float_intro"]) $align=$core_images["float_intro"];
					if($core_images["image_intro_alt"]) $alt=$core_images["image_intro_alt"];		
					$newimagetag='<a href="'.$link.'">';
					$newimagetag.='<img src="'.$src.'" width="'.$width.'" align="'.$align.'" class="introimage" alt="'.$alt.'"></a>';
					$text=$newimagetag.$text;
				}
				break;
			case 'full':
				if($core_images["image_fulltext"]){
					$src=$core_images["image_fulltext"];
					if($core_images["float_fulltext"]) $align=$core_images["float_fulltext"];
					if($core_images["image_fulltext_alt"]) $alt=$core_images["image_fulltext_alt"];		
					$newimagetag='<a href="'.$link.'">';
					$newimagetag.='<img src="'.$src.'" width="'.$width.'" align="'.$align.'" class="introimage" alt="'.$alt.'"></a>';
					$text=$newimagetag.$text;	
				}
				break;
			case 'content':
				preg_match_all('/<img (.*?)>/', $item->core_body, $match); 
				if(sizeof($match[0])>0) {
					$imagetags=$match[0];
					foreach($imagetags as $imagetag){
						preg_match($patterns, $imagetag, $matches);
						$src = $matches[1];
						unset($matches);
						$newimagetag='<a href="'.$link.'">';
						$newimagetag.='<img src="'.$src.'" width="'.$width.'" align="'.$align.'" class="introimage"></a>';
						$text=$newimagetag.str_replace($imagetag,"",$text);
						}	
				}
				break;
			case 'all':
			default:
				if(isset($core_images["image_intro"])&&strlen($core_images["image_intro"])){
					$src=$core_images["image_intro"];
					if($core_images["float_intro"]) $align=$core_images["float_intro"];
					if($core_images["image_intro_alt"]) $alt=$core_images["image_intro_alt"];		
					$newimagetag='<a href="'.$link.'">';
					$newimagetag.='<img src="'.$src.'" width="'.$width.'" align="'.$align.'" class="introimage" alt="'.$alt.'"></a>';
					$text=$newimagetag.$text;
				} else if(isset($core_images["image_fulltext"])&&strlen($core_images["image_fulltext"])){
					$src=$core_images["image_fulltext"];
					if($core_images["float_fulltext"]) $align=$core_images["float_fulltext"];
					if($core_images["image_fulltext_alt"]) $alt=$core_images["image_fulltext_alt"];		
					$newimagetag='<a href="'.$link.'">';
					$newimagetag.='<img src="'.$src.'" width="'.$width.'" align="'.$align.'" class="introimage" alt="'.$alt.'"></a>';
					$text=$newimagetag.$text;	
				} else {
					preg_match_all('/<img (.*?)>/', $item->core_body, $match); 
					if(sizeof($match[0])>0) {
						$imagetags=$match[0];
						foreach($imagetags as $imagetag){
							preg_match($patterns, $imagetag, $matches);
							$src = $matches[1];
							unset($matches);
							$newimagetag='<a href="'.$link.'">';
							$newimagetag.='<img src="'.$src.'" width="'.$width.'" align="'.$align.'" class="introimage"></a>';
							$text=$newimagetag.str_replace($imagetag,"",$text);
							}	
					}
				}
				break;
		}
		echo $text;
		?>
		</div>
	<?php endforeach; ?>
	</div>
<?php else : ?>

	<?php if(!$autohide)  echo "<span>".JText::_('MOD_TAGS_SIMILAR_WCI_NO_MATCHING_TAGS')."</span>"; ?>
	
<?php endif; ?>
