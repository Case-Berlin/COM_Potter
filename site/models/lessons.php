<?php
/**
 * Lessons Model für die Potter Komponente
 * 
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.model' );

/**
 * Unterrich Model Lessons
 */
class potterModelLessons extends JModelLegacy
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
			$query = 'SELECT f.* FROM #__po_faecher f';
        	$this->_data = $this->_getList( $query );
        } 
		return $this->_data;
	}
}
