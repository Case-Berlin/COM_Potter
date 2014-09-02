<?php
/**
 * Lessons View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_faecher
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );
jimport('joomla.utilities.utility');

class PotterViewSubjects extends JViewLegacy
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
		
        // Die Toolbar hinzufügen
        $this->addToolBar();

		parent::display($tpl);
	}

	protected function addToolBar()
    {
		JToolBarHelper::title(JText::_( 'Potter-Event-Faecher' ), 'generic.png' );
 
		JToolBarHelper::publish('subjects.publish','JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('subjects.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolBarHelper::editList('subject.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::addNew('subject.add', 'JTOOLBAR_NEW');
    }
}