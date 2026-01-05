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

<div class="<?php echo $data['pinclass'];?> tjlmspin courses-card mb-4">
	<div class="p-0 br-0 tjlmspin__thumbnail card-zoomin card-cover">
		<!--COURSE IMAGE PART-->
		<?php if ($customFieldValues->imagefile){?>
			<div class="thumbnail-cover">
				<img class="course-thumbnail-image" src="<?php echo $customFieldValues->imagefile;?>">
			</div>
		<?php } ?>
		<?php if ($data['start_date'] <= $currentDateTime) { ?>
			<a href="<?php echo  $data['url']; ?>"  class="center">
		<?php } ?>
			<div class="course-bg-img" title="<?php echo $this->escape($courseName); ?>" style="background-image:url('<?php echo $data['image'];?>');">
				<!-- Course category -->
				<?php /*  if ($menuParams['pin_view_category'] || $moduleParams->get('pin_view_category')) {?>
					<span class="tjlmspin__position tjlmspin__cat"><?php echo $this->escape($data['cat']); ?></span>
				<?php } */ ?>

			</div>
		<?php if ($data['start_date'] <= $currentDateTime) { ?>
			</a>
		<?php } ?>

		<!-- Course tags -->
		<?php if ($menuParams['pin_view_tags'] || $moduleParams->get('pin_view_tags'))
		{
			if (!empty($data['course_tags'])) {

				if (File::exists($override . 'coursepintags.php'))
				{
					echo LayoutHelper::render('com_tjlms.course.coursepintags', $data);
				}
				else
				{
					echo LayoutHelper::render('course.coursepintags', $data, JPATH_SITE . '/components/com_tjlms/layouts');
				}
			}
		}?>

		<div class="caption tjlmspin__caption p-4">
			<h4 class="course-title">
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
			</h4>

			<p class="tjlmspin__caption_desc">
				<?php

				$short_desc_char = $comparams->get('pin_short_desc_char',90);

				if(strlen($data['short_desc']) >= $short_desc_char)
					echo substr($data['short_desc'], 0, $short_desc_char).'...';
				else
					echo $data['short_desc'];
				?>
			</p>

			<?php if ($data['type'] != 0 && $data['displayPrice']) : ?>
				<small class="tjlmspin__position tjlmspin__price">
						<?php
							echo $data['displayPrice'];
						?>
				</small>
			<?php endif;?>
			<?php
					if (($data['allowBuy'] && !$allowCreator) || ($data['allowBuy'] && $allowCreator && $data['created_by'] != $user->id))
					{
						$courseData = array();
						$courseData['id'] = $data['id'];
						$courseData['title'] = $data['title'];
						$courseData['allowBuy'] = $data['allowBuy'];
						$courseData['checkPrerequisiteCourseStatus'] = $data['checkPrerequisiteCourseStatus'];

						if (File::exists($override . 'buy.php'))
						{
							echo LayoutHelper::render('com_tjlms.course.buy', $courseData);
						}
						else
						{
							echo LayoutHelper::render('course.buy', $courseData, JPATH_SITE . '/components/com_tjlms/layouts');
						}
					}
					elseif ($data['allowEnroll'])
					{
						if ($data['start_date'] <= $currentDateTime)
						{
							$courseData = array();
							$courseData['id'] = $data['id'];
							$courseData['title'] = $data['title'];
							$courseData['checkPrerequisiteCourseStatus'] = $data['checkPrerequisiteCourseStatus'];

							if (File::exists($override . 'enroll.php'))
							{
								echo LayoutHelper::render('com_tjlms.course.enroll', $courseData);
							}
							else
							{
								echo LayoutHelper::render('course.enroll', $courseData, JPATH_SITE . '/components/com_tjlms/layouts');
							}
						}
						else
						{?>
							<div class="text-center pb-10" style="color:black">
							<?php echo $enrolBtnText; ?>
							</div><?php
						}
					}
					else
					{
					?>
						<div class="pin__body--btn">
							<?php
							if (isset($enrollmentData->userEnrollment->state) && !$enrollmentData->userEnrollment->state)
							{
								?>
								<button title=""
									class="btn btn-primary btn-block disabled"
									type="button"><?php echo Text::_('COM_TJLMS_COURSE_ENROLLMENT_PENDING_APPROVAL'); ?></button>
								<?php
							}
							else
							{
								if ($data['start_date'] <= $currentDateTime)
								{?>
								<a class="btn btn-primary d-block" href="<?php echo $data['url']; ?>">
										<?php echo Text::_('COM_TJLMS_CONTINUE'); ?>
								</a>
							<?php }
								else
								{?>
									<div class="text-center pb-10" style="color:black">
									<?php echo $enrolBtnText; ?>
									</div><?php
								}
							}?>
						</div>
					<?php
					}
				?>
			</div>
	</div>
</div>
