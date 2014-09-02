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
	
	/**
	 * Method to delete record(s)
	 * @return	boolean	True on success
	 */
	public function remove($ids)
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$conditions = array(
			$db->quoteName('id').' IN ('.implode(", ", $ids).')'
		);
		$query->delete($db->quoteName('#__po_jahr'));
		$query->where($conditions);
		$db->setQuery($query);
		$db->query();
		return $db->getErrorMsg(false);
	}
	/**
	 * Method to activ record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	public function activ($ids)
	{
		$db = JFactory::getDBO();
		$err = true;
		if ((count($ids)==0) or (count($ids)>1))
		{ // es darf natürlich nur ein Jahr aktiviert sein
		   $err = false;
		} else
		{
		  	// löschen des alten aktiven Jahres
			$query = $db->getQuery(true);
			$fields = array($db->quoteName('aktuell') . ' = ' . $db->quote('0'));
			$conditions = array($db->quoteName('aktuell') . ' = 1');
			$query->update($db->quoteName('#__po_jahr'))->set($fields)->where($conditions);
			$db->setQuery($query);
 			$result = $db->query();
			if ($db->getErrorNum>0)
			{ 
				$err = false;
			}
			// setzen des neuen aktive Jahres
			$query = $db->getQuery(true);
			$fields = array($db->quoteName('aktuell').' = '.$db->quote('1'));
			$conditions = array($db->quoteName('id').' = '.$db->quote($ids[0]));
			$query->update($db->quoteName('#__po_jahr'))->set($fields)->where($conditions);
			$db->setQuery($query);
 			$result = $db->query();
			if ($db->getErrorNum>0)
			{ 
				$err = false;
             //$this->setError( $row->getErrorMsg() )
			}
		}
		return $err;
	} //Ende function activ
	
}