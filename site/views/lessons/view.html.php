<?php
/**
 * Lessons View fuer Potter Komponente
 * 
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 *
 */
class potterViewLessons extends JViewLegacy
{
	function display($tpl = null)
	{
//		global $mainframe;
		$mainframe = JFactory::getApplication();
		$params = &$mainframe->getPageParameters();
		$offen	= $params->get('filter');
		//print_r($params);
		//echo "::".$offen."::";
		$user =& JFactory::getUser();
  	    if (($user->guest) and ($offen<>1)) 
		{
		   echo "<p><h3>Du bist nicht eingeloggt!</h3>";
	 	} else
		{
			$db		=& JFactory::getDBO();
			$db_pre 	= $db->getPrefix();
			$query =' SELECT * FROM `'.$db_pre.'po_darst` WHERE joomlaid='.$user->id;
			$db->setQuery( $query );
			$result = $db->loadObjectList();
         	if ((count($result)==0) and ($offen<>1))
         	{
            	echo "<p><h3>Du bist noch kein registrierter Darsteller des Events! Melde Dich beim Webmaster</h3>";
         	}else
         	{
	            //echo $result[0]->realname.'<br>';
    	        //print_r ($result);
				// prepare list array
				$lists = array();
				if ($params->get('filter') == 1)
				{
					$filter1 = " l.published = 1 AND";
					$filter2 = " dn.published = 1 AND ";
				
				} else
				{
					$filter1 = " l.sicher = 1 AND";
					$filter2 = " dn.sicher = 1 AND ";
				}
				$query  = "SELECT * FROM #__po_jahr WHERE id=".$params->get('idjahr');
				$db->setQuery( $query );
				$year = $db->loadObjectList();
 				
				$query  = "SELECT l.*,f.Fach";
				$query .= " FROM #__po_lehrer l, #__po_faecher f";
				$query .= " WHERE l.id_fach=f.id AND";
				$query .= $filter1;
				$query .= "	l.id_jahr=".$params->get('idjahr');
				$query .= " ORDER BY l.Raum";
				//echo $query;

				$db->setQuery( $query );
				$lessons = $db->loadObjectList();
				//print_r($lessons);

				// Anfang MySQL 4.0
				$query  = "SELECT id FROM #__po_lehrer where id_jahr=".$params->get('idjahr');
				$db->setQuery( $query );
				$lehrer = $db->loadResultArray();
				$anz=0;
				$inselect = "";
				for ($i=0, $n=count( $lehrer ); $i < $n; $i++)
				{
					if ($anz<>0) {$inselect .= ",";} 
					$inselect .= $lehrer[$i];
					$anz++;
				}
				//echo $inselect;
				// Ende MySQL 4.0
				
				$query  = "SELECT na.id_lehrer,n.ma_vname,n.ma_name,n.ma_titel,dn.published published, dn.sicher sicher, dn.bild bild FROM #__po_le_na na, #__po_namen n, #__po_da_na dn ";
				$query .= "WHERE na.id_name=n.id AND dn.id_name=na.id_name AND dn.id_jahr=".$params->get('idjahr')." AND ";
				$query .= $filter2;
				// geht erst ab mysql 4.1
				//$query .= "id_lehrer in (SELECT id FROM #__po_lehrer where id_jahr=".$params->get('idjahr').") ";
				$query .= "id_lehrer in (".$inselect.") ";
				$query .= "ORDER BY n.ma_name, n.ma_vname";	
				//echo $query;
				$db->setQuery( $query );
				$teachers = $db->loadObjectList();
				//print_r($teachers);

				$this->assignRef('year', $year);
				$this->assignRef('params', $params);
				$this->assignRef('darst', $result);
				$this->assignRef('lessons', $lessons);
				$this->assignRef('teachers', $teachers);
				parent::display($tpl);
         	}
		}
	}
}
?>
