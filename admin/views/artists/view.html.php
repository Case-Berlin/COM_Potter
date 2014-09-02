<?php
/**
 * Artists View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_darst
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );
jimport('joomla.utilities.utility');

class PotterViewArtists extends JViewLegacy
{

	 protected $items;
	 protected $pagination;
	 protected $state;

	function display($tpl = null)
	{
		$mainframe = JFactory::getApplication();
		$context = JRequest::getCMD('context');
		$db			=& JFactory::getDBO();
		$uri		=& JFactory::getURI();
		$document	= & JFactory::getDocument();
		
    	// prepare list array
		$lists = array();

		// get the user state of the order and direction
		$context			= 'com_potter.artists.list.';
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
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

        //print_r($items);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination', $pagination);

        // Die Toolbar hinzufügen
        $this->addToolBar();

		parent::display($tpl);
	}

	protected function addToolBar()
    {
		JToolBarHelper::title(JText::_( 'Darsteller-des-Potter-Events' ), 'generic.png' );
 
		JToolBarHelper::publish('artists.publish','JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('artists.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolBarHelper::editList('artist.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::addNew('artist.add', 'JTOOLBAR_NEW');
    }
}