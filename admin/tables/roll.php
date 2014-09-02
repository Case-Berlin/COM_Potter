<?php
/**
 * Artist Tabelle für die Komponente Potter
 * Beschreibung der Tabelle: #__po_namen
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.database.table');

/**
-- 
-- Tabellenstruktur für Tabelle `#__po_namen`
-- 

CREATE TABLE `jos_po_namen` (
  `id` int(11) NOT NULL auto_increment,
  `published` tinyint(1) unsigned NOT NULL default '1',
  `Magie` tinyint(4) NOT NULL default '0',
  `ma_name` varchar(50) default NULL,
  `ma_vname` varchar(50) default NULL,
  `ma_titel` varchar(30) default NULL,
  `haus` tinyint(4) default NULL,
  `sex` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `ma_name` (`ma_name`)
) TYPE=MyISAM COMMENT='HP Darsteller' AUTO_INCREMENT=155 ;
  */


/**
 * Roll Table class
 */
class PotterTableRolls extends JTable
{
/*	var $id = null;			// @var int primäry Key
	var $published = 1; 	// @var int 1 = aktive Rolle 0 = ehemalige Rolle
	var $Magie = 0;			// @var int 0 - neutral; 1 - weiß (bekannt); 2 - schwarz (bekannt); 3 - weiß (unbekannt); 4 - schwarz (unbekannt)
	var $ma_name = null;	// @var varchar Nachname
	var $ma_vname = null;	// @var varchar Vorname 
	var $ma_titel = null;	// @var varchar Titel
	var $haus = null;		// @var int 0 - unbekannt; 1 - Gryffindor; 2 - Ravenclaw; 3 - Hufflepuff; 4 - Slytherin; 5 - Bossander
	var $sex = 0;			// @var int 0 = weiblich, 1 = männlich, 2 - beides
*/
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */

	function __construct(&$db) 
	{
		parent::__construct('#__po_namen', 'id', $db);
	}
}