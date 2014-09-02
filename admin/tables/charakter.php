<?php
/**
 * Charakter Tabelle für die Komponente Potter
 * Beschreibung der Tabelle: #__po_da_na
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.database.table');

/**
-- 
-- Tabellenstruktur für Tabelle `#__po_da_na`
-- 
CREATE TABLE `jos_po_da_na` (
  `id` int(11) NOT NULL auto_increment,
  `id_jahr` int(11) NOT NULL default '0',
  `id_darst` int(11) NOT NULL default '0',
  `id_name` int(11) NOT NULL default '0',
  `Funktion` tinyint(4) NOT NULL default '0',
  `Sonder` tinyint(4) NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `sicher` tinyint(4) NOT NULL default '1',
  `kcomment` varchar(255) default NULL,
  `comment` longtext,
  `bild` varchar(100) default NULL,
  `zurperson` longtext,
  `hits` int(11) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `Funktion` (`Funktion`)
) TYPE=MyISAM COMMENT='HP Darsteller' AUTO_INCREMENT=295 ;  */


/**
 * Charakter Table class
 */
class PotterTableCharakters extends JTable
{
/*	var $id = null;			// @var int primäry Key
	var $id_jahr = 0;		// @var int Key zur #__po_jahre
	var $id_darst = 0;		// @var int Key zur #__po_darst
	var $id_name = 0;		// @var int Key zur #__po_namen
	var $Funktion = 0;		// @var int 0 - sonstiges, 1 - Lehrer, 2 - Schüler, 3 - Ministerium, 4 - Ministerium/Lehrer, 5 - Presse
	var $Sonder = 0;		// @var int 0 - keine, 1 - Vertrauensschüler, 2 - Schulsprecher, 3 - Hauslehrer, 4 - stellv. Vertrauensschüler, 5 - stellv. Hauslehrer, 6 - Direktor
	var $published = 0; 	// @var int 1 = auf Frontend anzeigen 0 = nicht anzeigen
	var $sicher = 1; 		// @var int 1 = ist sicher dabei 0 = nicht siche dabei (Wir später umgewandelt in published)
	var $kcomment = null;	// @var varchar kurzer Kommentar zum Charakter
	var $comment = null;	// @var longtext die Kurze Infos zur Rolle (Lehrer/Schüler, etc)
	var $bild = null;		// @var varchar Datei des Bildes (ohne Pfad)
	var $zurperson = null;	// @var longtext Infos zur Rolle in dem Jahr
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
		parent::__construct('#__po_da_na', 'id', $db);
	}
}