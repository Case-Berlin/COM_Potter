<?php
/**
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Potter Jahre Controller
 */

class PotterControllerYears extends PotterController
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
	 
	function activYear()
	{
		$model = $this->getModel('year');
		if(!$model->activ()) 
		{
			$msg = JText::_( 'erroractivatedyear' );
		} else 
		{
			$msg = JText::_( 'yearactivated' );
		}
		$this->setRedirect( 'index.php?option=com_potter&view=years', $msg );
	}

	/**
	 * display the edit form
	 * @return void
	 */

	function edit()
	{
		JRequest::setVar( 'view', 'year' );
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
		$model = $this->getModel('year');
		if ($model->store($post)) 
		{
			$msg = JText::_( 'yearsaved' );
		} else 
		{
			$msg = JText::_( 'errorsaveyear' );
		}
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_potter&view=years';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('year');
		if(!$model->delete()) 
		{
			$msg = JText::_( 'errordeleteyear' );
		} else 
		{
			$msg = JText::_( 'yeardelete' );
		}
		$this->setRedirect( 'index.php?option=com_potter&view=years', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'opcancel' );
		$this->setRedirect( 'index.php?option=com_potter&view=years', $msg );
	}
}
