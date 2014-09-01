<?php
/**
 * Artist Tabelle für die Komponente Potter
 * Beschreibung der Tabelle: #__po_darst
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

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
class PotterTableArtist extends JTable
{
	var $id = null;			// @var int primäry Key
    var $joomlaid = 0;		// @var int id zur jos_users
	var $powieid = 0;		// @var int id zur alten Powie Tabelle, wird nicht gepflegt
	var $published = 1; 	// @var int 1 = aktiver Darsteller 0 = ehemaliger Darsteller
	var $anzeigen = 0;		// @var int 1 = persönliches Profil auf der Seite anzeigen 
	var $sex = 0;			// @var int 0 = weiblich, 1 = männlich
	var $realname = null;	// @var varchar Nachname
	var $realvname = null;	// @var varchar Vorname 
	var $www = null;		// @var varchar Webadresse
	var $email = null;		// @var varchar E-Mailadresse
	var $showmail = 1;		// @var char 1 = E-Mailadresse intern anzeigen (nach außen geht nichts)
	var $birthday = null;	// @var date Geburtstag
	var $Telefon = null;    // @var varchar Telefon
	var $PLZ = null;		// @var varchar PLZ
	var $Ort = null;		// @var varchar Ort
	var $Strasse = null;	// @var varchar Straße
	var $Bild = null;		// @var varchar Name des Bildes (Pfad zum Bild ist fix /images/potter/personen
	var $Comment = null;	// @var longtext Kommentar zu sich selbst
	var $intComment = null;	// @var longtext internet Kommentar (nur für den Admin)
	var $fezma = 0;			// @var int 0 = kein FEZ Mitarbeiter, 1 = FEZ Mitarbeiter
	var $hits = 0;			// @var int Soll ein automatischer Clickzähler sein?
	var $checked_out = 0;	// @var int wer hat das letzte mal den Datensatz geschrieben
	var $checked_out_time = null; // @var datetime und wer war es

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */

	function __construct(& $db) 
	{
		parent::__construct('#__po_darst', 'id', $db);
	}
}