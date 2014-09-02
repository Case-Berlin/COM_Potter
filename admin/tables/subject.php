<?php
/**
 * Subject Tabelle für die Komponente Potter
 * Beschreibung der Tabelle: #__po_faecher
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.database.table');

/**
 * Subject Table class
CREATE TABLE `jos_po_faecher` (
  `id` int(11) NOT NULL auto_increment,
  `Fach` varchar(59) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `Fach` (`Fach`)
) TYPE=MyISAM COMMENT='Die Faecher' AUTO_INCREMENT=56 ;

 */
 
class PotterTableSubjects extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
/*	var $id = null;		// @var int primary Key
	var $published = 1; 	// @var int 1 = aktiver Darsteller 0 = ehemaliger Darsteller
	var $Fach = null; 	// varchar(59) Fachname
	var $hits = 0;			// @var int Soll ein automatischer Clickzähler sein?
	var $checked_out = 0;	// @var int wer hat das letzte mal den Datensatz geschrieben
	var $checked_out_time = null; // @var datetime und wer war es
*/
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */

	function __construct(&$db) 
	{
		parent::__construct('#__po_faecher', 'id', $db);
	}
}