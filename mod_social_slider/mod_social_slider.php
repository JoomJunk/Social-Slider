<?php
/**
* @package    JJ_Social_Slider
* @author     JoomJunk <admin@joomjunk.co.uk>
* @copyright  Copyright (C) 2011 - 2015 JoomJunk. All Rights Reserved
* @license    GPL v3.0 or later http://www.gnu.org/licenses/gpl-3.0.html
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

if ($params->get('position', 'left') == 'rtl')
{
	$RTL = JFactory::getLanguage()->isRTL();

	if ($RTL)
	{
		$position = 'right';
	}
	else
	{
		$position = 'left';
	}
}
else
{
	$position = $params->get('position', 'left');
}

$doc = JFactory::getDocument();

$slides = array(
	'sort_1' => 'facebook',
	'sort_2' => 'twitter',
	'sort_3' => 'google',
	'sort_4' => 'myspace',
	'sort_5' => 'youtube',
	'sort_6' => 'linkedin',
	'sort_7' => 'steam',
	'sort_8' => 'lastfm',
	'sort_9' => 'pinterest',
	'sort_10' => 'soundcloud',
	'sort_11' => 'tumblr',
	'sort_12' => 'github',
	'sort_13' => 'flickr',
	'sort_14' => 'rss',
	'sort_15' => 'vimeo',
	'sort_16' => 'custom1',
	'sort_17' => 'custom2',
	'sort_18' => 'custom3',
	'sort_19' => 'custom4',
	'sort_20' => 'custom5'
);

$css = '.jj_sl_navigation li a {
			background-color:' . $params->get('slide_colour') . ';
			text-align:' . $position . ';
			color:' . $params->get('text_colour') . ' !important;
		}
		.jj_sl_navigation .jj_sprite {
			background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/sprite-' . $params->get('icon_colour') . '.png);
		}';
		
if ($params->get('disable') == 1)
{
	$mobile = '@media screen and (max-width: ' . $params->get('mobile_width', '480px') . '){
					.jj_sl_navigation { display: none; }
				}';
	$doc->addStyleDeclaration($mobile);
}

if ($params->get('disable') == 2)
{
	$tablet = '@media screen and (max-width: ' . $params->get('tablet_width', '768px') . '){
					.jj_sl_navigation { display: none; }
				}';
	$doc->addStyleDeclaration($tablet);
}

if ($position == 'left')
{
	$css .= '.jj_sl_navigation { '
				. $params->get('top_bottom', 'top') . ':' . $params->get('top') . 'px;
			}';
}
else if ($position == 'right')
{
	$css .= '.jj_sl_navigation { '
				. $params->get('top_bottom', 'top') . ':' . $params->get('top') . 'px;
			}';
}

$css .= '.jj_sl_navigation .jj_sl_custom1 a:hover{
			background-color: ' . $params->get('custom1_colour') . ';
		 }
		 .jj_sl_navigation .jj_sl_custom2 a:hover{
			background-color: ' . $params->get('custom2_colour') . ';
		 }
		 .jj_sl_navigation .jj_sl_custom3 a:hover{
			background-color: ' . $params->get('custom3_colour') . ';
		 }
		 .jj_sl_navigation .jj_sl_custom4 a:hover{
			background-color: ' . $params->get('custom4_colour') . ';
		 }
		 .jj_sl_navigation .jj_sl_custom5 a:hover{
			background-color: ' . $params->get('custom5_colour') . ';
		 }';

foreach ($slides as $slide => $social)
{
	if (strpos($social, 'custom') !== false)
	{
		$css .= '
				.jj_sl_navigation .jj_sprite_custom.jj_' . $social . ' {
					background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get( $social . '_image') . ');
				}';
	}
}
		
$doc->addStyleDeclaration($css);

require JModuleHelper::getLayoutPath('mod_social_slider');
