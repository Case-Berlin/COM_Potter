<?php
/**
 * Charakter Model für die Komponente Potter
 * Diese verarbeitet alle Aufgabe für ein Jahr der Tabelle #__po_da_na
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.model');

/**
 * View: Charakter
 * Model: Charakter
 */
class PotterModelCharakter extends JModelLegacy
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
	function getAktYear()
	{
		$query = ' SELECT id FROM #__po_jahr WHERE aktuell=1';
		$this->_db->setQuery( $query );
		return $this->_db->loadResult();

	}
	
	function copyChar($cid = array(), $year = 9)
	{
		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$total = count($cid);
			for ($i = 0; $i < $total; $i ++)
			{
				$row =& $this->getTable('charakter');
				//$row = & JTable::getInstance('charakter');
				//echo $cid[$i].'<br>';
				$query = 'SELECT * FROM #__po_da_na'
					. ' WHERE id = '.(int) $cid[$i];;
				$this->_db->setQuery( $query );
				$item = $this->_db->loadObject();

				$row->id 		= null;
				$row->id_jahr 	= $year;
				$row->id_darst 	= $item->id_darst;
				$row->id_name 	= $item->id_name;
				$row->Funktion 	= $item->Funktion;
				$row->Sonder 	= $item->Sonder;
				$row->published = 0;
				$row->sicher 	= 1;
				$row->kcomment 	= $item->kcomment;
				$row->comment 	= $item->comment;
				$row->bild 		= null;
				$row->zurperson = $item->zurperson;
				$row->hits 		= 0;
				$row->checked_out = 0;
				$row->checked_out_time = null;
				
				if (!$row->check()) 
				{
					JError::raiseError( 500, $row->getError() );
					return false;
				}
				if (!$row->store(true)) 
				{
					JError::raiseError( 500, $row->getError() );
					return false;
				}
			}
		}
		return true;
	}

	
	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );

			$query = 'UPDATE #__po_da_na'
				. ' SET published = '.(int) $publish
				. ' WHERE id IN ( '.$cids.' )'
				. ' AND ( checked_out = 0 OR ( checked_out = '.(int) $user->get('id').' ) )';
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}

	/**
	 * Methode zum Leses eines Charakter
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) 
		{
			$query = ' SELECT * FROM #__po_da_na '.
 					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) 
		{
			$query = ' SELECT id FROM #__po_jahr WHERE aktuell=1';
			$this->_db->setQuery( $query );
			$year = $this->_db->loadResult();


			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->id_jahr = $year;
			$this->_data->id_darst = 0;
			$this->_data->id_name = 0;
			$this->_data->Funktion = 0;		// @var int 0 - sonstiges, 1 - Lehrer, 2 - Schüler, 3 - Ministerium, 4 - Ministerium/Lehrer, 5 - Presse
			$this->_data->Sonder = 0;		// @var int 0 - keine, 1 - Vertrauensschüler, 2 - Schulsprecher, 3 - Hauslehrer
			$this->_data->published = 0; 	// @var int 1 = auf Frontend anzeigen 0 = nicht anzeigen
			$this->_data->sicher = 1; 		// @var int 1 = ist sicher dabei 0 = nicht siche dabei (Wir später umgewandelt in published)
			$this->_data->kcomment = null;	// @var varchar kurzer Kommentar zum Charakter
			$this->_data->comment = null;	// @var longtext die Kurze Infos zur Rolle (Lehrer/Schüler, etc)
			$this->_data->bild = null;		// @var varchar Datei des Bildes (ohne Pfad)
			$this->_data->zurperson = null;	// @var longtext Infos zur Rolle in dem Jahr
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
		$row =& $this->getTable('charakter');
		$data = JRequest::get( 'post' );
		$data['comment'] = JRequest::getVar( 'comment', '', 'post', 'string', JREQUEST_ALLOWRAW );  
		$data['zurperson'] = JRequest::getVar( 'zurperson', '', 'post', 'string', JREQUEST_ALLOWRAW );  

		foreach($data as $key=>$value) 
		{
			if(trim($value) == '') $data[$key] = null;
        }
        
        //Datum in SQL (Englisches) Format umwandeln
//        if(isset($data['birthday']))
//            $data['birthday'] = date("Y-m-d", strtotime($data['birthday']));

		// Bind the form fields to the #__po_da_na
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