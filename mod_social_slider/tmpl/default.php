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
?>

<ul id="jj_sl_navigation">
    <?php
		if ($params->get('facebook')==1) { ?><li class="facebook"><a href="<?php echo $params->get('facebook_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_FACEBOOK'); ?></a></li><?php }
		if ($params->get('twitter')==1) { ?><li class="twitter"><a href="<?php echo $params->get('twitter_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_TWITTER'); ?></a></li><?php }
		if ($params->get('google')==1) { ?><li class="google"><a href="<?php echo $params->get('google_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_GOOGLE'); ?></a></li><?php }
		if ($params->get('myspace')==1) { ?><li class="myspace"><a href="<?php echo $params->get('myspace_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_MYSPACE'); ?></a></li><?php }
		if ($params->get('youtube')==1) { ?><li class="youtube"><a href="<?php echo $params->get('youtube_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_YOUTUBE'); ?></a></li><?php }
		if ($params->get('linkedin')==1) { ?><li class="linkedin"><a href="<?php echo $params->get('linkedin_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_LINKEDIN'); ?></a></li><?php }
		if ($params->get('steam')==1) { ?><li class="steam"><a href="<?php echo $params->get('steam_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_STEAM'); ?></a></li><?php }
		if ($params->get('lastfm')==1) { ?><li class="lastfm"><a href="<?php echo $params->get('lastfm_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_LASTFM'); ?></a></li><?php }
		if ($params->get('pinterest')==1) { ?><li class="pinterest"><a href="<?php echo $params->get('pinterest_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_PINTEREST'); ?></a></li><?php }
		if ($params->get('soundcloud')==1) { ?><li class="soundcloud"><a href="<?php echo $params->get('soundcloud_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_SOUNDCLOUD'); ?></a></li><?php }
		if ($params->get('tumblr')==1) { ?><li class="tumblr"><a href="<?php echo $params->get('tumblr_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_TUMBLR'); ?></a></li><?php }
		if ($params->get('github')==1) { ?><li class="github"><a href="<?php echo $params->get('github_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_GITHUB'); ?></a></li><?php }
		if ($params->get('flickr')==1) { ?><li class="flickr"><a href="<?php echo $params->get('flickr_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_FLICKR'); ?></a></li><?php }
		if ($params->get('rss')==1) { ?><li class="rss"><a href="<?php echo $params->get('rss_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_RSS'); ?></a></li><?php }
		if ($params->get('vimeo')==1) { ?><li class="vimeo"><a href="<?php echo $params->get('vimeo_link'); ?>" <?php echo $target; ?>><?php echo JText::_('JJ_SOCIAL_SLIDER_VIA_VIMEO'); ?></a></li><?php }
		if ($params->get('custom1')==1) { ?><li class="custom1" style=""><a href="<?php echo $params->get('custom1_link'); ?>" <?php echo $target; ?>><?php echo $params->get('custom1_text'); ?></a></li><?php }
		if ($params->get('custom2')==1) { ?><li class="custom2"><a href="<?php echo $params->get('custom2_link'); ?>" <?php echo $target; ?>><?php echo $params->get('custom2_text'); ?></a></li><?php }
		if ($params->get('custom3')==1) { ?><li class="custom3"><a href="<?php echo $params->get('custom3_link'); ?>" <?php echo $target; ?>><?php echo $params->get('custom3_text'); ?></a></li><?php }
		if ($params->get('custom4')==1) { ?><li class="custom4"><a href="<?php echo $params->get('custom4_link'); ?>" <?php echo $target; ?>><?php echo $params->get('custom4_text'); ?></a></li><?php }
		if ($params->get('custom5')==1) { ?><li class="custom5"><a href="<?php echo $params->get('custom5_link'); ?>" <?php echo $target; ?>><?php echo $params->get('custom5_text'); ?></a></li><?php }
    ?>
</ul>


