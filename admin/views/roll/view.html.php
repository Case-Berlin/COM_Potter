<?php
/**
 * Roll View für die Komponente Potter
 * Diese erzeugt die Sicht/Formular auf ein Jahr der Tabelle #__po_namen
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Roll View
 */
class PotterViewRoll extends JViewLegacy
{
	/**
	 * display method of Roll view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the Namen
		$roll		=& $this->get('Data');

		$isNew		= ($roll->id < 1);
		
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Roll' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  
		{
			JToolBarHelper::cancel();
		} else 
		{
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		$lists['published'] 	= JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $roll->published );

		$magie_o = array();		
		$magie_o[0] = JHTML::_( 'select.option', 0, JText::_( 'neutral' ), 'value', 'text' );
		$magie_o[1] = JHTML::_( 'select.option', 1, JText::_( 'WHITE_B' ), 'value', 'text' );
		$magie_o[2] = JHTML::_( 'select.option', 2, JText::_( 'BLACK_B' ), 'value', 'text' );
		$magie_o[3] = JHTML::_( 'select.option', 3, JText::_( 'WHITE_U' ), 'value', 'text' );
		$magie_o[4] = JHTML::_( 'select.option', 4, JText::_( 'BLACK_U' ), 'value', 'text' );
		$lists['magie']			= JHTML::_( 'select.genericlist', $magie_o, 'Magie', null, 'value', 'text', $roll->Magie );

		$haus_o = array();		
		$haus_o[0] = JHTML::_( 'select.option', 0, JText::_( 'UNKNOWN' ), 'value', 'text' );
		$haus_o[1] = JHTML::_( 'select.option', 1, JText::_( 'Gryffindor' ), 'value', 'text' );
		$haus_o[2] = JHTML::_( 'select.option', 2, JText::_( 'Ravenclaw' ), 'value', 'text' );
		$haus_o[3] = JHTML::_( 'select.option', 3, JText::_( 'Hufflepuff' ), 'value', 'text' );
		$haus_o[4] = JHTML::_( 'select.option', 4, JText::_( 'Slytherin' ), 'value', 'text' );
		$haus_o[5] = JHTML::_( 'select.option', 5, JText::_( 'Bossander' ), 'value', 'text' );
		

		$lists['haus']			= JHTML::_( 'select.genericlist', $haus_o, 'haus', null, 'value', 'text', $roll->haus );

		$sex_o = array();		
		$sex_o[0] = JHTML::_( 'select.option', 0, JText::_( 'WOMAN' ), 'value', 'text' );
		$sex_o[1] = JHTML::_( 'select.option', 1, JText::_( 'MAN' ), 'value', 'text' );
		$sex_o[2] = JHTML::_( 'select.option', 2, JText::_( 'GMORF' ), 'value', 'text' );
		$lists['sex']			= JHTML::_( 'select.genericlist', $sex_o, 'sex', null, 'value', 'text', $roll->sex );

		$this->assignRef('lists',	$lists);
		$this->assignRef('roll',	$roll);

		parent::display($tpl);
	}
}