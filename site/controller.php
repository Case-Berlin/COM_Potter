<?php
/**
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport('joomla.application.component.controller');

class PotterController extends JControllerLegacy
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
/* Mal sehen ob es ohne geht
	public function display($cachable = false, $urlparams = false)
	{
		$document =& JFactory::getDocument();

		$viewName	= JRequest::getVar('view');
		$viewType	= $document->getType();
		
		if (isset($viewName))
		{
				$viewName	= $viewName;
				$layout		= 'default';			
		} else {
				$viewName	= 'potter';
				$layout		= 'default';
		}

		// Set the default view name from the Request
		$view = &$this->getView($viewName, $viewType);

		
		// Push a model into the view
		$model	= &$this->getModel( $viewName );
		if (!JError::isError( $model )) {
			$view->setModel( $model, true );
		}
		
		// Display the view
		$view->assign('error', $this->getError());
		$view->display($cachable = false, $urlparams = false);
		
//		parent::display();
	}
*/
}
?>
