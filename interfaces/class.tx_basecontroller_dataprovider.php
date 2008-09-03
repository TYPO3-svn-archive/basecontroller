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
* $Id: $
***************************************************************/

/**
 * Interface for objects that can behave as Data Providers
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 * @subpackage	tx_basecontroller
 */
interface tx_basecontroller_dataprovider {
	
	/**
	 * This method returns the type of data structure that the Data Provider can prepare
	 *
	 * @return	string	type of the provided data structure
	 */
	public function getProvidedDataStructure();

	/**
	 * This method indicates whether the Data Provider can create the type of data structure requested or not
	 *
	 * @param	string		$type: type of data structure
	 * @return	boolean		true if it can handle the requested type, false otherwise
	 */
	public function providesDataStructure($type);

	/**
	 * This method is used to load the details about the Data Provider passing it whatever data it needs
	 * This will generally be a table name ($data['table']) and a primary key value ($data['uid'])
	 *
	 * @param	array	$data: Data for the Data Provider
	 * @return	void
	 */
	public function loadProviderData($data);

	/**
	 * This method assembles the data structure and returns it
	 *
	 * @return	array	standardised data structure
	 */
	public function getDataStructure();

	/**
     * This method returns a list of tables and fields available in the data structure,
     * complete with localized labels
     *
     * @param	string	$language: 2-letter iso code for language
     * @return	array	list of tables and fields
     */
	public function getTablesAndFields($language = '');

	/**
	 * This method is used to pass a Data Filter structure to the Data Consumer
	 *
	 * @param	DataFilter	$filter: Data Filter structure
	 * @return	void
	 */
	public function setDataFilter($filter);
}
?>