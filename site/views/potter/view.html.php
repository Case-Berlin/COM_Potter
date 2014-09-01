<?php
/**
 * Hello View for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */
// kein direkte Zugriff
defined( '_JEXEC' ) or die;

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 *
 * @package		Joomla.Tutorials
 * @subpackage	Components
 */
class potterViewPotter extends JViewLegacy
{
	function display($tpl = null)
	{
		$user =& JFactory::getUser();
  	    if ($user->guest) 
		{
		   echo "<p><h3>Du bist nicht eingeloggt!</h3>";
	 	} else
		{
			//echo "<p>Dein Name ist {$user->name}, deine Mailadresse ist {$user->email}, und dein Anmeldenamen ist {$user->username}</p>";
		 	//echo "<p>Du hast die Funktion: {$user->usertype} mit der Gruppen-ID {$user->gid} und die User-ID ist {$user->id}.</p>";
			$db			=& JFactory::getDBO();
			$db_pre 	= $db->getPrefix();
			$query =' SELECT * FROM `'.$db_pre.'po_darst` WHERE joomlaid='.$user->id;
			$db->setQuery( $query );
			$result = $db->loadObjectList();
         	if (count($result)==0)
         	{
            	echo "<p><h3>Du bist noch kein registrierter Darsteller des Events! Melde Dich beim Webmaster</h3>";
         	}else
         	{
	            //echo $result[0]->realname.'<br>';
    	        //print_r ($result);
				// prepare list array
				$lists = array();
				
				$query  = "SELECT Jahr, ma_titel, ma_vname, ma_name, dn.id dnid ";
				$query .= "FROM `".$db_pre."po_da_na` dn, `".$db_pre."po_jahr` j, `".$db_pre."po_namen` n ";
				$query .= "WHERE dn.id_darst=".$result[0]->id." AND dn.id_jahr=j.id AND dn.id_name=n.id ";
				$query .= "ORDER BY j.Jahr, n.ma_name, n.ma_vname";
				$db->setQuery( $query );
				$rolls = $db->loadObjectList();


				$this->assignRef('darst', $result);
				$this->assignRef('rolls', $rolls);
				parent::display($tpl);
         	}
		}
	}
}
?>
