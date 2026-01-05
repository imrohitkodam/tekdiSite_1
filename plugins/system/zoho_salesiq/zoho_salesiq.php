<?php
/*------------------------------------------------------------------------
# plg_zoho_salesiq - Zoho SalesIQ
# ------------------------------------------------------------------------
# author    SalesIQ Team
# copyright Copyright (C) 2023 zoho.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: https://salesiq.zoho.com
# Technical Support:  https://www.zoho.com/salesiq/help/
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

class plgSystemZoho_SalesIQ extends JPlugin 
{

	function __construct(&$subject, $config)
	{

		parent::__construct($subject, $config);
	}

	function onAfterRender()
	{
		$app = JFactory::getApplication();

		$format = $app->input->getCmd('format');
		$tmpl = $app->input->getCmd('tmpl');

		if ($format == 'raw' || $tmpl == 'component')
		{
			return;
		}

		$widget_code = $this->params->get('salesiq_widget_code', '');
		$salesiq_show = $this->params->get('salesiq_show', '0');

		$regex = preg_match("/^<script[^>]*>\s*.+\s*(float\.ls|.+widgetcode.+\/widget)\s*.+\s*<\/script>$/s", $widget_code);

		if ($widget_code == '' || $regex == 0 || $app->isClient('administrator'))
		{
			return;
		}

		if(!strpos($widget_code, "/widget?plugin_source"))
		{
			$widget_code = str_replace("/widget","/widget?plugin_source=joomla",$widget_code);
		}

		$mobile = $this->params->get('salesiq_mobile', 0);
		$tablet = $this->params->get('salesiq_tablet', 0);

		if(!class_exists('Mobile_Detect'))
		{
			require_once(dirname(__FILE__) . '/zoho_salesiq/mobile_detect/Mobile_Detect.php');
		}

		$detect = new Mobile_Detect();

		if($tablet || $mobile)
		{
			if($tablet && $detect->IsTablet())
			{
				$widget_code .= '<script> $zoho.salesiq.internalready = function() { $zoho.salesiq.floatbutton.visible("hide"); }</script>';
			}
			if($mobile && $detect->isMobile() && !$detect->isTablet())
			{
				$widget_code .= '<script> $zoho.salesiq.internalready = function() { $zoho.salesiq.floatbutton.visible("hide"); }</script>';
			}
		}
		if($detect->IsTablet() || $detect->isMobile())
		{
			$buffer = JFactory::getApplication()->getBody();
			$buffer = str_replace("</body>", $widget_code . "</body>", $buffer);
			JFactory::getApplication()->setBody($buffer);
			return true;
		}

		if($salesiq_show == 1)
		{
			$widget_code .= '<script> $zoho.salesiq.internalready = function() { $zoho.salesiq.floatbutton.visible("hide"); }</script>';
		}

		$buffer = JFactory::getApplication()->getBody();
		$buffer = str_replace("</body>", $widget_code . "</body>", $buffer);
		JFactory::getApplication()->setBody($buffer);
		return true;
	}

}

