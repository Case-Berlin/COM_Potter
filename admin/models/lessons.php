<?php
/**
 * Lessons View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_lehrer
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.model' );

/**
 * Lessons Model
 */
class PotterModelLessons extends JModelLegacy
{

	function __construct()
	{
//    	global $mainframe,$context; 
		$mainframe = JFactory::getApplication();
		$context = JRequest::getCMD('context');
		
    	parent::__construct(); 
    	// Get the pagination request variables 
 		$context			= 'com_potter.lessons.list.';
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'));
    	$limitstart = $mainframe->getUserStateFromRequest($context.'limitstart', 'limitstart', 0); 
    	// set the state pagination variables
    	$this->setState('limit', $limit);
    	$this->setState('limitstart', $limitstart);
	}

	/**
	 * Get a pagination object
	 *
	 * @access public
	 * @return JPagination
	 */
	function getPagination()
	{
    	if (empty($this->_pagination))
	    {
	        // import the pagination library
    	    jimport('joomla.html.pagination'); 
        	// prepare the pagination values
	        $total = $this->getTotal();
    	    $limitstart = $this->getState('limitstart');
        	$limit = $this->getState('limit');

	        // create the pagination object
    	    $this->_pagination = new JPagination($total, $limitstart, $limit);
	    }
    	return $this->_pagination;
	}
	/**
	 * Get number of items
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
	     if (empty($this->_total))
    	{
	        $query = $this->_buildQuery();
    	    $this->_total = $this->_getListCount($query);
	    }
     	return $this->_total;
	}

	/**
	 * years data array
	 *
	 * @var array
	 */
	var $_data;

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
		$query = " SELECT l.*, j.Jahr Jahr, f.Fach Fach ".
			     " FROM `#__po_lehrer` l, `#__po_jahr` j, #__po_faecher f ".
				 $this->_buildFAQWhere().
				 $this->_buildQueryOrderBy();
		return $query;
	}

	/**
	 * Builds the ORDER part of a query
	 *
	 * @return string Part of an SQL query
	 */
	function _buildQueryOrderBy()
	{
//	    global $mainframe, $context;
		$mainframe = JFactory::getApplication();
		$context = JRequest::getCMD('context');
		$context = 'com_potter.lessons.list.';

    	// Array of allowable order fields
	    $orders = array('l.published','f.Fach', 'j.Jahr', 'l.Raum','l.Anzahl','l.abAlter','l.sicher','l.id'); 
    	// get the order field and direction
	    $filter_order = $mainframe->getUserStateFromRequest($context.'filter_order', 'filter_order', 'published');
    	$filter_order_Dir = strtoupper($mainframe->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'DESC')); 

	    // validate the order direction, must be ASC or DESC
    	if ($filter_order_Dir != 'ASC' && $filter_order_Dir != 'DESC')
	    {
    	    $filter_order_Dir = 'DESC';
	    }

    	// if order column is unknown use the default
	    if (!in_array($filter_order, $orders))
    	{
	        $filter_order = 'l.published';
    	}
		$plus = '';
/*		if ($filter_order != 'n.ma_name')
		{
			$plus = ', n.ma_name,n.ma_vname'; 
		}
*/
		// return the ORDER BY clause        
		return ' ORDER BY '.$filter_order.' '.$filter_order_Dir.$plus;
	}

	/**
	 * Builds the WHERE part of a query
	 *
	 * @return string Part of an SQL query
	 */
	function _buildFAQWhere()
	{
//	    global $mainframe, $context; 
		$mainframe = JFactory::getApplication();
		$context = JRequest::getCMD('context');
		$context = 'com_potter.lessons.list.';

    	// get the filter values
	    $filter_state 	= $mainframe->getUserStateFromRequest($context.'filter_state', 'filter_state');
    	$filter_jahre 	= $mainframe->getUserStateFromRequest($context.'filter_jahre', 'filter_jahre');
	    $search 		= $mainframe->getUserStateFromRequest($context.'search', 'search'); 
		$search			= JString::strtolower( $search ); 
    	// prepare the WHERE clause
	    $where = array(); 
	    // Determine published state
	    if ( $filter_state == 'P' )
	    {
    	    $where[] = 'l.published = 1';
	    }
	    elseif
    	($filter_state == 'U')
	    {
	        $where[] = 'l.published = 0';
    	} 

	    // Filter der Jahre ID
	    if ($filter_jahre = (int)$filter_jahre)
    	{
	        $where[] = 'l.id_jahr= '.$filter_jahre;
    	}
	    // Determine search terms
	    if ($search = trim($search))
    	{
	        $db =& $this->_db;
    	    $filter = $db->getEscaped($search);
        	$where[] = '(LOWER(f.fach) LIKE "%'.$search.'%")'	;
	    }

    	// return the WHERE clause
	    return (count($where)) ? ' WHERE l.id_jahr=j.id AND l.id_fach=f.id AND '.implode(' AND ', $where) : ' WHERE l.id_jahr=j.id AND l.id_fach=f.id';
	}

	/**
	 * Gibt die Daten zurück
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
			//echo $query;
			$this->_data = $this->_getList( $query,$this->getState('limitstart'),$this->getState('limit'));
		}
		return $this->_data;
	}
}