<?php
/**
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

// Eine Instanz des Controllers mit dem Präfix 'Potter' beziehen
$controller = JControllerLegacy::getInstance('Potter');

// Den 'task' der im Request übergeben wurde ausführen
$task = JFactory::getApplication()->input->getCmd('task');
$controller->execute($task);

// Einen Redirect durchführen wenn er im Controller gesetzt ist
$controller->redirect();

?>
