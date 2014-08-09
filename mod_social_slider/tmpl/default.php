<?php
/**
* @package    JJ_Social_Slider
* @author     JoomJunk <admin@joomjunk.co.uk>
* @copyright  Copyright (C) 2011 - 2014 JoomJunk. All Rights Reserved
* @license    GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// No direct access
defined('_JEXEC')  or die('Restricted access');

JHtml::_('stylesheet', 'mod_social_slider/style.css', array(), true);

if ($params->get('tab', 0) == 0)
{
	$target = ' target="_blank"';
}
else
{
	$target = "";
}

echo '<ul id="jj_sl_navigation">';

$sorting = $params->get('sorting', 'sort_1,sort_2,sort_3,sort_4,sort_5,sort_6,sort_7,sort_8,sort_9,sort_10,sort_11,sort_12,sort_13,sort_14,sort_15,sort_16,sort_17,sort_18,sort_19,sort_20');
$order = explode(',', $sorting);

foreach ($order as $item)
{
	$parts = explode('_', $item);
	$key = $slides[$item];
	$uppercase = strtoupper($key);

	if ($params->get($key) == 1)
	{
		if ($parts[1] < 16)
		{
			echo '<li class="jj_sl_' . $key . '"><a href="' . $params->get($key . '_link') . '"' . $target . '><span class="jj_social_text">' . JText::_('JJ_SOCIAL_SLIDER_VIA_' . $uppercase . '') . '</span></a></li>';
		}
		else
		{
			echo '<li class="jj_sl_' . $key . '"><a href="' . $params->get($key . '_link') . '"' . $target . '><span class="jj_social_text">' . JText::_($params->get($key . '_text')) . '</span></a></li>';
		}
	}
}

echo '</ul>';
