<?php
/**
 * Protas View für Potter Komponente
 * 
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 *
 */
class potterViewProtas extends JViewLegacy
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
					$filter = " dn.published = 1 AND";
				} else
				{
					$filter = " dn.sicher = 1 AND";
				}
				$query  = "SELECT * FROM #__po_jahr WHERE id=".$params->get('idjahr');
				$db->setQuery( $query );
				$year = $db->loadObjectList();
 				
				$query  = "SELECT dn.id AS iddn, dn.*, n.*, d.*";
//				$query  = "SELECT dn.id AS iddn, dn.*, n.*, j.*, d.*";
				$query .= " FROM #__po_da_na dn, #__po_namen n, #__po_darst d";
				$query .= " WHERE dn.id_name=n.id AND dn.id_darst=d.id AND";
//				$query .= " FROM #__po_da_na dn, #__po_namen n, #__po_jahr j, #__po_darst d";
//				$query .= " WHERE dn.id_name=n.id AND dn.id_jahr=j.id AND dn.id_darst=d.id AND";
				$query .= $filter;
				$query .= "	dn.id_jahr=".$params->get('idjahr');
				$query .= " ORDER BY n.ma_name, n.ma_vname";
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
