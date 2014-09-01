<?php
/**
 * Artist View für die Komponente Potter
 * Diese erzeugt die Sicht/Formular auf ein Jahr der Tabelle #__po_darst
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Year View
 */
class PotterViewSubject extends JViewLegacy
{
	/**
	 * display method of Artist view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the Darst
		$subject		=& $this->get('Data');

		$isNew		= ($subject->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Subject' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  
		{
			JToolBarHelper::cancel();
		} else 
		{
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		$lists['published'] 	= JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $subject->published );
		$this->assignRef('lists',	$lists);

		$this->assignRef('subject',		$subject);

		parent::display($tpl);
	}
}