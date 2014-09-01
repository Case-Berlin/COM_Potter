<?php
/**
 * Years Controller für die Komponente Potter
 * Diese steuert years in #__po_jahr
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */
 
defined('_JEXEC') or die;
 
// Die Joomla! JControllerAdmin Klasse importieren
jimport('joomla.application.component.controlleradmin');
 
class PotterControllerYears extends JControllerAdmin
{
    public function getModel($name = 'years', $prefix = 'PotterModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }

	function delete()
	{
		$logger = getLogger();
		$input =  JFactory::getApplication()->input;
		$ids = $input->post->get('cid', array(), 'array');
		JArrayHelper::toInteger($ids);
		$model = $this->getModel('years');
		$msg = $model->remove($ids, $logger);
		$this->setRedirect(JRoute::_('index.php?option=com_potter&view=years',false), $msg ,'notice');
	}
	function activYear()
	{
		$model = $this->getModel('years');
		if(!$model->activ()) 
		{
			$msg = JText::_( 'erroractivatedyear' );
		} else 
		{
			$msg = JText::_( 'yearactivated' );
		}
		$this->setRedirect(JRoute::_('index.php?option=com_potter&view=years',false), $msg );
	}

}

