<?php 
defined('_JEXEC') or die; 
// Das Tooltip Behavior wird geladen
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

?>
<form action="<?php echo JRoute::_('index.php?option=com_potter&view=years'); ?>" method="post" name="adminForm" id="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead><?php echo $this->loadTemplate('head');?></thead>
	<tbody><?php echo $this->loadTemplate('body');?></tbody>
	<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
	</table>
</div>

<div>
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<?php echo JHtml::_('form.token'); ?>
</div>
</form>

