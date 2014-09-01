<?php
/**
 * Roll Model für die Komponente Potter
 * Diese verarbeitet alle Aufgabe für ein Jahr der Tabelle #__po_namen
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.model');

/**
 * View: Roll
 * Model: Roll
 */
class PotterModelRoll extends JModelLegacy
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
	 * Method to set the Roll identifier
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

	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__po_namen'
				. ' SET published = '.(int) $publish
				. ' WHERE id IN ( '.$cids.' )';
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
			$query = ' SELECT * FROM #__po_namen '.
 					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->published = 1; 	// @var int 1 = aktiver Darsteller 0 = ehemaliger Darsteller
			$this->_data->ma_name = null;	// @var varchar Nachname
			$this->_data->ma_vname = null;	// @var varchar Vorname 
			$this->_data->ma_titel = null;	// @var varchar Titel
			$this->_data->Magie = 0;		// @var int Art der Magie 
			$this->_data->haus = null;		// @var int welches Haus
			$this->_data->sex = 0;			// @var int 0 = weiblich, 1 = männlich, 2 = Gendermorf
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
		$row =& $this->getTable('roll');
		$data = JRequest::get( 'post' );
//		$data['Comment'] = JRequest::getVar( 'Comment', '', 'post', 'string', JREQUEST_ALLOWRAW );  

		foreach($data as $key=>$value) 
		{
			if(trim($value) == '') $data[$key] = null;
        }
        
        //Datum in SQL (Englisches) Format umwandeln
//        if(isset($data['birthday']))
//            $data['birthday'] = date("Y-m-d", strtotime($data['birthday']));

		// Bind the form fields to the #__po_darst
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