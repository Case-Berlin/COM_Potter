<?php
/**
 * Potter View f�r Potter Komponente
 * Hier ist nur eine �bersicht zu sehen
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Potter View
 */
class PotterViewPotter extends JViewLegacy
{
	/**
	 * Potter view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'Potter-Event' ), 'generic.png' );
		parent::display($tpl);

	}

}