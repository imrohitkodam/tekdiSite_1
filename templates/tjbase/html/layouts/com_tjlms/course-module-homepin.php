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

<div class="<?php //echo $data['pinclass'];?> course-card-pin float-start tjlmspin card-zoomin">
	<div class="p-0 br-0 tjlmspin__thumbnail h-100">
		<!--COURSE IMAGE PART-->
		<?php if ($data['start_date'] <= $currentDateTime) { ?>
			<a href="<?php echo  $data['url']; ?>"  class="center h-100 d-block" style="background-image:url('<?php echo $data['image'];?>');">
		<?php } ?>

		    <?php if ($data['start_date'] <= $currentDateTime) { ?>
			</a>
		<?php } ?>
	</div>
    <div class="card-section-bottom">
        <div class="caption">
            <div class="tjlmspin__caption">

                <?php if ($customFieldValues->imagefile){?>
                    <div class="mb-2">
						<img class="course-thumbnail-image" src="<?php echo $customFieldValues->imagefile;?>">
                    </div>
                <?php } ?>

                <h4 class="tjlmspin__caption_title">
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

                <div class="tjlmspin__caption_desc mb-2 d-none d-sm-block">
                    <?php

                        $short_desc_char = $comparams->get('pin_short_desc_char',150);

                        if(strlen($data['short_desc']) >= $short_desc_char)
                            echo substr($data['short_desc'], 0, $short_desc_char).'...';
                        else
                            echo $data['short_desc'];
                        ?>
                </div>
                <div class="d-lg-inline-block mb-1 start-date">
                    <img class="me-1" height="15" src="images/icons/calendar.svg" alt="calendar-icon"/>
                    <span class="align-text-top">
                        <?php echo HtmlHelper::date($data['start_date'], 'M d, Y, H:i a'); ?>
                        <?php //echo $data['start_date']; ?>
                    </span>
                </div>

                <div class="d-lg-inline-block mb-1 enrollment-count">
                    <?php if ($data['start_date'] <= $currentDateTime){ ?>
                    <div class="tjlmspin__users">
                        <?php if ($menuParams['pin_view_enrollments'] || $moduleParams->get('pin_view_enrollments')) {?>
                            <img class="me-1" height="12" src="images/icons/users.svg" alt="users-icon"/>
                            <span class="count align-text-top">
                                <?php echo $data['enrolled_users_cnt']. '  ' .Text::_('COM_TJLMS_ENROLLED_COUNT'); ?>
                            </span>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>

            </div>

            <?php if ($data['type'] != 0 && $data['displayPrice']) : ?>
                <small class="tjlmspin__position tjlmspin__price">
                        <?php
                            echo $data['displayPrice'];
                        ?>
                </small>
            <?php endif;?>
            <!-- <?php
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

                        if (File::exists($override . 'course-module-home.php'))
                        {
                            echo LayoutHelper::render('com_tjlms.course.course-module-home', $courseData);
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
                    <div class="pin__body--btn mb-15">
                        <?php
                        if (isset($enrollmentData->userEnrollment->state) && !$enrollmentData->userEnrollment->state)
                        {
                            ?>
                            <button title=""
                                class="btn btn-primary btn-inline-block disabled"
                                type="button"><?php echo Text::_('COM_TJLMS_COURSE_ENROLLMENT_PENDING_APPROVAL'); ?></button>
                            <?php
                        }
                        else
                        {
                            if ($data['start_date'] <= $currentDateTime)
                            {?>
                            <a class="btn btn-primary d-inline-block" href="<?php echo $data['url']; ?>">
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
            ?> -->
        </div>
    </div>
</div>
