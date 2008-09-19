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
* $Id: class.tx_basecontroller_datafilter.php 11787 2008-09-08 13:54:56Z francois $
***************************************************************/

/**
 * Interface for objects that can behave as Data Filters
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 * @subpackage	tx_basecontroller
 */
interface tx_basecontroller_datafilter {

	/**
	 * This method is used to load the details about the Data Filter passing it whatever data it needs
	 * This will generally be a table name ($data['table']) and a primary key value ($data['uid'])
	 *
	 * @param	array	$data: Data for the Data Filter
	 * @return	void
	 */
	public function loadData($data);

	/**
	 * This method processes the Data Filter's configuration and returns the filter structure
	 *
	 * @return	array	standardised filter structure
	 */
	public function getFilter();
}
?>