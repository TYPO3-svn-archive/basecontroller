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
* $Id: class.tx_basecontroller_filterbase.php 11787 2008-09-08 13:54:56Z francois $
***************************************************************/

require_once(PATH_t3lib.'class.t3lib_svbase.php');
require_once(t3lib_extMgm::extPath('basecontroller', 'interfaces/class.tx_basecontroller_datafilter.php'));

/**
 * Base datafilter service. All Data Filter services should inherit from this class
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 * @subpackage	tx_basecontroller
 */
abstract class tx_basecontroller_filterbase extends t3lib_svbase implements tx_basecontroller_datafilter {
	protected $table; // Name of the table where the details about the data query are stored
	protected $uid; // Primary key of the record to fetch for the details
	protected $filterData = array(); // Record from the database about the Data Filter

// Data Filter interface methods
// (implement only methods that make sense here)

	/**
	 * This method is used to load the details about the Data Filter passing it whatever data it needs
	 * This will generally be a table name (stored in $data['table']) and a primary key value (stored in $data['uid'])
	 *
	 * @param	array	$data: Data for the Data Filter
	 * @return	void
	 */
	public function loadData($data) {
		$this->table = $data['table'];
		$this->uid = $data['uid'];
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_basecontroller/class.tx_basecontroller_datafilter.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tx_basecontroller/class.tx_basecontroller_datafilter.php']);
}
?>