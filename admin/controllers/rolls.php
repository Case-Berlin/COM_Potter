<?php
/**
 * Rolls Controller für Potter Komponente
 * 
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Potter Darsteller Controller
 *
 */

class PotterControllerRolls extends PotterController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */

	function __construct()
	{
		parent::__construct();
		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
	}
    

	/**
	 * display the edit form
	 * @return void
	 */

	function edit()
	{
		JRequest::setVar( 'view', 'roll' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('roll');
		if ($model->store($post)) 
		{
			$msg = JText::_( 'rollsaved' );
		} else 
		{
			$msg = JText::_( 'errorsaveroll' );
		}
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_potter&view=rolls';
		$this->setRedirect($link, $msg);
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'opcancel' );
		$this->setRedirect( 'index.php?option=com_potter&view=rolls', $msg );
	}
	
	function publish()
	{
//		global $mainframe;
		$mainframe = JFactory::getApplication();

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('roll');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=rolls';
		$this->setRedirect($link);
	}

	function unpublish()
	{
//		global $mainframe;
		$mainframe = JFactory::getApplication();

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('roll');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=rolls';
		$this->setRedirect($link);
	}
	
}