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
*
* $Id: class.tx_basecontroller.php 135 2009-03-04 14:16:25Z rpresedo $
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
 *
 * $Id: class.tx_basecontroller.php 135 2009-03-04 14:16:25Z rpresedo $
 */
class tx_basecontroller {

	// Define class constants for structure types
	public static $recordsetStructureType = 'recordset';
	public static $idlistStructureType = 'idlist';
	public static $treeStructureType = 'tree';

	// Define class constants for exception error codes
	public static $errorIncompatiblePrimarySecondaryProviders = 1;
	public static $noProviderDefined = 2;

	/**
	 * This method gets the data provider
	 * If a secondary provider is defined, it is fed into the first one
	 *
	 * @param	array	$providerInfo: information related to a provider, normally the row from the MM table
	 * @param	object	$secondaryProvider: an instance of an object with a DataProvider interface
	 * @return	object	object with a DataProvider interface
	 */
	public function getDataProvider($providerInfo, tx_basecontroller_dataprovider $secondaryProvider = null) {
			// Get the related data providers
		$numProviders = count($providerInfo);
		if ($numProviders == 0) {
			// No provider, throw exception
			throw new Exception('No provider was defined', self::$noProviderDefined);
		}
		else {
			// Get the primary provider
			$primaryProvider = t3lib_div::makeInstanceService('dataprovider', $providerInfo['tablenames']);
			$providerData = array('table' => $providerInfo['tablenames'], 'uid' => $providerInfo['uid_foreign']);
				// NOTE: loadData() may throw an exception, but we just let it pass at this point
			$primaryProvider->loadData($providerData);
				// Load the primary provider with the data from the secondary provider, if compatible
			if (isset($secondaryProvider)) {
				if ($primaryProvider->acceptsDataStructure($secondaryProvider->getProvidedDataStructure())) {
					$inputDataStructure = $secondaryProvider->getDataStructure();
						// If the secondary provider returned no list of items, force primary provider to return an empty structure
					if ($inputDataStructure['count'] == 0) {
						$primaryProvider->initEmptyDataStructure($inputDataStructure['uniqueTable']);
					}
						// Otherwise pass structure to primary provider
					else {
						$primaryProvider->setDataStructure($inputDataStructure);
					}
				}
					// Providers are not compatible, throw exception
				else {
					throw new Exception('Incompatible structures between primary and secondary providers', self::$errorIncompatiblePrimarySecondaryProviders);
				}
			}
			return $primaryProvider;
		}
	}

	/**
	 * This method gets the data consumer
	 *
	 * @param	array	$consumer: consumer database record
	 * @return	object	object with a DataProvider interface
	 */
	public function getDataConsumer($consumer) {
			// Get the related data consumer
		$consumerObject = t3lib_div::makeInstanceService('dataconsumer', $consumer['tablenames']);
		$consumerData = array('table' => $consumer['tablenames'], 'uid' => $consumer['uid_foreign']);
			// NOTE: loadData() may throw an exception, but we just let it pass at this point
		$consumerObject->loadData($consumerData);
		return $consumerObject;
	}

	/*
	 * This method gets the advanced data filter
	 *
	 * @param	array	$filter: filter database record
	 * @return	object	object with a DataFilter interface
	 */
	public function getDataFilter($filter) {
			// Get the related data filter
		$filterObject = t3lib_div::makeInstanceService('datafilter', $filter['tablenames']);
		$filterData = array('table' => $filter['tablenames'], 'uid' => $filter['uid_foreign']);
			// NOTE: loadData() may throw an exception, but we just let it pass at this point
		$filterObject->loadData($filterData);
		return $filterObject;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/basecontroller/class.tx_basecontroller.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/basecontroller/class.tx_basecontroller.php']);
}

?>