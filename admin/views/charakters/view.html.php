<?php
/**
 * Charakters View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_da_na
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
class PotterViewCharakters extends JViewLegacy
{
	/**
	 * alle Rollen anzeigen
	 * @return void
	 **/
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
		$context			= 'com_potter.charakters.list.';
		$filter_order = $mainframe->getUserStateFromRequest($context.'filter_order', 'filter_order', 'published');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'DESC');
		// set the table order values
		$lists['order_Dir'] = $filter_order_Dir; 
		$lists['order'] = $filter_order;

		//Statusfilter bestücken
		$filter_state 	= $mainframe->getUserStateFromRequest($context.'filter_state', 'filter_state');
		$filter_jahre 	= $mainframe->getUserStateFromRequest($context.'filter_jahre', 'filter_jahre');
		$filter_haus 	= $mainframe->getUserStateFromRequest($context.'filter_haus', 'filter_haus');
		$filter_funktion = $mainframe->getUserStateFromRequest($context.'filter_funktion', 'filter_funktion');
		$filter_sonder 	= $mainframe->getUserStateFromRequest($context.'filter_sonder', 'filter_sonder');
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
		//echo $years;
		array_unshift($years, JHTML::_('select.option', '0', '- '.JText::_('Select-year').' -', 'value', 'text'));
		//list Years
		$lists['jahre'] = JHTML::_( 'select.genericlist', $years, 'filter_jahre',  'onchange="document.adminForm.submit();"', 'value', 'text', intval( $filter_jahre ));
		
		$Funktion_o = array();	
		$Funktion_o[0] = JHTML::_( 'select.option', 1, JText::_( 'sonstiges' ), 'value', 'text' );
		$Funktion_o[1] = JHTML::_( 'select.option', 2, JText::_( 'Lehrer' ), 'value', 'text' );
		$Funktion_o[2] = JHTML::_( 'select.option', 3, JText::_( 'Schueler' ), 'value', 'text' );
		$Funktion_o[3] = JHTML::_( 'select.option', 4, JText::_( 'Ministerium' ), 'value', 'text' );
		$Funktion_o[4] = JHTML::_( 'select.option', 5, JText::_( 'Ministerium-Lehrer' ), 'value', 'text' );
		$Funktion_o[5] = JHTML::_( 'select.option', 6, JText::_( 'Presse' ), 'value', 'text' );
		$this->assignRef('Funktion', $Funktion_o);
		array_unshift($Funktion_o, JHTML::_('select.option', '0', '- '.JText::_('Select Function').' -', 'value', 'text'));
		//string genericlist ( $arr, $tag_name, $tag_attribs, $key, $text, $selected, $idtag, $translate ) 
		$lists['Funktion'] = JHTML::_( 'select.genericlist', $Funktion_o, 'filter_funktion',  'onchange="document.adminForm.submit();"', 'value', 'text', intval( $filter_funktion ));

		$query = 'SELECT s.function AS text, s.id AS value'
		. ' FROM #__po_sonder AS s'
		. ' ORDER BY s.id';
		$db->setQuery( $query );
		$Sonder_o = $db->loadObjectList();
		//print_r($Sonder_o);
		$this->assignRef('Sonder', $Sonder_o);
		array_unshift($Sonder_o, JHTML::_('select.option', '0', '- '.JText::_('Select Sonder').' -', 'value', 'text'));
		$lists['Sonder'] = JHTML::_( 'select.genericlist', $Sonder_o, 'filter_sonder',  'onchange="document.adminForm.submit();"', 'value', 'text', intval( $filter_sonder ));

		$query = 'SELECT h.haus AS text, h.id AS value'
		. ' FROM #__po_haus AS h'
		. ' ORDER BY h.id';
		$db->setQuery( $query );
		$haus = $db->loadObjectList();
		//print_r($haus);
		$this->assignRef('haus', $haus);
		array_unshift($haus, JHTML::_('select.option', '0', '- '.JText::_('Select Haus').' -', 'value', 'text'));
		$lists['haus'] = JHTML::_( 'select.genericlist', $haus, 'filter_haus',  'onchange="document.adminForm.submit();"', 'value', 'text', intval( $filter_haus ));

		//print_r($Funktion_o);
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
 
		JToolBarHelper::custom('CopyChar','forward.png','forward.png','copychar',true,false);
		JToolBarHelper::publish('charakters.publish','JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('charakters.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolBarHelper::editList('charakter.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::addNew('charakter.add', 'JTOOLBAR_NEW');
    }

}