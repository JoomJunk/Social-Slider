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

		echo '
		<ul id="sortable">
		  <li id="1">Facebook</li>
		  <li id="2">Twitter</li>
		  <li id="3">Linked-In</li>
		  <li id="4">GitHub</li>
		  <li id="5">Google +</li>
		  <li id="6">Flickr</li>
		  <li id="7">RSS</li>
		</ul>
		<input type="hidden" name="' . $this->name . '" value="' . $this->value . '" id="' . $this->id . '" />';
	}
}
