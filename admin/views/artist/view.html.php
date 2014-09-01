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
class PotterViewArtist extends JViewLegacy
{
	/**
	 * display method of Artist view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the Darst
		$darst		=& $this->get('Data');
		$editor 	=& JFactory::getEditor();	

		$isNew		= ($darst->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Artists' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  
		{
			JToolBarHelper::cancel();
		} else 
		{
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		$lists['image'] 		= JHTML::_('list.images',  'Bild', $darst->Bild ,null,'/images/potter/personen/');
		$lists['published'] 	= JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $darst->published );
		$lists['anzeigen']		= JHTML::_('select.booleanlist',  'anzeigen', 'class="inputbox"', $darst->anzeigen );
		$lists['showmail']		= JHTML::_('select.booleanlist',  'showmail', 'class="inputbox"', $darst->showmail );
		$lists['fezma']			= JHTML::_('select.booleanlist',  'fezma', 'class="inputbox"', $darst->fezma );
		$lists['sex']			= JHTML::_('select.booleanlist',  'sex', 'class="inputbox"', $darst->sex,'man','woman' );
		$lists['user']			= JHTML::_( 'list.users', 'joomlaid', $darst->joomlaid, true, null, 'name', false );

		$this->assignRef('editor', $editor);
		$this->assignRef('lists', $lists);
		$this->assignRef('darst',		$darst);

		parent::display($tpl);
	}
}