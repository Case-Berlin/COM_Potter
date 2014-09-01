<?php
/**
 * Artists Controller für Potter Komponente
 * 
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Potter Darsteller Controller
 *
 */

class PotterControllerArtists extends PotterController
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
		JRequest::setVar( 'view', 'artist' );
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
		$model = $this->getModel('artist');
		if ($model->store($post)) 
		{
			$msg = JText::_( 'artistsaved' );
		} else 
		{
			$msg = JText::_( 'errorsaveartist' );
		}
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_potter&view=artists';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('artist');
		if(!$model->delete()) 
		{
			$msg = JText::_( 'errordeleteartist' );
		} else 
		{
			$msg = JText::_( 'artistdelete' );
		}
		$this->setRedirect( 'index.php?option=com_potter&view=artists', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'opcancel' );
		$this->setRedirect( 'index.php?option=com_potter&view=artists', $msg );
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

		$model = $this->getModel('artist');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=artists';
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

		$model = $this->getModel('artist');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=artists';
		$this->setRedirect($link);
	}
	
}