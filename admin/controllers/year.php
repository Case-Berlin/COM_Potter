<?php
 
// Den direkten Aufruf verbieten
defined('_JEXEC') or die;
 
// Die Joomla! JControllerForm Klasse importieren
jimport('joomla.application.component.controllerform');
 
/**
 * HalloWelt Controller
 */
class PotterControllerYear extends JControllerForm
{
	public function save($key = null, $urlVar = null)
	{
		$return = parent::save($key, $urlVar);
		$this->setRedirect('index.php?option=com_potter&view=years');
		return $return;
	}
	public function cancel($key = null)
	{
		$return = parent::cancel($key);
		$this->setRedirect('index.php?option=com_potter&view=years');
		return $return;
	}
	
}