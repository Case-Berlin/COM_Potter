<?php
/**
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 *
 * @package		Joomla.Tutorials
 * @subpackage	Components
 */
class potterViewYears extends JViewLegacy
{
	function display($tpl = null)
	{
		//global $mainframe;
		$mainframe = JFactory::getApplication();
	
		$items		= & $this->get( 'Data');
		$params = &$mainframe->getPageParameters();
		
		$this->assignRef('params', $params);
		$this->assignRef('items', $items);
		parent::display($tpl);

	}
}
?>
