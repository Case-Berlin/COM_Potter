<?php
/**
 * Artist Tabelle für die Komponente Potter
 * Beschreibung der Tabelle: #__po_darst
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.database.table');

/**
-- 
-- Tabellenstruktur für Tabelle `#__po_darst`
-- 

CREATE TABLE IF NOT EXISTS `#__po_darst` (
  `id` int(11) NOT NULL auto_increment,
  `joomlaid` int(11) NOT NULL default '0',
  `powieid` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '1',
  `anzeigen` tinyint(4) NOT NULL default '0',
  `sex` tinyint(4) NOT NULL default '0',
  `realname` varchar(50) default NULL,
  `realvname` varchar(50) default NULL,
  `www` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `showmail` char(1) NOT NULL default '1',
  `birthday` date default NULL,
  `Telefon` varchar(100) default NULL,
  `PLZ` varchar(5) default NULL,
  `Ort` varchar(50) default 'Berlin',
  `Strasse` varchar(100) default NULL,
  `Bild` varchar(100) default NULL,
  `Comment` longtext,
  `intComment` longtext,
  `fezma` tinyint(4) NOT NULL default '0',
  `hits` int(10) unsigned NOT NULL default '0',
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `realname` (`realname`)
) TYPE=MyISAM COMMENT='Darsteller Namen Adressen';
*/


/**
 * Year Table class
 */
class PotterTableArtists extends JTable
{
/*	public $id;				// @var int primäry Key
    public $joomlaid;		// @var int id zur jos_users
	public $powieid = 0;	// @var int id zur alten Powie Tabelle, wird nicht gepflegt
	public $published = 1; 	// @var int 1 = aktiver Darsteller 0 = ehemaliger Darsteller
	public $anzeigen = 0;	// @var int 1 = persönliches Profil auf der Seite anzeigen 
	public $sex = 0;		// @var int 0 = weiblich, 1 = männlich
	public $realname;		// @var varchar Nachname
	public $realvname;		// @var varchar Vorname 
	public $www;			// @var varchar Webadresse
	public $email;			// @var varchar E-Mailadresse
	public $showmail;		// @var char 1 = E-Mailadresse intern anzeigen (nach außen geht nichts)
	public $birthday;		// @var date Geburtstag
	public $Telefon; 		// @var varchar Telefon
	public $PLZ;			// @var varchar PLZ
	public $Ort;			// @var varchar Ort
	public $Strasse;		// @var varchar Straße
	public $Bild;			// @var varchar Name des Bildes (Pfad zum Bild ist fix /images/potter/personen
	public $Comment;		// @var longtext Kommentar zu sich selbst
	public $intComment;		// @var longtext internet Kommentar (nur für den Admin)
	public $fezma;			// @var int 0 = kein FEZ Mitarbeiter, 1 = FEZ Mitarbeiter
	public $hits;			// @var int Soll ein automatischer Clickzähler sein?
	public $checked_out;	// @var int wer hat das letzte mal den Datensatz geschrieben
	public $checked_out_time; // @var datetime und wer war es
*/
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */

	function __construct(&$db) 
	{
		parent::__construct('#__po_darst', 'id', $db);
	}
}