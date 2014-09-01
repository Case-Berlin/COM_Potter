<?php
/**
 * Hello Model for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.model' );

/**
 * Hello Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class potterModelPotter extends JModelLegacy
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
