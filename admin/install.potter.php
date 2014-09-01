<?php
/*
 * @package Joomla 3.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Potter
 * @copyright Copyright (C) Steffen Janke
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined( '_JEXEC' ) or die;

jimport( 'joomla.filesystem.folder' );

function com_install()
{

	
	$message = '';
	
	$message .= '<p>W&auml;hlen Sie, was sie machen wollen! Installation oder Upgrade der Potter Komponente.</p>';
	
/*	if (in_array(0, $error))
	{
		return false;
	}
	else
	{
		return true;
	}*/
	echo $message;
	echo '<center>';
	echo '<div style="padding:20px;border:1px solid#ff8000;background:#fff">';
	echo '<table border="0" cellpadding="20" cellspacing="20"><tr>';
	echo '<td align="center" valign="middle"><a href="index.php?option=com_potter&amp;controller=potterinstall&amp;task=install">Installieren</a></td>';
	echo '<td align="center" valign="middle"><a href="index.php?option=com_potter&amp;controller=potterinstall&amp;task=upgrade">Upgrade</a></td>';
	echo '</tr></table>';
	echo '</div></center>';
	
	echo '<p>&nbsp;</p><p>&nbsp;</p>';
	echo '<div style="padding:20px;border:1px solid#0080c0;background:#fff">';
	echo '<center><a style="text-decoration:underline" href="http://www.derphoenixorden.de/" target="_blank">www.derphoenixorden.de</a></center>';
	echo '</div>';

}

?>