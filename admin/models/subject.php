<?php
/**
 * Subject Model für die Komponente Potter
 * Diese verarbeitet alle Aufgabe für ein Jahr der Tabelle #__po_faecher
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.model');

/**
 * View: Subject
 * Model: Subject
 */
class PotterModelSubject extends JModelLegacy
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
	 * Method to set the Subject identifier
	 *
	 * @access	public
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__po_faecher'
				. ' SET published = '.(int) $publish
				. ' WHERE id IN ( '.$cids.' )'
				. ' AND ( checked_out = 0 OR ( checked_out = '.(int) $user->get('id').' ) )'
			;
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
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
			$query = ' SELECT * FROM #__po_faecher '.
 					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->published = 1; 	// @var int 1 = aktives Fach 0 = ex Fach			
			$this->_data->Fach = null;		// @var varchar Fach
			$this->_data->hits = 0;			// @var int Soll ein automatischer Clickzähler sein?
			$this->_data->checked_out = 0;	// @var int wer hat das letzte mal den Datensatz geschrieben
			$this->_data->checked_out_time = null; // @var datetime und wer war es
			
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
		$row =& $this->getTable('subject');
		$data = JRequest::get( 'post' );
//		$data['Comment'] = JRequest::getVar( 'Comment', '', 'post', 'string', JREQUEST_ALLOWRAW );  

		foreach($data as $key=>$value) 
		{
			if(trim($value) == '') $data[$key] = null;
        }
        
        //Datum in SQL (Englisches) Format umwandeln
//        if(isset($data['birthday']))
//            $data['birthday'] = date("Y-m-d", strtotime($data['birthday']));

		// Bind the form fields to the #__po_faecher
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
		if (!$row->store(true)) 
		{
			$this->setError( $row->getErrorMsg() );
			return false;
		}
		return true;
	}
	

}