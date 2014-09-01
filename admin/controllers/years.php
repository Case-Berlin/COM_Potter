<?php
/**
 * Years Controller für die Komponente Potter
 * Diese steuert years in #__po_jahr
 * @package    COM_POTTER, Site-Controller 3.00.00
 * @subpackage Components
 */
 
defined('_JEXEC') or die;
 
// Die Joomla! JControllerAdmin Klasse importieren
jimport('joomla.application.component.controlleradmin');
 
class PotterControllerYears extends JControllerAdmin
{
    public function getModel($name = 'years', $prefix = 'PotterModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}