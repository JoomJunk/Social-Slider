<?php
/**
 * @package    JJ_Social_Slider
 * @author     JoomJunk <admin@joomjunk.co.uk>
 * @copyright  Copyright (C) 2011 - 2021 JoomJunk. All Rights Reserved
 * @license    GPL v3.0 or later https://gnu.org/licenses/gpl-3.0.html
 */

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/**
 * Form Field separator for JoomJunk.
 *
 * @package     JJ_Social_Slider
 * @since       1.4.0
 */
class JFormFieldSep extends Joomla\CMS\Form\FormField
{
	/**
	 * @var string
	 */
	protected $type = 'Sep';

	/**
	 * @return string
	 */
	protected function getLabel()
	{
        Factory::getDocument()->addStyleDeclaration(".jj-sep { border-bottom:1px solid #eee;font-size:1rem;color:#BD362F;margin-top:15px;padding:2px 0;width:100% }");

        $label = Text::_((string)$this->element['label']);
        $css   = (string)$this->element['class'];

        return '<div class="jj-sep ' . $css . '">' . $label . '</div>';
	}

	/**
	 * @return mixed
	 */
	protected function getInput()
	{
        return;
	}
}
