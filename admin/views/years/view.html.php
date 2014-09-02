<?php
/**
 * Years View für die Komponente Potter
 * Diese erzeugt die Sicht auf die Liste #__po_jahr
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.view');
jimport('joomla.utilities.utility');

/**
 * Years View
 */
class PotterViewYears extends JViewLegacy
{
	/**
	 * alle Jahre anzeigen
	 * @return void
	 **/
	 protected $items;
	 protected $pagination;
	 protected $state;
	 
	function display($tpl = null)
	{
		//echo "view years";
		// Get data from the model
        $this->items = $this->get('Items');
        // Ein JPagination Objekt beziehen
        $this->pagination = $this->get('Pagination');

        // Die Toolbar hinzufügen
        $this->addToolBar();
 
		parent::display($tpl);
	}
    /**
     * Setting the toolbar
     */
    protected function addToolBar()
    {
		JToolBarHelper::title(JText::_( 'Potter-Event-Jahre' ), 'generic.png' );
 
		JToolBarHelper::makeDefault('years.activYear','aktyear');
		JToolBarHelper::deleteList('', 'years.delete', 'JTOOLBAR_DELETE');
		JToolBarHelper::editList('year.edit', 'JTOOLBAR_EDIT');
		JToolBarHelper::addNew('year.add', 'JTOOLBAR_NEW');

    }
	
}