<?php
/**
 * Year Tabelle für die Komponente Potter
 * Beschreibung der Tabelle: #__po_jahr
 * @package    Potter Komponente
 * @subpackage Komponente
 */

// Den direkten Aufruf verbieten
defined('_JEXEC') or die;
 
// Die Joomla! Form Helper Bibliothek importieren
jimport('joomla.form.helper');
 
JFormHelper::loadFieldClass('list');
 
/**
 * HalloWelt Form Field class for the HalloWelt component
 */
class JFormFieldPotterYears extends JFormFieldList
{
    /**
     * The field type.
     *
     * @var string
     */
    protected $type = 'PotterYears';
 
    /**
     * Method to get a list of options for a list input.
     *
     * @return array An array of JHtml options.
     */
    protected function getOptions()
    {
        $db = JFactory::getDBO();
 
        $query = $db->getQuery(true);
 
        $query->from('#__po_jahr');
        $query->select('id, Jahr');
 
        $db->setQuery((string) $query);
 
        $messages = $db->loadObjectList();
 
        $options = array();
 
        if ($messages)
        {
            foreach ($messages as $message)
            {
                $options[] = JHtml::_('select.option', $message->id, $message->Jahr);
            }
        }
 
        $options = array_merge(parent::getOptions(), $options);
 
        return $options;
    }
}
?>