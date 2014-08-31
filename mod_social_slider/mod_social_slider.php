<?php
/**
* @package    JJ_Social_Slider
* @author     JoomJunk <admin@joomjunk.co.uk>
* @copyright  Copyright (C) 2011 - 2014 JoomJunk. All Rights Reserved
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

$css = "";

$css .= 'ul#jj_sl_navigation li a {'
		. 'background-color:' . $params->get('slide_colour') . ';'
		. 'text-align:' . $position . ';'
		. 'color:' . $params->get('text_colour') . ' !important;'
		. '}';
		
if ($params->get('disable') == 1)
{
	$mobile = '@media screen and (max-width: ' . $params->get("mobile_width", "480px") . '){'
		. 'ul#jj_sl_navigation { display: none; }'
		. '}';
	$doc->addStyleDeclaration($mobile);
}

if ($params->get('disable') == 2)
{
	$mobile_tablet = '@media screen and (max-width: ' . $params->get("tablet_width", "768px") . '){'
		. 'ul#jj_sl_navigation { display: none; }'
		. '}';
	$doc->addStyleDeclaration($mobile_tablet);
}

if ($position == "left")
{

	$css .= 'ul#jj_sl_navigation li { '
		. 'left: 0;'
		. 'position:relative;'
		. '-webkit-transition: left 0.3s;'
		. '-moz-transition: left 0.3s;'
		. '-ms-transition: left 0.3s;'
		. '-o-transition: left 0.3s;'
		. 'transition: left 0.3s;'
	. '}';
      
	$css .= 'ul#jj_sl_navigation { '
		. $position . ': -140px;'
		. $params->get('top_bottom', 'top') . ':' . $params->get('top') . 'px;'
		. '}'
		. 'ul#jj_sl_navigation li:hover { '
		. 'left: 140px;'
		. '}'
		. 'ul#jj_sl_navigation li a { '
		. 'padding: 11px 0px 11px 10px;'
		. 'margin-left: -2px;'
	. '}';
	
	foreach ($slides as $slide => $social){
		if (strpos($social, "custom") === false)
		{
			$css .= 'ul#jj_sl_navigation .jj_sl_' . $social . ' a {
					background-position: 144px 50%;
					background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $social . '-' . $params->get('icon_colour') . '.png);
			 }';
		}
		else
		{
			$css .= 'ul#jj_sl_navigation .jj_sl_' . $social . ' a {
					background-position: 144px 50%;
					background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get( $social . '_image') . ');
			 }';
		}
	}
}
elseif ($position == "right")
{

	$css .= 'ul#jj_sl_navigation li { '
		. 'right: 0;'
		. 'position:relative;'
		. '-webkit-transition: right 0.3s;'
		. '-moz-transition: right 0.3s;'
		. '-ms-transition: right 0.3s;'
		. '-o-transition: right 0.3s;'
		. 'transition: right 0.3s;'
	. '}';

	$css .= 'ul#jj_sl_navigation { '
		. $position . ':-140px;'
		. $params->get('top_bottom', 'top') . ':' . $params->get('top') . 'px;'
		. '}'
		. 'ul#jj_sl_navigation li:hover { '
		. 'right: 140px;'
		. '}'
		. 'ul#jj_sl_navigation li a { '
		. 'padding: 11px 10px 11px 0px;'
	. '}';
	
	foreach ($slides as $slide => $social){
		if (strpos($social, "custom") === false)
		{
			$css .= 'ul#jj_sl_navigation .jj_sl_' . $social . ' a {
					background-position: 4px 50%;
					background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $social . '-' . $params->get('icon_colour') . '.png);
			 }';
		}
		else
		{
			$css .= 'ul#jj_sl_navigation .jj_sl_' . $social . ' a {
					background-position: 4px 50%;
					background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get( $social . '_image') . ');
			 }';
		}
	}
}

$css .= 'ul#jj_sl_navigation .jj_sl_custom1 a:hover{
			background-color: ' . $params->get('custom1_colour') . ';
		   }
		   ul#jj_sl_navigation .jj_sl_custom2 a:hover{
			background-color: ' . $params->get('custom2_colour') . ';
		   }
		   ul#jj_sl_navigation .jj_sl_custom3 a:hover{
			background-color: ' . $params->get('custom3_colour') . ';
		   }
		   ul#jj_sl_navigation .jj_sl_custom4 a:hover{
			background-color: ' . $params->get('custom4_colour') . ';
		   }
		   ul#jj_sl_navigation .jj_sl_custom5 a:hover{
			background-color: ' . $params->get('custom5_colour') . ';
		}';
		
$doc->addStyleDeclaration($css);

require JModuleHelper::getLayoutPath('mod_social_slider');
