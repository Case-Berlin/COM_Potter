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
class PotterModelArtist extends JModelLegacy
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

	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__po_darst'
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
			$query = ' SELECT * FROM #__po_darst '.
 					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) 
		{
			$this->_data = new stdClass();
			$this->_data->id = 0;
    		$this->_data->joomlaid = 0;		// @var int id zur jos_users
			$this->_data->powieid = 0;		// @var int id zur alten Powie Tabelle, wird nicht gepflegt
			$this->_data->published = 1; 	// @var int 1 = aktiver Darsteller 0 = ehemaliger Darsteller
			$this->_data->anzeigen = 0;		// @var int 1 = persönliches Profil auf der Seite anzeigen 
			$this->_data->sex = 0;			// @var int 0 = weiblich, 1 = männlich
			$this->_data->realname = null;	// @var varchar Nachname
			$this->_data->realvname = null;	// @var varchar Vorname 
			$this->_data->www = null;		// @var varchar Webadresse
			$this->_data->email = null;		// @var varchar E-Mailadresse
			$this->_data->showmail = 1;		// @var char 1 = E-Mailadresse intern anzeigen (nach außen geht nichts)
			$this->_data->birthday = null;	// @var date Geburtstag
			$this->_data->Telefon = null;    // @var varchar Telefon
			$this->_data->PLZ = null;		// @var varchar PLZ
			$this->_data->Ort = null;		// @var varchar Ort
			$this->_data->Strasse = null;	// @var varchar Straße
			$this->_data->Bild = null;		// @var varchar Name des Bildes (Pfad zum Bild ist fix /images/potter/personen
			$this->_data->Comment = null;	// @var longtext Kommentar zu sich selbst
			$this->_data->intComment = null;	// @var longtext internet Kommentar (nur für den Admin)
			$this->_data->fezma = 0;			// @var int 0 = kein FEZ Mitarbeiter, 1 = FEZ Mitarbeiter
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
		$row =& $this->getTable('artist');
		$data = JRequest::get( 'post' );
		$data['Comment'] = JRequest::getVar( 'Comment', '', 'post', 'string', JREQUEST_ALLOWRAW );  

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