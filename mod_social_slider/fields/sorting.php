<?php
/**
 * @package    JJ_Social_Slider
 * @author     JoomJunk <admin@joomjunk.co.uk>
 * @copyright  Copyright (C) 2011 - 2014 JoomJunk. All Rights Reserved
 * @license    GPL v3.0 or later http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Form Field class for JoomJunk.
 * Provides a jQuery UI drag and drop form field for the social slider fields
 *
 * @package     JJ_Social_Slider
 * @since       1.4.0
 */
class JFormFieldSorting extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.4.0
	 */
	protected $type = 'Sorting';

	/**
	 * Method to get the list field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   1.4.0
	 */
	protected function getInput()
	{
		$options = array(
			'sort_1' => JText::_('COM_MODULES_FACEBOOK_FIELDSET_LABEL'),
			'sort_2' => JText::_('COM_MODULES_TWITTER_FIELDSET_LABEL'),
			'sort_3' => JText::_('COM_MODULES_GOOGLES_FIELDSET_LABEL'),
			'sort_4' => JText::_('COM_MODULES_MYSPACE_FIELDSET_LABEL'),
			'sort_5' => JText::_('COM_MODULES_YOUTUBE_FIELDSET_LABEL'),
			'sort_6' => JText::_('COM_MODULES_LINKEDIN_FIELDSET_LABEL'),
			'sort_7' => JText::_('COM_MODULES_STEAM_FIELDSET_LABEL'),
			'sort_8' => JText::_('COM_MODULES_LASTFM_FIELDSET_LABEL'),
			'sort_9' => JText::_('COM_MODULES_PINTEREST_FIELDSET_LABEL'),
			'sort_10' => JText::_('COM_MODULES_SOUNDCLOUD_FIELDSET_LABEL'),
			'sort_11' => JText::_('COM_MODULES_TUMBLR_FIELDSET_LABEL'),
			'sort_12' => JText::_('COM_MODULES_GITHUB_FIELDSET_LABEL'),
			'sort_13' => JText::_('COM_MODULES_FLICKR_FIELDSET_LABEL'),
			'sort_14' => JText::_('COM_MODULES_RSS_FIELDSET_LABEL'),
			'sort_15' => JText::_('COM_MODULES_VIMEO_FIELDSET_LABEL'),
			'sort_16' => JText::_('COM_MODULES_CUSTOM1_FIELDSET_LABEL'),
			'sort_17' => JText::_('COM_MODULES_CUSTOM2_FIELDSET_LABEL'),
			'sort_18' => JText::_('COM_MODULES_CUSTOM3_FIELDSET_LABEL'),
			'sort_19' => JText::_('COM_MODULES_CUSTOM4_FIELDSET_LABEL'),
			'sort_20' => JText::_('COM_MODULES_CUSTOM5_FIELDSET_LABEL')
		);
		$doc = JFactory::getDocument();

		// Inject jQuery onto the page
		JHtml::_('jquery.framework');

		// Next insert the jQuery plugin
		JHtml::_('script', 'mod_social_slider/jquery-sortable.js', false, true);

		// Now initialize the plugin
		$doc->addScriptDeclaration('
			jQuery(document).ready(function($) {
				var group = $("#sortable").sortable({
					pullPlaceholder: false,
					onDrop: function (item, container, _super) {
						$("#' . $this->id . '").val(group.sortable("serialize").get().join("\n"))
						_super(item, container)
					},
					serialize: function (parent, children, isContainer) {
						return isContainer ? children.join() : parent.attr("id")
					},
				})
			});
		');

		// Add in relevant styles
		$icon = JUri::root() . 'media/mod_social_slider/icons/';
		$doc->addStyleDeclaration('
			body.dragging, body.dragging * {
			  cursor: move !important;
			}

			.dragged {
			  position: absolute;
			  opacity: 0.5;
			  z-index: 2000;
			}
			
			ul#sortable {
				float: left;
				list-style: none;
			}
			ul#sortable li {
				background: #ECECEC;
				border-color: #D8D8D8 #D8D8D8 #CCCCCC;
				border-style: solid;
				border-width: 1px;
				margin: 1px 0px;
				box-shadow: 0 2px 2px rgba(0, 0, 0, 0.027), 0 1px 0 rgba(255, 255, 255, 0.69) inset, 0 -1px 0 rgba(0, 0, 0, 0.02) inset, 0 15px 14px rgba(255, 255, 255, 0.57) inset;
				color: #666666;
				padding: 6px 50px 7px 5px;
				text-shadow: 0 1px 0 rgba(255, 255, 255, 0.59);
				cursor: move !important;
				text-align: center;
			}
			ul#sortable .sort span {
				position: relative;
				bottom: 2px;
				height: 20px;
				width: 20px;
				display: block;
				float: left;
				background-repeat: no-repeat !important;
				background-size: 20px 20px !important;
				padding-right: 25px;
				margin: 1px 0px;
			}
			ul#sortable #sort_1 span{background: url(' . $icon . 'facebook-black.png);}
			ul#sortable #sort_2 span{background: url(' . $icon . 'twitter-black.png);}
			ul#sortable #sort_3 span{background: url(' . $icon . 'google-black.png);}
			ul#sortable #sort_4 span{background: url(' . $icon . 'myspace-black.png);}
			ul#sortable #sort_5 span{background: url(' . $icon . 'youtube-black.png);}
			ul#sortable #sort_6 span{background: url(' . $icon . 'linkedin-black.png);}
			ul#sortable #sort_7 span{background: url(' . $icon . 'steam-black.png); }
			ul#sortable #sort_8 span{background: url(' . $icon . 'lastfm-black.png);}
			ul#sortable #sort_9 span{background: url(' . $icon . 'pinterest-black.png);}
			ul#sortable #sort_10 span{background: url(' . $icon . 'soundcloud-black.png);}
			ul#sortable #sort_11 span{background: url(' . $icon . 'tumblr-black.png);}
			ul#sortable #sort_12 span{background: url(' . $icon . 'github-black.png);}
			ul#sortable #sort_13 span{background: url(' . $icon . 'flickr-black.png);}
			ul#sortable #sort_14 span{background: url(' . $icon . 'rss-black.png);}
			ul#sortable #sort_15 span{background: url(' . $icon . 'vimeo-black.png);}
			ul#sortable #sort_16 span, ul#sortable #sort_17 span, ul#sortable #sort_18 span, ul#sortable #sort_19 span, ul#sortable #sort_20 span{background: url(' . $icon . 'custom-black.png);}
		');

		// If there is no value we'll set the default layout
		if (!$this->value)
		{
			$this->value = 'sort_1,sort_2,sort_3,sort_4,sort_5,sort_6,sort_7,sort_8,sort_9,sort_10,sort_11,sort_12,sort_13,sort_14,sort_15,sort_16,sort_17,sort_18,sort_19,sort_20';
		}

		// Explode the options
		$items = explode(',', $this->value);

		$input = '<ul id="sortable">';

		foreach ($items as $item)
		{
			$input .= '<li class="sort" id="' . $item . '"><span></span>' . $options[$item] . '</li>';
		}

		$input .= '</ul>
		<input type="hidden" name="' . $this->name . '" value="' . $this->value . '" id="' . $this->id . '" />';
		return $input;
	}
}
