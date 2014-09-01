<?php
/**
 * Rolls View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_namen
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Rolls View
 */
class PotterViewRolls extends JViewLegacy
{
	/**
	 * alle Rollen anzeigen
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
		
		JToolBarHelper::title(   JText::_( 'Rollen-des-Potter-Events' ), 'generic.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

		// prepare list array
		$lists = array();

		// get the user state of the order and direction
		$context			= 'com_potter.rolls.list.';
		$filter_order = $mainframe->getUserStateFromRequest($context.'filter_order', 'filter_order', 'published');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'DESC');
		// set the table order values
	    $search 		= $mainframe->getUserStateFromRequest($context.'search', 'search'); 
		$search			= JString::strtolower( $search ); 
		$lists['order_Dir'] = $filter_order_Dir; 
		$lists['order'] = $filter_order;

		//Statusfilter bestücken
		$filter_state = $mainframe->getUserStateFromRequest($context.'filter_state', 'filter_state');
		$lists['state'] = JHTML::_('grid.state',$filter_state);

		// ...und nun die ganzen Listen übergeben
		$this->assignRef('lists', $lists);

		// Get data from the model
		$rolls		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

        //print_r($items);
		$this->assignRef('rolls',		$rolls);
		$this->assignRef('pagination', $pagination);
		parent::display($tpl);
	}
}