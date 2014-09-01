<?php
/**
 * Lessons View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_lehrer
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Charakters View
 */
class PotterViewLessons extends JViewLegacy
{
	/**
	 * alle Rollen anzeigen
	 * @return void
	 **/
	function display($tpl = null)
	{
//		global $context;
		$context = JRequest::getCMD('context');
		$mainframe = JFactory::getApplication();
		
		$db			=& JFactory::getDBO();
		$uri		=& JFactory::getURI();
		$document	= & JFactory::getDocument();

		/**
		* Writes a custom option and task button for the button bar
		* @param string The task to perform (picked up by the switch($task) blocks
		* @param string The image to display
		* @param string The image to display when moused over
		* @param string The alt text for the icon image
		* @param boolean True if required to check that a standard list item is checked
		* @param boolean True if required to include callinh hideMainMenu() 
		JToolBarHelper::custom( 'task', 'icon', 'icon over', 'alt', boolean, boolean );		
		*/
		JToolBarHelper::title(   JText::_( 'Charaktere-des-Potter-Events' ), 'generic.png' );
		JToolBarHelper::custom('CopyLesson','forward.png','forward.png','copylesson',true,false);
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

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
		parent::display($tpl);
	}
}