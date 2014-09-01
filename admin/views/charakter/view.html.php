<?php
/**
 * Charakter View für die Komponente Potter
 * Diese erzeugt die Sicht/Formular auf einen Darsteller der Tabelle #__po_da_na
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Charakter View
 */
class PotterViewCharakter extends JViewLegacy
{
	/**
	 * display method of Charakter view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the Darst
		$darst		=& $this->get('Data');
		$editor 	=& JFactory::getEditor();	
		$db			=& JFactory::getDBO();
		$uri 		=& JFactory::getURI();

		$isNew		= ($darst->id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Charakter' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  
		{
			JToolBarHelper::cancel();
		} else 
		{
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		$query = 'SELECT j.Jahr AS text, j.id AS value'
		. ' FROM #__po_jahr AS j';
		$db->setQuery( $query );
		$years = $db->loadObjectList();
		//list Jahre
		$lists['years'] = JHTML::_( 'select.genericlist', $years, 'id_jahr',  '', 'value', 'text', $darst->id_jahr);

		// Bilderpfad aus der Jahrestabelle extraieren
		$query = 'SELECT path FROM #__po_jahr WHERE id = '.(int) $darst->id_jahr;
		$db->setQuery( $query );
		$imgpath = $db->loadResult().'/';
		//echo $imgpath;

		$query = 'SELECT TRIM( CONCAT( IF(realvname IS NOT NULL,realvname,""), " ", IF(realname IS NOT NULL,realname,""),IF(published=0," (inaktiv)","")  ) ) AS text, id AS value'
		. ' FROM #__po_darst ORDER BY published DESC, realname, realvname';
		$db->setQuery( $query );
		$person = $db->loadObjectList();
		//list Darsteller
		$lists['person'] = JHTML::_( 'select.genericlist', $person, 'id_darst',  '', 'value', 'text', $darst->id_darst);

		$query = 'SELECT TRIM( CONCAT( IF(ma_vname IS NOT NULL,ma_vname,""), " ", IF(ma_name IS NOT NULL,ma_name,""),IF(published=0," (inaktiv)","")  ) ) AS text, id AS value'
		. ' FROM #__po_namen ORDER BY published DESC, ma_name, ma_name';
		$db->setQuery( $query );
		$roll = $db->loadObjectList();
		//list Rolle
		$lists['roll'] = JHTML::_( 'select.genericlist', $roll, 'id_name',  '', 'value', 'text', $darst->id_name);

		$query = 'SELECT TRIM( CONCAT( IF(ma_vname IS NOT NULL,ma_vname,""), " ", IF(ma_name IS NOT NULL,ma_name,""),IF(published=0," (inaktiv)","")  ) ) AS text, id AS value'
		. ' FROM #__po_namen WHERE id = '.$darst->id_name;
		$db->setQuery( $query );
		$rollname = $db->loadResult();
		
		
		$Funktion_o = array();	
		$Funktion_o[0] = JHTML::_( 'select.option', 0, JText::_( 'sonstiges' ), 'value', 'text' );
		$Funktion_o[1] = JHTML::_( 'select.option', 1, JText::_( 'Lehrer' ), 'value', 'text' );
		$Funktion_o[2] = JHTML::_( 'select.option', 2, JText::_( 'Schueler' ), 'value', 'text' );
		$Funktion_o[3] = JHTML::_( 'select.option', 3, JText::_( 'Ministerium' ), 'value', 'text' );
		$Funktion_o[4] = JHTML::_( 'select.option', 4, JText::_( 'Ministerium/Lehrer' ), 'value', 'text' );
		$Funktion_o[5] = JHTML::_( 'select.option', 5, JText::_( 'Presse' ), 'value', 'text' );
//		$this->assignRef('Funktion', $Funktion_o);
		$lists['Funktion'] = JHTML::_( 'select.genericlist', $Funktion_o, 'Funktion', null, 'value', 'text',$darst->Funktion);
/*		
		$Sonder_o = array();	
		$Sonder_o[0] = JHTML::_( 'select.option', 0, JText::_( 'keine' ), 'value', 'text' );
		$Sonder_o[1] = JHTML::_( 'select.option', 1, JText::_( 'Vertrauensschueler' ), 'value', 'text' );
		$Sonder_o[2] = JHTML::_( 'select.option', 2, JText::_( 'Schulsprecher' ), 'value', 'text' );
		$Sonder_o[3] = JHTML::_( 'select.option', 3, JText::_( 'Hauslehrer' ), 'value', 'text' );
		//$this->assignRef('Sonder', $Sonder_o);
		$lists['Sonder'] = JHTML::_( 'select.genericlist', $Sonder_o, 'Sonder',  null, 'value', 'text', $darst->Sonder);
*/
		$query = 'SELECT s.function AS text, (s.id-1) AS value'
		. ' FROM #__po_sonder AS s'
		. ' ORDER BY s.id';
		$db->setQuery( $query );
		$Sonder_o = $db->loadObjectList();
		//list Sonder
		$lists['Sonder'] = JHTML::_( 'select.genericlist', $Sonder_o, 'Sonder',  null, 'value', 'text', $darst->Sonder);


		
		$lists['image'] 		= JHTML::_('list.images',  'bild', $darst->bild ,null,'/'.$imgpath);
		$lists['published'] 	= JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $darst->published );
		$lists['sicher']		= JHTML::_('select.booleanlist',  'sicher', 'class="inputbox"', $darst->sicher );

		$this->assignRef('editor', $editor);
		$this->assignRef('lists', $lists);
		$this->assignRef('darst', $darst);
		$this->assignRef('imgpath', $imgpath);
		$this->assignRef('rollname', $rollname);

		parent::display($tpl);
	}
}