<?php
/**
 * @package    JJ_Social_Slider
 * @author     JoomJunk <admin@joomjunk.co.uk>
 * @copyright  Copyright (C) 2011 - 2021 JoomJunk. All Rights Reserved
 * @license    GPL v3.0 or later https://gnu.org/licenses/gpl-3.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Uri\Uri;

/**
 * Social Slider installation script class.
 *
 * @since  1.3.3
 */
class Mod_Social_SliderInstallerScript
{
	/**
	 * @var		string	The version number of the module.
	 * @since   1.3.3
	 */
	protected $release = '';

	/**
	 * @var		string	The table the parameters are stored in.
	 * @since   1.3.3
	 */
	protected $paramTable = '#__modules';

	/**
	 * @var		string	The extension name.
	 * @since   1.3.3
	 */
	protected $extension = 'mod_social_slider';

	/**
	 * Function called before module installation/update/removal procedure commences
	 *
	 * @param   string                   $type    The type of change (install, update or discover_install
	 *                                            , not uninstall)
	 * @param   JInstallerAdapterModule  $parent  The class calling this method
	 *
	 * @return  void
	 *
	 * @since  1.3.3
	 */
	public function preflight($type, $parent)
	{
		// Module manifest file version
		if (version_compare(JVERSION, '3.999.999', 'gt'))
		{
			$this->release = $parent->manifest->version;
		}
		else
		{
			$this->release = $parent->get('manifest')->version;
		}

		// Abort if the module being installed is not newer than the currently installed version
		if (strtolower($type) == 'update')
		{
			$manifest = $this->getItemArray('manifest_cache', '#__extensions', 'element', Factory::getDbo()->quote($this->extension));
			$oldRelease = $manifest['version'];

			if (version_compare($oldRelease, $this->release, '<'))
			{
				// Update to reflect colour form field change in 1.3.2
				if (version_compare($oldRelease, '1.3.2', '<='))
				{
					$this->update132();
				}

				// Update to reflect move from assets subfolder to media folder
				if (version_compare($oldRelease, '1.4.0', '<='))
				{
					$this->update140();
				}
			}
		}
	}

