<?php
/**
 * Charakter Tabelle für die Komponente Potter
 * Beschreibung der Tabelle: #__po_lehrer
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.database.table');

/**
-- 
-- Tabellenstruktur für Tabelle `#__po_lehrer`
-- 
CREATE TABLE IF NOT EXISTS `jos_po_lehrer` (
  `id` int(11) NOT NULL auto_increment,
  `id_fach` int(11) NOT NULL default '0',
  `id_jahr` int(11) NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `sicher` tinyint(4) NOT NULL default '1',
  `Raum` varchar(30) collate utf8_bin default NULL,
  `comment` tinytext collate utf8_bin,
  `Beschreibung` longtext collate utf8_bin,
  `hits` int(10) unsigned NOT NULL default '0',
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `id_fach` (`id_fach`),
  KEY `id_jahr` (`id_jahr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Zuordnung Fach/Lehrer' AUTO_INCREMENT=95 ;
*/

/**
 * Charakter Table class
 */
class PotterTableLessons extends JTable
{
/*	var $id = null;			// @var int primäry Key
	var $id_fach = 0;		// @var int Key zur #__po_faecher
	var $id_jahr = 0;		// @var int Key zur #__po_jahre
	var $published = 0; 	// @var int 1 = auf Frontend anzeigen 0 = nicht anzeigen
	var $sicher = 1; 		// @var int 1 = ist sicher dabei 0 = nicht siche dabei (Wird später umgewandelt in published)
	var $Raum = null;		// @var varchar(30) Raumbezeichnung
	var $comment = null;	// @var tinytext interner Kommentar
	var $Beschreibung = null;	// @var longtext Beschreibung des Fachs
	var $Anzahl = null;     // int maximale Anzahl der Schüler
	var $abAlter = null;    // int ab welchem Alter ist der Unterricht geeignet
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
		parent::__construct('#__po_lehrer', 'id', $db);
	}
}