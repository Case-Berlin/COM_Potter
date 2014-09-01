<?php
/**
 * Lessons View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_faecher
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Years View
 */
class PotterViewSubjects extends JViewLegacy
{
	/**
	 * alle Jahre anzeigen
	 * @return void
	 **/
	function display($tpl = null)
	{
		//global $context;
		//global $mainframe;
		$mainframe = JFactory::getApplication();
		$context = JRequest::getCMD('context');
		$db			=& JFactory::getDBO();
		$uri		=& JFactory::getURI();
		$document	= & JFactory::getDocument();

		JToolBarHelper::title(   JText::_( 'Potter-Event-Faecher' ), 'generic.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

		// Get data from the model
		$items		= & $this->get( 'Data');

		// prepare list array
		$lists = array();
		// get the user state of the order and direction
		$context			= 'com_potter.subjects.list.';
		$filter_order = $mainframe->getUserStateFromRequest($context.'filter_order', 'filter_order', 'published');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'DESC');
		$filter_state = $mainframe->getUserStateFromRequest($context.'filter_state', 'filter_state');
		$lists['state'] = JHTML::_('grid.state',$filter_state);


		// set the table order values
		$lists['order_Dir'] = $filter_order_Dir; 
		$lists['order'] = $filter_order;


        //print_r($items);
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

		// ...und nun die ganzen Listen übergeben
		$this->assignRef('lists', $lists);

		$this->assignRef('items',		$items);
		$this->assignRef('pagination', $pagination);
		parent::display($tpl);
	}
}