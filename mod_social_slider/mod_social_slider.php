<?php
/**
* @package    JJ_Social_Slider
* @author     JoomJunk <admin@joomjunk.co.uk>
* @copyright  Copyright (C) 2011 - 2013 JoomJunk. All Rights Reserved
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

$document = JFactory::getDocument();

if ($params->get('jquery_css') == 0)
{
	if (version_compare(JVERSION, '3.0.0', 'ge'))
	{
		JHtml::_('jquery.framework');
	}
	else
	{
		if ($params->get('jquery') == 0)
		{
			if (!JFactory::getApplication()->get('jquery'))
			{
				JFactory::getApplication()->set('jquery', true);
				$document->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js");
			}
		}
		elseif ($params->get('jquery') == 1)
		{
			if (!JFactory::getApplication()->get('jquery'))
			{
				JFactory::getApplication()->set('jquery', true);
				JHtml::_('script', JUri::root() . 'media/mod_social_slider/js/jquery.js');
			}
		}
	}
}

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
$style1 = 'ul#jj_sl_navigation li a {'
		. 'background-color:' . $params->get('slide_colour') . ';'
		. 'text-align:' . $position . ';'
		. 'color:' . $params->get('text_colour') . ' !important;'
		. '}';
$document->addStyleDeclaration($style1);

if ($params->get('disable') == 1)
{
	$mobile = '@media screen and (max-width: ' . $params->get("mobile_width", "480px") . '){'
		. 'ul#jj_sl_navigation { display: none; }'
		. '}';
	$document->addStyleDeclaration($mobile);
}

if ($params->get('disable') == 2)
{
	$mobile_tablet = '@media screen and (max-width: ' . $params->get("tablet_width", "768px") . '){'
		. 'ul#jj_sl_navigation { display: none; }'
		. '}';
	$document->addStyleDeclaration($mobile_tablet);
}

if ($position == "left")
{
	if ($params->get('jquery_css') == 0)
	{
		$js_left = '
		(function($){
			$(function() {
				$("#jj_sl_navigation a").css("marginLeft", "-140px")
				$("#jj_sl_navigation > li").hover(
					function () {
						$("a",$(this)).stop().animate({"marginLeft":"-2px"},200);
					},
					function () {
						$("a",$(this)).stop().animate({"marginLeft":"-140px"},200);
					}
				);
			});
		})(jQuery);
		';
		$css = '';
		$document->addScriptDeclaration($js_left);
	}

	else
	{
		$css = 'ul#jj_sl_navigation li { '
			. 'margin-left: -140px;'
			. '-webkit-transition: margin-left 0.3s;'
			. '-moz-transition: margin-left 0.3s;'
			. '-ms-transition: margin-left 0.3s;'
			. '-o-transition: margin-left 0.3s;'
			. 'transition: margin-left 0.3s;'
			. '}';
	}
	$style = "";        
        $style .= 'ul#jj_sl_navigation { '
        . $position . ':0px;'
        . $params->get('top_bottom') . ':' . $params->get('top') . 'px;'
        . '}'
        . 'ul#jj_sl_navigation li:hover { '
        . 'margin-left: 0px;'
        . '}'
        . 'ul#jj_sl_navigation li a { '
        . 'padding: 11px 0px 11px 10px;'
        . 'margin-left: -2px;'
        . '}';
        foreach ($slides as $slide => $social){
                if (strpos($social, "custom") === false)
                {
                        $style .= 'ul#jj_sl_navigation .' . $social . ' a {
                                background-position: 144px 50%;
                                background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $social . '-' . $params->get('icon_colour') . '.png);
                         }';
                }
                else
                {
                        $style .= 'ul#jj_sl_navigation .' . $social . ' a {
                                background-position: 144px 50%;
                                background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get( $social . '_image') . ');
                         }';
                }
        }
}
elseif ($position == "right")
{
	if ($params->get('jquery_css') == 0)
	{
		$js_right = '
		(function($){
			$(function() {
				$("#jj_sl_navigation a").css("marginLeft", "140px")
				$("#jj_sl_navigation > li").hover(
					function () {
						$("a",$(this)).stop().animate({"marginLeft":"2px"},200);
					},
					function () {
						$("a",$(this)).stop().animate({"marginLeft":"140px"},200);
					}
				);
			});
		})(jQuery);
		';
		$css = 'ul#jj_sl_navigation li {position: relative;} ul#jj_sl_navigation{right: -140px;}';
		$document->addScriptDeclaration($js_right);
	}

	else
	{
		$css = 'ul#jj_sl_navigation li { '
			. 'right: -138px;'
			. 'position:relative;'
			. '-webkit-transition: right 0.3s;'
			. '-moz-transition: right 0.3s;'
			. '-ms-transition: right 0.3s;'
			. '-o-transition: right 0.3s;'
			. 'transition: right 0.3s;'
			. '}';
	}
	
	$style = "";
        $style .= 'ul#jj_sl_navigation { '
                . $position . ':0px;'
                . $params->get('top_bottom') . ':' . $params->get('top') . 'px;'
                . '}'
                . 'ul#jj_sl_navigation li:hover { '
                . 'right: 0px;'
                . '}'
                . 'ul#jj_sl_navigation li a { '
                . 'padding: 11px 10px 11px 0px;'
                . '}';
        foreach ($slides as $slide => $social){
                if (strpos($social, "custom") === false)
                {
                        $style .= 'ul#jj_sl_navigation .' . $social . ' a {
                                background-position: 4px 50%;
                                background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $social . '-' . $params->get('icon_colour') . '.png);
                         }';
                }
                else
                {
                        $style .= 'ul#jj_sl_navigation .' . $social . ' a {
                                background-position: 4px 50%;
                                background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get( $social . '_image') . ');
                         }';
                }
        }
}

$custom_css = 'ul#jj_sl_navigation .custom1 a:hover{
				background-color: ' . $params->get('custom1_colour') . ';
			   }
			   ul#jj_sl_navigation .custom2 a:hover{
				background-color: ' . $params->get('custom2_colour') . ';
			   }
			   ul#jj_sl_navigation .custom3 a:hover{
				background-color: ' . $params->get('custom3_colour') . ';
			   }
			   ul#jj_sl_navigation .custom4 a:hover{
				background-color: ' . $params->get('custom4_colour') . ';
			   }
			   ul#jj_sl_navigation .custom5 a:hover{
				background-color: ' . $params->get('custom5_colour') . ';
			   }';
$document->addStyleDeclaration($custom_css);
$document->addStyleDeclaration($style);
$document->addStyleDeclaration($css);

require JModuleHelper::getLayoutPath('mod_social_slider');
