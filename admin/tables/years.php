<?php
/**
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

/**
 * Years Table class
 */
class PotterTableYears extends JTable
{
	public $id;
	public $aktuell;
	public $Jahr;
	public $Titel;
	public $path;

	function __construct(&$db) 
	{
		parent::__construct('#__po_jahr', 'id', $db);
	}
}