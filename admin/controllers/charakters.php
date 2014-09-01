<?php
/**
 * Charakters Controller für Potter Komponente
 * 
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Potter Darsteller Controller
 *
 */

class PotterControllerCharakters extends PotterController
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
	 * Setzen des Standard Jahres
	 * altes Jahr löschen, neues setzen
	 */
	 
	function CopyChar()
	{
//		global $mainframe;
		$mainframe = JFactory::getApplication();

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to copy' ) );
		}

		$model = $this->getModel('charakter');
		$year = $model->getAktYear();
		//echo $year;
		if(!$model->copyChar($cid, $year)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=charakters';
		$this->setRedirect($link);
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'charakter' );
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
		$model = $this->getModel('charakter');
		if ($model->store($post)) 
		{
			$msg = JText::_( 'charaktersaved' );
		} else 
		{
			$msg = JText::_( 'errorsavecharakter' );
		}
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_potter&view=charakters';
		$this->setRedirect($link, $msg);
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'opcancel' );
		$this->setRedirect( 'index.php?option=com_potter&view=charakters', $msg );
	}
	
	function publish()
	{
		global $mainframe;

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('charakter');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=charakters';
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

		$model = $this->getModel('charakter');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=charakters';
		$this->setRedirect($link);
	}
	
}