	/**
	 * Gets each instance of a module in the #__modules table
	 * For all other extensions see alternate query
	 *
	 * @param   boolean  $isModule  True if the extension is a module as this can have multiple instances
	 *
	 * @return  array  An array of ID's of the extension
	 *
	 * @since  1.3.3
	 * @see getExtensionInstance
	 */
	protected function getInstances($isModule)
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true);

		// Select the item(s) and retrieve the id
		$query->select($db->qn('id'));

		if ($isModule)
		{
			$query->from($db->qn('#__modules'))
				->where($db->qn('module') . ' = ' . $db->q($this->extension));
		}
		else
		{
			$query->from($db->qn('#__extensions'))
				->where($db->qn('element') . ' = ' . $db->q($this->extension));
		}

		// Set the query and obtain an array of id's
		$db->setQuery($query);
		$items = $db->loadColumn();

		return $items;
	}

	/**
	 * Gets parameter value in the extensions row of the extension table
	 *
	 * @param   string   $name  The name of the parameter to be retrieved
	 * @param   integer  $id    The id of the item in the Param Table
	 *
	 * @return  string  The parameter desired
	 *
	 * @since 1.3.3
	 */
	protected function getParam($name, $id = 0)
	{
		if (!is_int($id) || $id == 0)
		{
			// Return false if there is no item given
			return false;
		}

		$params = $this->getItemArray('params', $this->paramTable, 'id', $id);

		return $params[$name];
	}

	/**
	 * Sets parameter values in the extensions row of the extension table. Note that the
	 * this must be called separately for deleting and editing. Note if edit is called as a
	 * type then if the param doesn't exist it will be created
	 *
	 * @param   array    $param_array  The array of parameters to be added/edited/removed
	 * @param   string   $type         The type of change to be made to the param (edit/remove)
	 * @param   integer  $id           The id of the item in the relevant table
	 *
	 * @return  mixed  false on failure, void otherwise
	 */
	protected function setParams($param_array = null, $type = 'edit', $id = 0)
	{
		if (!is_int($id) || $id == 0)
		{
			// Return false if there is no valid item given
			return false;
		}

		$params = $this->getItemArray('params', $this->paramTable, 'id', $id);

		if ($param_array)
		{
			foreach ($param_array as $name => $value)
			{
				if ($type === 'edit')
				{
					// Add or edit the new variable(s) to the existing params
					if (is_array($value))
					{
						// Convert an array into a json encoded string
						$params[(string) $name] = array_values($value);
					}
					else
					{
						$params[(string) $name] = (string) $value;
					}
				}
				elseif ($type === 'remove')
				{
					// Unset the parameter from the array
					unset($params[(string) $name]);
				}
			}
		}

		// Store the combined new and existing values back as a JSON string
		$paramsString = json_encode($params);

		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->update($db->qn($this->paramTable))
			->set('params = ' . $db->q($paramsString))
			->where('id = ' . $id);

		// Update table
		$db->setQuery($query);
		$db->execute();

		return true;
	}

	/**
	 * Builds a standard select query to produce better DRY code in this script.
	 * This should produce a single unique cell which is json encoded
	 *
	 * @param   string  $element     The element to get from the query
	 * @param   string  $table       The table to search for the data in
	 * @param   string  $column      The column of the database to search from
	 * @param   mixed   $identifier  The integer id or the already quoted string
	 *
	 * @return  array  associated array containing data from the cell
	 *
	 * @since 1.3.3
	 */
	protected function getItemArray($element, $table, $column, $identifier)
	{
		// Get the DB and query objects
		$db = Factory::getDbo();
		$query = $db->getQuery(true);

		// Build the query
		$query->select($db->qn($element))
			->from($db->qn($table))
			->where($db->qn($column) . ' = ' . $identifier);
		$db->setQuery($query);

		// Load the single cell and json_decode data
		$array = json_decode($db->loadResult(), true);

		return $array;
	}

	/**
	 * Function to update the params for the Social Slider Version 1.3.2 updates
	 *
	 * @return  void
	 *
	 * @since  1.3.3
	 */
	protected function update132()
	{
		/*
		 * We have moved to use the colour form field so a hash must be applied
		 * to the parameters for them to function as expected still.
		 */
		$modules = $this->getInstances(true);

		foreach ($modules as $module)
		{
			// Convert string to integer
			$module = (int) $module;

			// Create array of params to change
			$colours = [];
			$colours['slide_colour'] = '#' . $this->getParam('slide_colour', $module);

			// Set the param values
			$this->setParams($colours, 'edit', $module);

			// Unset the array for the next loop
			unset($colours);
		}
	}


	/**
	 * Function to update the file structure for the Social Slider Version 1.4.0 updates
	 *
	 * @return  void
	 *
	 * @since  1.4.0
	 */
	protected function update140()
	{
		// Move the assets and add index.html files to new directory
		if (Folder::create('media/' . $this->extension)
			&& Folder::move(Uri::root() . 'modules/'. $this->extension . '/assets/icons', Uri::root() . 'media/'. $this->extension)
			&& File::move(Uri::root() . 'modules/'. $this->extension . '/assets/index.html', Uri::root() . 'media/'. $this->extension . '/index.html')
			&& File::move(Uri::root() . 'modules/'. $this->extension . '/assets/jquery-sortable-min.js', Uri::root() . 'media/'. $this->extension . '/js/jquery-sortable-min.js')
			&& File::move(Uri::root() . 'modules/'. $this->extension . '/assets/jquery-sortable.js', Uri::root() . 'media/'. $this->extension . '/js/jquery-sortable.js')
			&& File::move(Uri::root() . 'modules/'. $this->extension . '/assets/jquery.js', Uri::root() . 'media/'. $this->extension . '/js/jquery.js')
			&& File::move(Uri::root() . 'modules/'. $this->extension . '/assets/style.css', Uri::root() . 'media/'. $this->extension . '/css/style.css')
			&& File::move(Uri::root() . 'modules/'. $this->extension . '/assets/index.html', Uri::root() . 'media/'. $this->extension . '/js/index.html')
			&& File::move(Uri::root() . 'modules/'. $this->extension . '/assets/index.html', Uri::root() . 'media/'. $this->extension . '/css/index.html'))
		{
			// We can now delete the folder
			Folder::delete(JPATH_ROOT . '/modules/'. $this->extension . '/assets');
		}
	}
}
