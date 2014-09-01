<?php
/**
 * Year View für die Komponente Potter
 * Diese erzeugt die Sicht/Formular auf ein Jahr der Tabelle #__po_jahr
 * @package    Potter Komponente
 * @subpackage Komponente
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.view');
jimport('joomla.utilities.utility');

/**
 * Year View
 */
class PotterViewYear extends JViewLegacy
{
    protected $item; // Daten
    protected $form; // Formular
	protected $state;
	/**
	 * display method of Year view
	 * @return void
	 **/
	function display($tpl = null)
	{
        // Das Formular.
        $this->form = $this->get('Form');
        // Die Daten werden bezogen.
        $this->item = $this->get('Item');

        /* Fehler abfangen, die beim Aufbau der View aufgetreten sind  */
        if (count($errors = $this->get('Errors'))) 
		{
            JError::raiseError(500, implode('/n', $errors));
        }
		
		// Die Toolbar hinzufügen.
        $this->addToolBar();
		parent::display($tpl);
	}
    /**
     * Setting the toolbar.
     */
    protected function addToolBar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);
 
        $isNew = ($this->item->id == 0);
 
        JToolBarHelper::title(
            $isNew
            ? JText::_('NEW_POTTER_YEAR')
            : JText::_(JText::_( 'year' ).': <small><small>[ EDIT ]</small></small>' )
        );
 
		JToolBarHelper::apply('year.apply', 'JTOOLBAR_APPLY'); // Save
        JToolBarHelper::save('year.save','JTOOLBAR_SAVE');     // Save & Close
        JToolBarHelper::save2copy('year.save2copy');           // Speichern in neues ??
        JToolBarHelper::save2new('year.save2new');             // Speichern in neues ??
		// Close
		$closetext = $isNew ? JText::_('JTOOLBAR_CANCEL') : JText::_('JTOOLBAR_CLOSE');

        JToolBarHelper::cancel('year.cancel', $closetext);
    }
	
}