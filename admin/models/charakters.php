<?php
/**
 * Charakters View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_da_na
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.model' );

/**
 * Charakters Model
 */
class PotterModelCharakters extends JModelLegacy
{

	function __construct()
	{
//    	global $mainframe,$context; 
		$mainframe = JFactory::getApplication();
		$context = JRequest::getCMD('context');
    	parent::__construct(); 
    	// Get the pagination request variables 
 		$context			= 'com_potter.charakters.list.';
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
		$query = " SELECT dn.id AS id, dn.id_jahr AS id_jahr, dn.id_name AS id_name, dn.sicher sicher, dn.published AS published, dn.Sonder AS Sonder, dn.Funktion AS Funktion, n.ma_name ma_name, n.ma_vname ma_vname, j.Jahr Jahr, n.haus haus".
			     " FROM `#__po_da_na` dn, `#__po_jahr` j, `#__po_namen` n ".
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
		$context = 'com_potter.charakters.list.';

    	// Array of allowable order fields
	    $orders = array('dn.published','n.ma_name', 'j.Jahr','n.haus', 'dn.Funktion', 'dn.sicher','dn.Sonder','dn.id'); 
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
	        $filter_order = 'dn.published';
    	}
		$plus = '';
		if ($filter_order != 'n.ma_name')
		{
			$plus = ', n.ma_name,n.ma_vname'; 
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
		$context = 'com_potter.charakters.list.';
    	// get the filter values
	    $filter_state 	= $mainframe->getUserStateFromRequest($context.'filter_state', 'filter_state');
    	$filter_jahre 	= $mainframe->getUserStateFromRequest($context.'filter_jahre', 'filter_jahre');
    	$filter_haus 	= $mainframe->getUserStateFromRequest($context.'filter_haus', 'filter_haus');
    	$filter_funktion = $mainframe->getUserStateFromRequest($context.'filter_funktion', 'filter_funktion');
    	$filter_sonder 	= $mainframe->getUserStateFromRequest($context.'filter_sonder', 'filter_sonder');
	    $search 		= $mainframe->getUserStateFromRequest($context.'search', 'search'); 
		$search			= JString::strtolower( $search ); 
    	// prepare the WHERE clause
	    $where = array(); 
	    // Determine published state
	    if ( $filter_state == 'P' )
	    {
    	    $where[] = 'dn.published = 1';
	    }
	    elseif
    	($filter_state == 'U')
	    {
	        $where[] = 'dn.published = 0';
    	} 

	    // Filter der Jahre ID
	    if ($filter_jahre = (int)$filter_jahre)
    	{
	        $where[] = 'dn.id_jahr= '.$filter_jahre;
    	}
	    // Filter der Funktion
	    if ($filter_funktion = (int)$filter_funktion)
    	{
/*			switch ($filter_funktion)
			{
				Case 1 :
						$where[] = 'dn.Funktion=0';
						break;
				Case 2 :
						$where[] = 'dn.Funktion=1';
						break;
			}
 */
			$where[] = 'dn.Funktion = '.((int)$filter_funktion-1);
		}
		// Filter Haus
		if ($filter_haus = (int)$filter_haus)
		{
			$where[] = 'n.haus='.((int)$filter_haus);
		}
	    // Filter der Sonder
	    if ($filter_sonder = (int)$filter_sonder)
    	{
	        $where[] = 'dn.Sonder= '.((int)$filter_sonder-1);
    	}

	    // Determine search terms
	    if ($search = trim($search))
    	{
	        $db =& $this->_db;
    	    $filter = $db->getEscaped($search);
        	$where[] = '(LOWER(n.ma_name) LIKE "%'.$search.'%" OR '.
					   'LOWER(n.ma_vname) LIKE "%'.$search.'%")'	;
	    }

    	// return the WHERE clause
	    return (count($where)) ? ' WHERE dn.id_jahr=j.id AND dn.id_name=n.id AND '.implode(' AND ', $where) : ' WHERE dn.id_jahr=j.id AND dn.id_name=n.id';
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