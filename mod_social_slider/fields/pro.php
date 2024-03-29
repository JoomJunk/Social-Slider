<?php
/**
 * @package    JJ_Social_Slider
 * @author     JoomJunk <admin@joomjunk.co.uk>
 * @copyright  Copyright (C) 2011 - 2021 JoomJunk. All Rights Reserved
 * @license    GPL v3.0 or later https://gnu.org/licenses/gpl-3.0.html
 */

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Factory;

/**
 * Notification for Pro version.
 *
 * @package     JJ_Social_Slider
 * @since       1.5.6
 */
class JFormFieldPro extends Joomla\CMS\Form\FormField
{
	/**
	 * @var string
	 */
	protected $type = 'Pro';

	/**
	 * @return string
	 */
	protected function getLabel()
	{
		$msg = '<h3>Love JJ Social Slider? Take a look at the <a href="https://joomjunk.co.uk/products/social-slider-pro.html" target="_blank" rel="noopener">Pro version</a> which is packed with many more features.</h3>';
		
        return Factory::getApplication()->enqueueMessage($msg, 'message');
	}

	/**
	 * @return mixed
	 */
	protected function getInput()
	{
        return;
	}
}
