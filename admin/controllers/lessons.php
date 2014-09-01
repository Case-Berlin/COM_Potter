<?php
/**
 * Lessons Controller für Potter Komponente
 * 
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Potter Unterrich Controller
 *
 */

class PotterControllerLessons extends PotterController
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
    

	function AddTeacher()
	{
		$post = JRequest::get( 'post' );
		if ($post['id_name']<>0)
		{
			//print_r( $post);
			$model = $this->getModel('lesson');
			if(!$model->AddTeacher($post['id_name'],$post['id'])) 
			{
				echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
			}
		}
		JRequest::setVar( 'cid', $post['id']);
		JRequest::setVar( 'view', 'lesson' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function DelTeacher()
	{
		$tid = JRequest::get('tid', 0);
		if ($tid['tid']<>0)
		{
			//print_r( $tid);
			$model = $this->getModel('lesson');
			if(!$model->DelTeacher($tid['tid'])) 
			{
				echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
			}
			//echo '>'.$post['id'].'<';
			// hier nun noch diesen einen Lehrer zufügen
		}
		JRequest::setVar( 'cid', $tid['fid']);
		JRequest::setVar( 'view', 'lesson' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}
	
	/**
	 * Setzen des Standard Jahres
	 * altes Jahr löschen, neues setzen
	 */

	function CopyLesson()
	{
//		global $mainframe;
		$mainframe = JFactory::getApplication();

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to copy' ) );
		}

		$model = $this->getModel('lesson');
		$year = $model->getAktYear();
		//echo $year;
		if(!$model->copyLesson($cid, $year)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=lessons';
		$this->setRedirect($link);
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'lesson' );
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
		$model = $this->getModel('lesson');
		if ($model->store($post)) 
		{
			$msg = JText::_( 'lessonsaved' );
		} else 
		{
			$msg = JText::_( 'errorsavelesson' );
		}
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_potter&view=lessons';
		$this->setRedirect($link, $msg);
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'opcancel' );
		$this->setRedirect( 'index.php?option=com_potter&view=lessons', $msg );
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

		$model = $this->getModel('lesson');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=lessons';
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

		$model = $this->getModel('lesson');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$link = 'index.php?option=com_potter&view=lessons';
		$this->setRedirect($link);
	}
	
}