<?php
/**
 * @package    JJ_Social_Slider
 * @author     JoomJunk <admin@joomjunk.co.uk>
 * @copyright  Copyright (C) 2011 - 2021 JoomJunk. All Rights Reserved
 * @license    GPL v3.0 or later https://gnu.org/licenses/gpl-3.0.html
 */

// No direct access
defined('_JEXEC')  or die('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('stylesheet', 'mod_social_slider/style.css', ['version' => 'auto', 'relative' => true]);

$target = '';
$nofollow = '';

if ($params->get('tab', 0) == 0)
{
	$target = ' target="_blank"';
}

if ($params->get('nofollow', 0) == 1)
{
	$nofollow = ' rel="nofollow"';
}

echo '<ul class="jj_sl_navigation jj_transition ' . $position . '">';

$sorting 	= $params->get('sorting', 'sort_1,sort_2,sort_3,sort_4,sort_5,sort_6,sort_7,sort_8,sort_9,sort_10,sort_11,sort_12,sort_13,sort_14,sort_15,sort_16,sort_17,sort_18,sort_19,sort_20');
$order 		= explode(',', $sorting);

foreach ($order as $item)
{
	$parts 	= explode('_', $item);
	$key 	= $slides[$item];

	if ($params->get($key) == 1)
	{
		if ($parts[1] < 16)
		{
			echo '<li class="jj_sl_' . $key . '">';
			echo '<a href="' . $params->get($key . '_link') . '"' . $target . $nofollow . '>';
			echo '<span class="jj_social_text">' . Text::_('JJ_SOCIAL_SLIDER_VIA_' . strtoupper($key) . '') . '</span>';
			echo '<span class="jj_sprite jj_' . $key . '"></span>';
			echo '</a>';
			echo '</li>';
		}
		else
		{
			echo '<li class="jj_sl_' . $key . '">';
			echo '<a href="' . $params->get($key . '_link') . '"' . $target .  $nofollow . '>';
			echo '<span class="jj_social_text">' . Text::_($params->get($key . '_text')) . '</span>';
			echo '<span class="jj_sprite_custom jj_' . $key . '"></span>';
			echo '</a>';
			echo '</li>';
		}
	}
}

echo '</ul>';
