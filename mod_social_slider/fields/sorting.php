<?php
/**
 * @package    JJ_Social_Slider
 * @author     JoomJunk <admin@joomjunk.co.uk>
 * @copyright  Copyright (C) 2011 - 2013 JoomJunk. All Rights Reserved
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
			1 => JText::_('COM_MODULES_FACEBOOK_FIELDSET_LABEL'),
			2 => JText::_('COM_MODULES_TWITTER_FIELDSET_LABEL'),
			3 => JText::_('COM_MODULES_GOOGLES_FIELDSET_LABEL'),
			4 => JText::_('COM_MODULES_MYSPACE_FIELDSET_LABEL'),
			5 => JText::_('COM_MODULES_YOUTUBE_FIELDSET_LABEL'),
			6 => JText::_('COM_MODULES_LINKEDIN_FIELDSET_LABEL'),
			7 => JText::_('COM_MODULES_STEAM_FIELDSET_LABEL'),
			8 => JText::_('COM_MODULES_LASTFM_FIELDSET_LABEL'),
			9 => JText::_('COM_MODULES_PINTEREST_FIELDSET_LABEL'),
			10 => JText::_('COM_MODULES_SOUNDCLOUD_FIELDSET_LABEL'),
			11 => JText::_('COM_MODULES_TUMBLR_FIELDSET_LABEL'),
			12 => JText::_('COM_MODULES_GITHUB_FIELDSET_LABEL'),
			13 => JText::_('COM_MODULES_FLICKR_FIELDSET_LABEL'),
			14 => JText::_('COM_MODULES_RSS_FIELDSET_LABEL'),
			15 => JText::_('COM_MODULES_VIMEO_FIELDSET_LABEL'),
		);
		$document = JFactory::getDocument();

		// Inject jQuery onto the page
		if (version_compare(JVERSION, '3.0.0', 'ge'))
		{
			JHtml::_('jquery.framework');
		}
		else
		{
			$document->addScript(JUri::root() . 'modules/mod_social_slider/assets/jquery.js');
		}

		// Next insert the jQuery plugin
		$document->addScript(JUri::root() . 'modules/mod_social_slider/assets/jquery-sortable-min.js');

		// Now initialize the plugin
		$document->addScriptDeclaration('
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

		// Add in relevent styles
		$document->addStyleDeclaration('
			body.dragging, body.dragging * {
			  cursor: move !important;
			}

			.dragged {
			  position: absolute;
			  opacity: 0.5;
			  z-index: 2000;
			}

			ol.example li.placeholder {
			  position: relative;
			  /** More li styles **/
			}
			ol.example li.placeholder:before {
			  position: absolute;
			  /** Define arrowhead **/
			}
		');

		echo '<ul id="sortable">';
		  foreach ($options as $key => $val)
		  {
			  echo '<li id="' . $key . '">' . $val . '</li>';
		  }
		echo '</ul>
		<input type="hidden" name="' . $this->name . '" value="' . $this->value . '" id="' . $this->id . '" />';
	}
}
