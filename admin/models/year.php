<?php
/**
 * Year Form View für die Komponente Potter
 * Diese erzeugt die Sicht auf einen Eintrag in #__po_jahr
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */
 
// Den direkten Aufruf verbieten
defined('_JEXEC') or die;
 
// Die Joomla! JModelAdmin Klasse importieren
jimport('joomla.application.component.modeladmin');
 
/**
 * Year Model
 */
class PotterModelYear extends JModelAdmin
{
    public function getTable($name = 'Years', $prefix = 'PotterTable', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }
 
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
		$options = array('control' => 'jform', 'load_data' => $loadData);
        $form = $this->loadForm('com_potter.year', 'year', $options);
 
        if (empty($form))
        {
            return false;
        }
 
        return $form;
    }
 
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $app  = JFactory::getApplication();
        $data = $app->getUserState('com_potter.edit.year.data',array());
 
        if (empty($data))
        {
            $data = $this->getItem();
        }
         return $data;
    }
}