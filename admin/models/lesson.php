<?php
/**
 * Lesson Model für die Komponente Potter
 * Diese verarbeitet alle Aufgabe für ein Jahr der Tabelle #__po_lehrer
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
class PotterModelLesson extends JModelLegacy
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
	
	function AddTeacher($fach,$teacher)
	{
		$db = JFactory::getDBO();
		$query  = 'INSERT INTO '.$db->nameQuote('#__po_le_na');
		$query .= ' ('.$db->nameQuote('id_lehrer').', '.$db->nameQuote('id_name').')';
		$query .= ' VALUES ('.$teacher.', '.$fach.')';
//		echo $query;
		$this->_db->setQuery( $query );
		if (!$this->_db->query()) 
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		echo $result;
		return true;
	}

	function DelTeacher($id)
	{
		$db = JFactory::getDBO();
		$query  = 'DELETE FROM '.$db->nameQuote('#__po_le_na');
		$query .= ' WHERE '.$db->nameQuote('id').'='.$id;
		//echo $query;
		$this->_db->setQuery( $query );
		if (!$this->_db->query()) 
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		echo $result;
		return true;
	}
	
	function copyLesson($cid = array(), $year = 9)
	{
		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$total = count($cid);
			for ($i = 0; $i < $total; $i ++)
			{
				$row =& $this->getTable('lesson');
				//$row = & JTable::getInstance('charakter');
				//echo $cid[$i].'<br>';
				$query = 'SELECT * FROM #__po_lehrer'
					. ' WHERE id = '.(int) $cid[$i];;
				$this->_db->setQuery( $query );
				$item = $this->_db->loadObject();

				$row->id 		= null;
				$row->id_jahr	= $year;
				$row->id_fach 	= $item->id_fach;
				$row->published = 0;
				$row->sicher 	= 1;
				$row->Raum 		= $item->Raum;
				$row->comment 	= $item->comment;
				$row->Beschreibung = $item->Beschreibung;
				$row->Anzahl    = $item->Anzahl;
				$row->abAlter   = $item->abAlter;
				$row->hits 		= 0;
				$row->checked_out = 0;
				$row->checked_out_time = null;
				//print_r($row);
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

			$query = 'UPDATE #__po_lehrer'
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
			$query = ' SELECT * FROM #__po_lehrer '.
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
			$this->_data->id_fach = 0;
			$this->_data->id_jahr = $year;
			$this->_data->published = 0; 	// @var int 1 = auf Frontend anzeigen 0 = nicht anzeigen
			$this->_data->sicher = 1; 		// @var int 1 = ist sicher dabei 0 = nicht siche dabei (Wir später umgewandelt in published)
			$this->_data->Raum = null;
			$this->_data->comment = null;	// @var tinytext interne Infos
			$this->_data->Beschreibung = null;	// @var longtext Beschreibung des Fachs
			$this->_data->Anzahl = null; 	// int Anzahl der Schüler
			$this->_data->abAlter = null; 	// int ab welchem Alter
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
		$row =& $this->getTable('lesson');
		$data = JRequest::get( 'post' );
		$data['comment'] = JRequest::getVar( 'comment', '', 'post', 'string', JREQUEST_ALLOWRAW );  
		$data['Beschreibung'] = JRequest::getVar( 'Beschreibung', '', 'post', 'string', JREQUEST_ALLOWRAW );  

		foreach($data as $key=>$value) 
		{
			if(trim($value) == '') $data[$key] = null;
        }
        
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