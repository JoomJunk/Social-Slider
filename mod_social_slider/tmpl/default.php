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
	'facebook' 	 => $params->get('facebook'), 
	'twitter' 	 => $params->get('twitter'),
	'google' 	 => $params->get('google'),
	'myspace' 	 => $params->get('myspace'),
	'youtube' 	 => $params->get('youtube'),
	'linkedin' 	 => $params->get('linkedin'),
	'steam' 	 => $params->get('steam'),
	'lastfm' 	 => $params->get('lastfm'),
	'pinterest'  => $params->get('pinterest'),
	'soundcloud' => $params->get('soundcloud'),
	'tumblr' 	 => $params->get('tumblr'),
	'github' 	 => $params->get('github'),
	'flickr' 	 => $params->get('flickr'),
	'rss' 		 => $params->get('rss'),
	'vimeo' 	 => $params->get('vimeo')
);

echo '<ul id="jj_sl_navigation">';

foreach ( $slides as $key => $val )
{
	$uppercase = strtoupper($key);	
	if ($val == 1)
	{
		echo '<li class="' . $key . '"><a href="' . $params->get($key . '_link') . '"' . $target . '>' . JText::_('JJ_SOCIAL_SLIDER_VIA_' . $uppercase . '') . '</a></li>';
	}
}

echo '</ul>';
?>