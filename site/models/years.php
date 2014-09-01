<?php
/**
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.model' );

class potterModelYears extends JModelLegacy
{
	/**
	 * Gets the greeting
	 * @return string The greeting to be displayed to the user
	 */
 	var $_data;

	function getData()
	{
		if (empty( $this->_data ))
		{
			$query = 'SELECT * FROM #__po_jahr';
        	$this->_data = $this->_getList( $query );
        } 
		return $this->_data;
	}
}
