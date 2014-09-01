<?php
/**
 * Year Model für die Komponente Potter
 * Diese verarbeitet alle Aufgabe für ein Jahr der Tabelle #__po_jahr
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.model');

/**
 * View: Year
 * Model: Year
 */
class PotterModelYear extends JModelLegacy
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the Year identifier
	 *
	 * @access	public
	 * @param	int Hello identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Methode zum Leses eines Jahres
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) 
		{
			$query = ' SELECT * FROM #__po_jahr '.
 					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->aktuell = 0;
			$this->_data->Jahr = 2000;
			$this->_data->Titel = null;
			$this->_data->path = "images/potter/personenxx";
		}
		return $this->_data;
	}

	/**
	 * Methode zum Speichern eines Records
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{	
		$row =& $this->getTable('year');
		$data = JRequest::get( 'post' );
		// Bind the form fields to the #__po_jahr
		// ??? WIE ????
		if (!$row->bind($data)) 
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the Year record is valid
		if (!$row->check()) 
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the Year table to the database
		if (!$row->store()) 
		{
			$this->setError( $row->getErrorMsg() );
			return false;
		}
		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$row =& $this->getTable('year');
		if (count( $cids )) 
		{
			foreach($cids as $cid) 
			{
				if (!$row->delete( $cid )) 
				{
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}
	
	/**
	 * Method to activ record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function activ()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		//$row =& $this->getTable('year');
		$err = true;
		if ((count( $cids )==0) or (count($cids)>1))
		{
		   $err = false;
		} else
		{
		  // naja hier muss dann wohl noch was kommen
		  // löschen des alten aktiven Jahres
		  $db	 = & JFactory::getDBO(); 
		  $query = ' UPDATE #__po_jahr'.
		           ' SET aktuell=0'.
 					'  WHERE aktuell=1';
					//id = '.$cids[0];
		  $db->setQuery( $query );
          $db->query();
		  if ($db->getErrorNum>0)
		  { 
		     $err = false;
		     //$this->setError( $row->getErrorMsg() )
		  }
		  // setzen des neuen aktive Jahres
          $query = ' UPDATE #__po_jahr'.
                   ' SET aktuell=1'.
                   '  WHERE id='.$cids[0];;
          $db->setQuery( $query );
          $db->query();
          if ($db->getErrorNum>0)
          { 
             $err = false;
             //$this->setError( $row->getErrorMsg() )
          }
		}
		return $err;
	}

}