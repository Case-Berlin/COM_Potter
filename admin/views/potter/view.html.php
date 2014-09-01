<?php
/**
 * Potter View für Potter Komponente
 * Hier ist nur eine Übersicht zu sehen
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