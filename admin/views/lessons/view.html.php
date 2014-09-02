<?php
/**
 * Lessons View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_lehrer
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );
jimport('joomla.utilities.utility');

/**
 * Charakters View
 */
class PotterViewLessons extends JViewLegacy
{
	 protected $items;
	 protected $pagination;
	 protected $state;
	function display($tpl = null)
	{
		$context = JRequest::getCMD('context');
		$mainframe = JFactory::getApplication();
		
		$db			=& JFactory::getDBO();
		$uri		=& JFactory::getURI();
		$document	= & JFactory::getDocument();

		// prepare list array
		$lists = array();

		// get the user state of the order and direction
		$context			= 'com_potter.lessons.list.';
		$filter_order = $mainframe->getUserStateFromRequest($context.'filter_order', 'filter_order', 'published');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'DESC');
		// set the table order values
		$lists['order_Dir'] = $filter_order_Dir; 
		$lists['order'] = $filter_order;

		//Statusfilter bestücken
		$filter_state 	= $mainframe->getUserStateFromRequest($context.'filter_state', 'filter_state');
		$filter_jahre 	= $mainframe->getUserStateFromRequest($context.'filter_jahre', 'filter_jahre');
	    $search 		= $mainframe->getUserStateFromRequest($context.'search', 'search'); 
		$search			= JString::strtolower( $search ); 
		// search filter
		$lists['search']= $search; 
		$lists['state'] = JHTML::_('grid.state',$filter_state);

		$query = 'SELECT j.Jahr AS text, j.id AS value'
		. ' FROM #__po_jahr AS j'
		. ' ORDER BY j.Jahr DESC';
		$db->setQuery( $query );
		$years = $db->loadObjectList();
		array_unshift($years, JHTML::_('select.option', '0', '- '.JText::_('Select-year').' -', 'value', 'text'));
		//echo $years;
		//list Years
		$lists['jahre'] = JHTML::_( 'select.genericlist', $years, 'filter_jahre',  'onchange="document.adminForm.submit();"', 'value', 'text', intval( $filter_jahre ));
		
		// ...und nun die ganzen Listen übergeben
		$this->assignRef('lists', $lists);

		// Get data from the model
		$rolls		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

        //print_r($items);
		$this->assignRef('rolls',		$rolls);
		$this->assignRef('pagination', $pagination);


        // Die Toolbar hinzufügen
        $this->addToolBar();
		
		parent::display($tpl);
	}

	protected function addToolBar()
    {
		JToolBarHelper::title(JText::_( 'Charaktere-des-Potter-Events' ), 'generic.png' );
 
		JToolBarHelper::custom('CopyLesson','forward.png','forward.png','copylesson',true,false);
		JToolBarHelper::publish('lessons.publish','JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('lessons.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolBarHelper::editList('lesson.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::addNew('lesson.add', 'JTOOLBAR_NEW');
    }
}