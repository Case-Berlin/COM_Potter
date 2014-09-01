<?php
// Den direkten Aufruf verbieten
defined('_JEXEC') or die;
 
// Das Tooltip Behavior wird geladen
JHtml::_('behavior.tooltip');
// Das Formvalidation Behavior wird geladen
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
 
// Der Link für das Formular
//$actionLink = JRoute::_('index.php?option=com_potter&view=year&layout=edit&id=' . (int) $this->item->id);
$actionLink = JRoute::_('index.php?option=com_potter&layout=year.edit&id=' . (int) $this->item->id);
 
?>
<form action="<?php echo $actionLink; ?>" method="post" name="adminForm" id="item-form">
    <fieldset class="adminform">
        <legend><?php echo JText::_('Details'); ?></legend>
 
        <?php foreach ($this->form->getFieldset() as $field): ?>
            <?php echo $field->label;
            echo $field->input; ?>
        <?php endforeach; ?>
    </fieldset>
    <div>
        <input type="hidden" name="task" value="year.edit"/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>