<?php
/**
* @package    JJ_Social_Slider
* @author     JoomJunk <admin@joomjunk.co.uk>
* @copyright  Copyright (C) 2011 - 2013 JoomJunk. All Rights Reserved
* @license    GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// No direct access
defined('_JEXEC')  or die('Restricted access');

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root() . "modules/mod_social_slider/assets/style.css");

if ($params->get('tab', 0) == 0)
{
	$target = 'target="_blank"';
}
else
{
	$target = "";
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
);

echo '<ul id="jj_sl_navigation">';

$sorting = $params->get('sorting');
$order = explode(',', $sorting);

foreach ($order as $item)
{
	$parts = explode('_', $item);

	if ($parts[1] < 16)
	{
		$key = $slides[$item];
		$uppercase = strtoupper($key);

		if ($params->get($key) == 1)
		{
			echo '<li class="' . $key . '"><a href="' . $params->get($key . '_link') . '"' . $target . '>' . JText::_('JJ_SOCIAL_SLIDER_VIA_' . $uppercase . '') . '</a></li>';
		}
	}
}

echo '</ul>';
