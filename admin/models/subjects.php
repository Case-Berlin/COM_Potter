<?php
/**
 * Subjects View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_faecher
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.model' );

/**
 * Lessonss Model
 */
class PotterModelSubjects extends JModelLegacy
{

	function __construct()
	{
//    	global $mainframe,$context; 
		$mainframe = JFactory::getApplication();
		$context = JRequest::getCMD('context');

    	parent::__construct(); 
    	// Get the pagination request variables 
		$context			= 'com_potter.subjects.list.';
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
	 * Lessons data array
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
		$query = ' SELECT * '.
			     ' FROM #__po_faecher'.
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
		$context = 'com_potter.subjects.list.';

    	// Array of allowable order fields
	    $orders = array('published','Fach','id'); 
    	// get the order field and direction
	    $filter_order = $mainframe->getUserStateFromRequest($context.'filter_order', 'filter_order', 'published');
    	$filter_order_Dir = strtoupper($mainframe->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'DESC')); 

	    // validate the order direction, must be ASC or DESC
    	if ($filter_order_Dir != 'ASC' && $filter_order_Dir != 'DESC')
	    {
    	    $filter_order_Dir = 'DESC';
	    }
	    if (!in_array($filter_order, $orders))
    	{
	        $filter_order = 'published';
    	}
		$plus = '';
		if ($filter_order != 'Fach')
		{
			$plus = ', Fach'; 
		}


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
		$context = 'com_potter.subjects.list.';

    	// get the filter values
	    $filter_state = $mainframe->getUserStateFromRequest($context.'filter_state', 'filter_state');
    	// $filter_catid = $mainframe->getUserStateFromRequest($context.'filter_catid', 'filter_catid');
	    $search 		= $mainframe->getUserStateFromRequest($context.'search', 'search'); 
		$search			= JString::strtolower( $search ); 

    	// prepare the WHERE clause
	    $where = array(); 
	    // Determine published state
	    if ( $filter_state == 'P' )
	    {
    	    $where[] = 'published = 1';
	    }
	    elseif
    	($filter_state == 'U')
	    {
	        $where[] = 'published = 0';
    	} 

	    // Determine category ID
	    //if ($filter_catid = (int)$filter_catid)
    	//{
	    //    $where[] = 'catid = '.$filter_catid;
    	//}

	    // Determine search terms
	    if ($search = trim($search))
    	{
	        $db =& $this->_db;
    	    $filter = $db->getEscaped($search);
        	$where[] = '(LOWER(Fach) LIKE "%'.$search.'%")';
	    }

    	// return the WHERE clause
	    return (count($where)) ? ' WHERE '.implode(' AND ', $where) : '';
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
			$this->_data = $this->_getList( $query,$this->getState('limitstart'),$this->getState('limit'));
		}
		return $this->_data;
	}
}