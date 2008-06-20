<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Francois Suter (Cobweb) <typo3@cobweb.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */


/**
 * Plugin 'Base Controller'
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 * @subpackage	tx_basecontroller
 */
class tx_basecontroller {

	/**
	 * This method gets the data provider
	 * If two data providers are defined, the second one is fed into the first one
	 *
	 * @param	array	$providers: list of provider database records
	 * @return	object	object with a DataProvider interface
	 */
	public function getDataProvider($providers) {
			// Get the related data providers
		$numProviders = count($providers);
		if ($numProviders == 0) {
			// No provider, issue error
		}
		else {
				// TODO: If there's a secondary provider, instantiate it first, as it will feed the primary provider
			if ($numProviders == 2) {
			}
				// Get the primary provider
			$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
t3lib_div::debug($row);
/*
$primaryProvider = $this->getSingleDataProvider($row['tablenames'], $row['uid_foreign']);
t3lib_div::debug($primaryProvider);
*/
		}
	}

	/**
	 * This method instatiates a data provider object and returns it
	 *
	 * @param	string		$type: type of data provider (should correspond to a database table)
	 * @param	integer		$uid: primary key of the data provider record
	 * @return	object		object with a DataProvider interface
	 */
	protected function getSingleDataProvider($type, $uid) {
		if (isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->extKey]['providers'][$type])) {
			require_once($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$this->extKey]['providers'][$type]);
			$provider = t3lib_div::makeInstance($type);
			return $provider;
		}
		else {
				// Issue error
			return false;
		}
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/basecontroller/class.tx_basecontroller.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/basecontroller/class.tx_basecontroller.php']);
}

?>