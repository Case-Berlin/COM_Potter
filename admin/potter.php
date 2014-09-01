<?php
/**
 * @package    COM_POTTER, Einstiegsskript für Backend 3.00.00
 * @subpackage	Backend
 * @author		Steffen Janke 
 * @license		GNU/GPL
 */

defined( '_JEXEC' ) or die;
JLoader::import('joomla.application.component.controller');
JHtml::_('behavior.tabstate');

/* Einstieg in die Komponente - Potter instanzieren */
$controller	= JControllerLegacy::getInstance('Potter');

/* Das Anwendungsobjekt holen  */
$app = JFactory::getApplication();

/* Aufgabe (task) ausführen. Hier ist das die Ausgabe der Standardview */
$controller->execute($app->input->get('task'));

// Redirect if set by the controller
$controller->redirect();