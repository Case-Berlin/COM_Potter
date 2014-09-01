<?php
/**
 * Houses View für Potter Komponente
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view');

class potterViewHouses extends JViewLegacy
{
	function display($tpl = null)
	{
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
			$db			=& JFactory::getDBO();
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
					$filter2 = "dn.published = 1 AND ";
				
				} else
				{
					$filter2 = "dn.sicher = 1 AND ";
				}
				$query  = "SELECT * FROM #__po_jahr WHERE id=".$params->get('idjahr');
				$db->setQuery( $query );
				$year = $db->loadObjectList();
 				
				$query  = "SELECT dn.Sonder, dn.published,dn.sicher,dn.bild, n.ma_name, n.ma_vname, n.ma_titel, n.haus ";
				$query .= "FROM #__po_da_na dn, #__po_namen n ";
				$query .= "WHERE dn.id_name=n.id AND dn.sonder<>0 AND ";
				$query .= $filter2;
				$query .= "dn.id_jahr =".$params->get('idjahr')." ";
				$query .= "ORDER BY n.haus";
				//echo $query;

				$db->setQuery( $query );
				$rolls = $db->loadObjectList();
				//print_r($rolls);


				$this->assignRef('year', $year);
				$this->assignRef('params', $params);
				$this->assignRef('darst', $result);
				$this->assignRef('rolls', $rolls);
				parent::display($tpl);
         	}
		}
	}
}
?>
