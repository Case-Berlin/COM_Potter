<?php
/**
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.controller');

//$view	= JRequest::getVar( 'view', '', '', 'string', JREQUEST_ALLOWRAW );
$input	= JFactory::getApplication()->input;
$view	= $input->get('view','potter');
$layout	= $input->get('layout','default');
//echo "View: ".$view." | ";
if ($layout=='default')
{
	switch($view)
	{
	  case 'years' :
    	  JSubMenuHelper::addEntry(JText::_('years'),      'index.php?option=com_potter&view=years',true);
	      JSubMenuHelper::addEntry(JText::_('artists'), 'index.php?option=com_potter&view=artists');
    	  JSubMenuHelper::addEntry(JText::_('subjects'),     'index.php?option=com_potter&view=subjects');
	      JSubMenuHelper::addEntry(JText::_('rolls'),      'index.php?option=com_potter&view=rolls');
    	  JSubMenuHelper::addEntry(JText::_('charakters'),      'index.php?option=com_potter&view=charakters');
	      JSubMenuHelper::addEntry(JText::_('lessons'), 'index.php?option=com_potter&view=lessons');
    	  break;
	  case 'artists' :
    	  JSubMenuHelper::addEntry(JText::_('years'),      'index.php?option=com_potter&view=years');
	      JSubMenuHelper::addEntry(JText::_('artists'), 'index.php?option=com_potter&view=artists',true);
    	  JSubMenuHelper::addEntry(JText::_('subjects'),     'index.php?option=com_potter&view=subjects');
	      JSubMenuHelper::addEntry(JText::_('rolls'),      'index.php?option=com_potter&view=rolls');
    	  JSubMenuHelper::addEntry(JText::_('charakters'),      'index.php?option=com_potter&view=charakters');
	      JSubMenuHelper::addEntry(JText::_('lessons'), 'index.php?option=com_potter&view=lessons');
    	  break;
	  case 'subjects' :
    	  JSubMenuHelper::addEntry(JText::_('years'),      'index.php?option=com_potter&view=years');
	      JSubMenuHelper::addEntry(JText::_('artists'), 'index.php?option=com_potter&view=artists');
    	  JSubMenuHelper::addEntry(JText::_('subjects'),     'index.php?option=com_potter&view=subjects',true);
	      JSubMenuHelper::addEntry(JText::_('rolls'),      'index.php?option=com_potter&view=rolls');
    	  JSubMenuHelper::addEntry(JText::_('charakters'),      'index.php?option=com_potter&view=charakters');
	      JSubMenuHelper::addEntry(JText::_('lessons'), 'index.php?option=com_potter&view=lessons');
    	  break;
	  case 'rolls' :
    	  JSubMenuHelper::addEntry(JText::_('years'),      'index.php?option=com_potter&view=years');
	      JSubMenuHelper::addEntry(JText::_('artists'), 'index.php?option=com_potter&view=artists');
    	  JSubMenuHelper::addEntry(JText::_('subjects'),     'index.php?option=com_potter&view=subjects');
	      JSubMenuHelper::addEntry(JText::_('rolls'),      'index.php?option=com_potter&view=rolls',true);
	      JSubMenuHelper::addEntry(JText::_('charakters'),      'index.php?option=com_potter&view=charakters');
    	  JSubMenuHelper::addEntry(JText::_('lessons'), 'index.php?option=com_potter&view=lessons');
	      break;
	  case 'charakters' :
	      JSubMenuHelper::addEntry(JText::_('years'),      'index.php?option=com_potter&view=years');
	      JSubMenuHelper::addEntry(JText::_('artists'), 'index.php?option=com_potter&view=artists');
	      JSubMenuHelper::addEntry(JText::_('subjects'),     'index.php?option=com_potter&view=subjects');
	      JSubMenuHelper::addEntry(JText::_('rolls'),      'index.php?option=com_potter&view=rolls');
	      JSubMenuHelper::addEntry(JText::_('charakters'),      'index.php?option=com_potter&view=charakters',true);
	      JSubMenuHelper::addEntry(JText::_('lessons'), 'index.php?option=com_potter&view=lessons');
	      break;
	  case 'lessons' :
	      JSubMenuHelper::addEntry(JText::_('years'),      'index.php?option=com_potter&view=years');
	      JSubMenuHelper::addEntry(JText::_('artists'), 'index.php?option=com_potter&view=artists');
	      JSubMenuHelper::addEntry(JText::_('subjects'),     'index.php?option=com_potter&view=subjects');
	      JSubMenuHelper::addEntry(JText::_('rolls'),      'index.php?option=com_potter&view=rolls');
	      JSubMenuHelper::addEntry(JText::_('charakters'),      'index.php?option=com_potter&view=charakters');
	      JSubMenuHelper::addEntry(JText::_('lessons'), 'index.php?option=com_potter&view=lessons',true);
	      break;
	  default:
	      JSubMenuHelper::addEntry(JText::_('years'),      'index.php?option=com_potter&view=years');
	      JSubMenuHelper::addEntry(JText::_('artists'), 'index.php?option=com_potter&view=artists');
	      JSubMenuHelper::addEntry(JText::_('subjects'),     'index.php?option=com_potter&view=subjects');
	      JSubMenuHelper::addEntry(JText::_('rolls'),      'index.php?option=com_potter&view=rolls');
	      JSubMenuHelper::addEntry(JText::_('charakters'),      'index.php?option=com_potter&view=charakters');
	      JSubMenuHelper::addEntry(JText::_('lessons'), 'index.php?option=com_potter&view=lessons');
	}
}
/**
 * Potter Component Controller
 */
class PotterController extends JControllerLegacy
{
	/**
	 * @var string Standardview
	 */
	protected $default_view = 'potter';

	/**
	 * Method to display the view
	 */

	public function display($cachable = false, $urlparams = false)
	{
		//JRequest::setVar('view', JRequest::getCmd('view', 'Potter'));
		$input	= JFactory::getApplication()->input;
		$view	= $input->get('view',$this->default_view);
		$layout	= $input->get('layout','default');
		$id		= $input->getInt('id');
		if ($view == 'year' && $layout == 'edit')
		{
			if (!$this->checkEditId('com_potter.edit.year', $id) )
			{
				$this->setRedirect(JRoute::_('index.php?option=com_potter&view=years',false));
				return false;
			}
		}
		parent::display($cachable, $urlparams);
		
		return $this;
	}
}