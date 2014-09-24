<?php
/**
 * @version		$Id: router.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Function to build a Users URL route.
 *
 * @param	array	The array of query string values for which to build a route.
 * @return	array	The URL route with segments represented as an array.
 * @since	1.5
 */
function SocialLoginAndSocialShareBuildRoute(&$query)
{
	// Declare static variables.
	static $items;
	static $default;
	static $registration;
	static $profile;
	

	// Initialise variables.
	$segments = array();

	// Get the relevant menu items if not loaded.
	if (empty($items)) {
		// Get all relevant menu items.
		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();
		$items	= $menu->getItems('component', 'com_users');

		// Build an array of serialized query strings to menu item id mappings.
		for ($i = 0, $n = count($items); $i < $n; $i++) {

			// Check to see if we have found the profile menu item.
			if (empty($profile) && !empty($items[$i]->query['view']) && ($items[$i]->query['view'] == 'profile')) {
			$profile = $items[$i]->id;
			}
		}

		// Set the default menu item to use for com_users if possible.
		if ($profile) {
			$default = $profile;
		} 
	}

	if (!empty($query['view'])) {
		switch ($query['view']) {
			default:
			case 'profile':
				if (!empty($query['view'])) {
					$segments[] = $query['view'];
				}
				unset ($query['view']);
				if ($query['Itemid'] = $profile) {
					unset ($query['view']);
				} else {
					$query['Itemid'] = $default;
				}

				// Only append the user id if not "me".
				$user = JFactory::getUser();
				if (!empty($query['user_id']) && ($query['user_id'] != $user->id)) {
					$segments[] = $query['user_id'];
				}
				unset ($query['user_id']);

				break;
		}
	}

	return $segments;
}

/**
 * Function to parse a Users URL route.
 *
 * @param	array	The URL route with segments represented as an array.
 * @return	array	The array of variables to set in the request.
 * @since	1.5
 */
function SocialLoginAndSocialShareParseRoute($segments)
{
	// Initialise variables.
	$vars = array();

	// Only run routine if there are segments to parse.
	if (count($segments) < 1) {
		return;
	}

	// Get the package from the route segments.
	$userId = array_pop($segments);

	if (!is_numeric($userId)) {
		$vars['view'] = 'profile';
		return $vars;
	}

	if (is_numeric($userId)) {
		// Get the package id from the packages table by alias.
		$db = JFactory::getDbo();
		$db->setQuery(
			'SELECT `id`' .
			' FROM `#__users`' .
			' WHERE `id` = '.(int) $userId
		);
		$userId = $db->loadResult();
	}

	// Set the package id if present.
	if ($userId) {
		// Set the package id.
		$vars['user_id'] = (int)$userId;

		// Set the view to package if not already set.
		if (empty($vars['view'])) {
			$vars['view'] = 'profile';
		}
	} else {
		JError::raiseError(404, JText::_('JGLOBAL_RESOURCE_NOT_FOUND'));
	}

	return $vars;
}
