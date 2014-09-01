<?php
/**
 * Years View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_jahr
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.modellist' );

/**
 * Years Model
 */
class PotterModelYears extends JModelList
{
    protected $items = array();
    protected $pagination;

	/**
	 * Gibt die Daten zurück
	 * @return array Array of objects containing the data from the database
	 */
	function getListQuery()
	{
        $db = $this->getDbo();
         // Ein neues (leeres) Queryobjekt beziehen.
        $query = $db->getQuery(true);
         // Aus der Tabelle 'po_jahr'...
//       $query->from('#__po_jahr');
         // ... ein paar Felder auswählen.
//        $query->select('*');
        $query->select('*')->from('#__po_jahr'); // bei kleinen Querys schöner
 
        return $query;
		
	}
}