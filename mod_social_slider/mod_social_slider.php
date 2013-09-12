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
				$document->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
			}
		}
		elseif ($params->get('jquery') == 1)
		{
			if (!JFactory::getApplication()->get('jquery'))
			{
				JFactory::getApplication()->set('jquery', true);
				$document->addScript(JUri::root() . "media/mod_social_slider/js/jquery.js");
			}
		}
	}
}

$style1 = 'ul#jj_sl_navigation li a {'
		. 'background-color:' . $params->get('slide_colour') . ';'
		. 'text-align:' . $position . ';'
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

	if ($params->get('jquery_css') == 1)
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

	$style = 'ul#jj_sl_navigation { '
		. $position . ':0px;'
		. 'top:' . $params->get('top') . 'px;'
		. '}'
		. 'ul#jj_sl_navigation li:hover { '
		. 'margin-left: 0px;'
		. '}'
		. 'ul#jj_sl_navigation li a { '
		. 'padding: 11px 0px 11px 10px;'
		. 'margin-left: -2px;'
		. '}'
		. 'ul#jj_sl_navigation .facebook a {'
		. 'background-position: 144px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/facebook-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .twitter a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/twitter-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .google a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/google-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .myspace a {'
		. 'background-position: 144px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/myspace-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .youtube a {'
		. 'background-position: 144px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/youtube-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .linkedin a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/linkedin-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .steam a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/steam-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .lastfm a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/lastfm-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .pinterest a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/pinterest-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .soundcloud a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/soundcloud-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .tumblr a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/tumblr-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .github a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/github-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .flickr a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/flickr-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .rss a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/rss-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .vimeo a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/vimeo-' . $params->get('icon_colour') . '.png);'
		. '}'
		. 'ul#jj_sl_navigation .custom1 a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom1_image') . ');'
		. '}'
		. 'ul#jj_sl_navigation .custom2 a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom2_image') . ');'
		. '}'
		. 'ul#jj_sl_navigation .custom3 a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom3_image') . ');'
		. '}'
		. 'ul#jj_sl_navigation .custom4 a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom4_image') . ');'
		. '}'
		. 'ul#jj_sl_navigation .custom5 a {'
		. 'background-position: 145px 50%;'
		. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom5_image') . ');'
		. '}';
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

	if ($params->get('jquery_css') == 1)
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

$style = 'ul#jj_sl_navigation { '
			. $position . ':0px;'
			. 'top:' . $params->get('top') . 'px;'
			. '}'
			. 'ul#jj_sl_navigation li:hover { '
			. 'right: 0px;'
			. '}'
			. 'ul#jj_sl_navigation li a { '
			. 'padding: 11px 10px 11px 0px;'
			. '}'
			. 'ul#jj_sl_navigation .facebook a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/facebook-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .twitter a {'
			. 'background-position: 5px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/twitter-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .google a {'
			. 'background-position: 5px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/google-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .myspace a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/myspace-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .youtube a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/youtube-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .linkedin a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/linkedin-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .steam a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/steam-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .lastfm a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/lastfm-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .pinterest a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/pinterest-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .soundcloud a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/soundcloud-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .tumblr a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/tumblr-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .github a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/github-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .flickr a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/flickr-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .rss a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/rss-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .vimeo a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/vimeo-' . $params->get('icon_colour') . '.png);'
			. '}'
			. 'ul#jj_sl_navigation .custom1 a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom1_image') . ');'
			. '}'
			. 'ul#jj_sl_navigation .custom2 a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom2_image') . ');'
			. '}'
			. 'ul#jj_sl_navigation .custom3 a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom3_image') . ');'
			. '}'
			. 'ul#jj_sl_navigation .custom4 a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom4_image') . ');'
			. '}'
			. 'ul#jj_sl_navigation .custom5 a {'
			. 'background-position: 4px 50%;'
			. 'background-image: url(' . JUri::root() . 'media/mod_social_slider/icons/' . $params->get('custom5_image') . ');'
			. '}';
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
