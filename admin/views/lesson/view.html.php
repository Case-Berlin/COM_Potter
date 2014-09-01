<?php
/**
 * Lesson View für die Komponente Potter
 * Diese erzeugt die Sicht/Formular auf einen Darsteller der Tabelle #__po_lehrer
 * @package    Potter Komponente
 * @subpackage Komponente
 * @link http://www.derphoenixorden.de
 * @license		GNU/GPL
 */

// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view' );

/**
 * Lesson View
 */
class PotterViewLesson extends JViewLegacy
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
		JToolBarHelper::title(   JText::_( 'Lesson' ).': <small><small>[ ' . $text.' ]</small></small>' );
		if ($isNew==0)  
		{
			JToolBarHelper::custom('addteacher','upload.png','upload.png','addteacher', false, false);
		}
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

		$query = 'SELECT TRIM( CONCAT( IF(n.ma_vname IS NOT NULL,n.ma_vname,""), " ", IF(n.ma_name IS NOT NULL,n.ma_name,""),IF(n.published=0," (inaktiv)","")  ) ) AS text, n.id AS value'
		. ' FROM #__po_namen n, #__po_da_na dn WHERE dn.id_jahr='.$darst->id_jahr.' AND n.id=dn.id_name AND (dn.Funktion=1 OR dn.Funktion=4) ORDER BY n.published DESC,n.ma_name, n.ma_name';
		$db->setQuery( $query );
		//echo $query;
		$roll = $db->loadObjectList();
		//list Rolle
		array_unshift($roll, JHTML::_('select.option', '0', '- '.JText::_('Select-teacher').' -', 'value', 'text'));
		$lists['roll'] = JHTML::_( 'select.genericlist', $roll, 'id_name',  '', 'value', 'text', $darst->id_name);

		$query = 'SELECT Fach AS text, id AS value'
		. ' FROM #__po_faecher f where published=1 ORDER BY f.Fach';
		$db->setQuery( $query );
		$roll = $db->loadObjectList();
		//list Fach
		$lists['fach'] = JHTML::_( 'select.genericlist', $roll, 'id_fach',  '', 'value', 'text', $darst->id_fach);

		// wie ist nochmal der Fachname, um den es hier geht
		$query = 'SELECT Fach FROM #__po_faecher WHERE id = '.$darst->id_fach;
		$db->setQuery( $query );
		$lessonname = $db->loadResult();
		
		// so und nun mal schaun, welche Lehrer das Fach unterrichten
		$query  = 'SELECT TRIM( CONCAT( IF(n.ma_vname IS NOT NULL,n.ma_vname,""), " ", IF(n.ma_name IS NOT NULL,n.ma_name,""),IF(n.published=0," (inaktiv)","")  ) ) AS text, ';
		$query .= 'ln.id AS value, dn.bild bild ';
		$query .= 'FROM #__po_le_na ln, #__po_namen n, #__po_da_na dn ';
		$query .= 'WHERE ln.id_lehrer='.$darst->id.' AND ln.id_name=n.id AND ln.id_name=dn.id_name AND dn.id_jahr='.$darst->id_jahr.' ';
		$query .= 'ORDER BY n.published DESC,n.ma_name, n.ma_name';
		$db->setQuery( $query );
		//echo $query;
		$teachersname = $db->loadObjectList();

		
		$lists['image'] 		= JHTML::_('list.images',  'bild', $darst->bild ,null,'/'.$imgpath);
		$lists['published'] 	= JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $darst->published );
		$lists['sicher']		= JHTML::_('select.booleanlist',  'sicher', 'class="inputbox"', $darst->sicher );

		$this->assignRef('editor', $editor);
		$this->assignRef('lists', $lists);
		$this->assignRef('darst', $darst);
		$this->assignRef('imgpath', $imgpath);
		$this->assignRef('lessonname', $lessonname);
		$this->assignRef('teachersname', $teachersname);

		parent::display($tpl);
	}
}