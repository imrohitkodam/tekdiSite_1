<?php
/**
 * @package     TJLms
 * @subpackage  com_shika
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2020 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;
use Joomla\CMS\Filesystem\File;

use Joomla\CMS\Factory;
Use Joomla\Registry\Registry;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;
include_once JPATH_SITE . '/components/com_jticketing/helpers/customfield.php';


HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('bootstrap.renderModal');

$data         = $displayData;
$app          = Factory::getApplication();
$comparams    = ComponentHelper::getParams('com_tjlms');
$courseName   = $data['title'];
$allowCreator = $comparams->get('allow_creator', 0);
$user         = Factory::getUser();

BaseDatabaseModel::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_tjlms/models');
$tjlmsModelcourse = BaseDatabaseModel::getInstance('course', 'TjlmsModel', array('ignore_request' => true));
$enrollmentData   = $tjlmsModelcourse->enrollmentStatus((object) $data);
$data             = array_merge((array) $data, (array) $enrollmentData);
$currentDateTime  = Factory::getDate()->toSql();

$template    = $app->getTemplate(true)->template;
$override    = JPATH_SITE . '/templates/' . $template . '/html/layouts/com_tjlms/course/';
$enrolBtnText = Tjlms::Utilities()->enrolBtnText($data['start_date']);

$menuitem   = $app->getMenu()->getActive(); // get the active item
$menuParams = $menuitem->getParams();

$module       = ModuleHelper::getModule('mod_lms_course_display');
$moduleParams = new Registry($module->params);

// Get the custom field in override for courses.
	$fields = FieldsHelper::getFields('com_tjlms.course', $data, true);


		foreach($fields as $customFieldData)
		{
			if ($customFieldData->name == 'course-thumbnail-image')
			{
				$customFieldThumbnailId = $customFieldData->id;
			}
		}

	$modJTicketingHelper = new JticketingCustomfieldHelper();
	$customFieldValues = array();
	$customFieldValue = $modJTicketingHelper->getCustomFieldsValue($customFieldThumbnailId,$data['id']);
	$customFieldValues = json_decode($customFieldValue[0]->value);
?>
<div class="banner-bg-image" style="background-image:url('<?php echo $data['image'];?>');">
	<div class="container align-self-center position-relative d-inline-block">
		<div class="w-100">
			<div class="row">
				<div class="col-lg-8 col-12 position-relative">
					<div class="caption">
						<?php if ($customFieldValues->imagefile){?>
							<div class="mb-2">
								<img class="course-thumbnail-image" src="<?php echo $customFieldValues->imagefile;?>">
							</div>
						<?php } ?>
						<h2 class="event-title">
							<?php if ($data['start_date'] <= $currentDateTime){ ?>
								<?php
								if (strlen($this->escape($courseName)) > 65)
								{?>
									<a title="<?php echo $this->escape($courseName); ?>" href="<?php echo  $data['url']; ?>">
									<?php echo substr($this->escape($courseName), 0, 65) . '...'; ?>
								</a>
								<?php
								}
								else
								{?>
								<a title="<?php echo $this->escape($courseName); ?>" href="<?php echo  $data['url']; ?>">
									<?php echo $this->escape($courseName);?>
								</a>
								<?php
								}
								?>
							<?php }
							else {?>
								<div title="<?php echo $this->escape($courseName); ?>">
									<?php
									if (strlen($this->escape($courseName)) > 65)
									{?>
										<?php echo substr($this->escape($courseName), 0, 65) . '...'; ?>
									<?php
									}?>
								</div>
							<?php } ?>
						</h2>
						<p class="tjlmspin__caption_desc mt-2">
							<?php

							$short_desc_char = $comparams->get('pin_short_desc_char',350);

							if(strlen($data['short_desc']) >= $short_desc_char)
								echo substr($data['short_desc'], 0, $short_desc_char).'...';
							else
								echo $data['short_desc'];
							?>
						</p>
					</div>
				</div>
				<div class="col-lg-4 d-none d-lg-block">
					<?php if ($data['start_date'] <= $currentDateTime) {?>
						<div class="banner-event-card" title="<?php echo $this->escape($courseName); ?>" style="background-image:url('<?php echo $data['image'];?>');">
							<div class="content">
								<?php if ($data['start_date'] <= $currentDateTime){ ?>
									<?php
									if (strlen($this->escape($courseName)) > 65)
									{?>
										<a title="<?php echo $this->escape($courseName); ?>" href="<?php echo  $data['url']; ?>">
										<?php echo substr($this->escape($courseName), 0, 65) . '...'; ?>
									</a>
									<?php
									}
									else
									{?>
									<a title="<?php echo $this->escape($courseName); ?>" href="<?php echo  $data['url']; ?>">
										<?php echo $this->escape($courseName);?>
									</a>
									<?php
									}
									?>
								<?php }
								else {?>
									<div title="<?php echo $this->escape($courseName); ?>">
										<?php
										if (strlen($this->escape($courseName)) > 65)
										{?>
											<?php echo substr($this->escape($courseName), 0, 65) . '...'; ?>
										<?php
										}?>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php
					}?>
				</div>
			</div>
		</div>
	</div>
</div>
