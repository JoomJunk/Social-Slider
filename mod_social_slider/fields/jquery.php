<?php
/**
* @package    JJ_Social_Slider
* @author     JoomJunk <admin@joomjunk.co.uk>
* @copyright  Copyright (C) 2011 - 2013 JoomJunk. All Rights Reserved
* @license    GPL v3.0 or later http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for JoomJunk.
 * Provides radio button inputs for the jQuery insertation in Joomla 2.5 only
 *
 * @package     JJ_Social_Slider
 * @since       1.3.0
 */
class JFormFieldjQuery extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.3.0
	 */
	protected $type = 'jQuery';

	/**
	 * Method to get the list field input markup.
	 *
	 * @return  string  The field input markup if version is less than Joomla 3.0, else text string.
	 *
	 * @since   1.3.0
	 */
	protected function getInput()
	{
		if (version_compare(JVERSION,'3.0.0','ge'))
		{
			return '<span class="readonly">' . JText::_('JJ_SOCIAL_SLIDER_NOJQUERY_30') . '</span>';
		}
		else
		{
			return parent::getInput();
		}
	}

	/**
	 * Method to get the field options for radio buttons.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   1.3.0
	 */
	protected function getOptions()
	{
		$options = array();

		foreach ($this->element->children() as $option)
		{

			// Only add <option /> elements.
			if ($option->getName() != 'option')
			{
				continue;
			}

			// Create a new option object based on the <option /> element.
			$tmp = JHtml::_(
				'select.option', (string) $option['value'],
				JText::alt(trim((string) $option), preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)), 'value', 'text',
				((string) $option['disabled'] == 'true')
			);

			// Set some option attributes.
			$tmp->class = (string) $option['class'];

			// Set some JavaScript option attributes.
			$tmp->onclick = (string) $option['onclick'];

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		reset($options);

		return $options;
	}
}
