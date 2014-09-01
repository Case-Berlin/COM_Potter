<?php
/**
 * Years Controller für die Komponente Potter
 * Diese steuert years in #__po_jahr
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */
 
// Den direkten Aufruf verbieten
defined('_JEXEC') or die;
 
// Die Joomla! JControllerAdmin Klasse importieren
jimport('joomla.application.component.controlleradmin');
 
/**
 * HalloWeltList Controller
 */
class PotterControllerYears extends JControllerAdmin
{
    public function getModel($name = 'year', $prefix = 'YearsModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}