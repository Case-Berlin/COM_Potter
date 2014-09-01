<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Potter Install
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

class PotterControllerPotterinstall extends PotterController
{
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'install'  , 'install' );
		$this->registerTask( 'upgrade'  , 'upgrade' );		
	}

	
	
	function install()
	{		
		$db			=& JFactory::getDBO();
		$db_prefix 	= $db->getPrefix();
		$link = 'index.php?option=com_potter';
		$this->setRedirect($link, $msg);
	}
	
	function upgrade()
	{
		$db			=& JFactory::getDBO();
		$db_prefix 	= $db->getPrefix();
		
		$msg_sql = '';
		
		
		$query =' SELECT * FROM `'.$db_prefix.'po_jahr` LIMIT 1;';
		$db->setQuery( $query );
		$result = $db->loadResult();
		if ($db->getErrorNum())
		{
			$msg_sql .= $db->getErrorMsg(). '<br />';
		}
		
		if ($msg_sql !='')
		{
			$msg = JText::_( 'Potter not successfully upgraded' ) . ': <br />' . $msg_sql;
		}
		else
		{
			$msg = JText::_( 'Potter successfully upgraded' );
		}
	
		$link = 'index.php?option=com_potter';
		$this->setRedirect($link, $msg);
	}
}