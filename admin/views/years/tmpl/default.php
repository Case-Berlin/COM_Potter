<?php 
defined('_JEXEC') or die; 
// Das Tooltip Behavior wird geladen
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

?>
<!--<form action="<?php echo JRoute::_('index.php?option=com_potter&view=years'); ?>" method="post" name="adminForm" id="adminForm">-->
<form method="post" name="adminForm" id="adminForm">
<div id="editcell">
	<input type="hidden" name="task" value="unblock" />
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="boxchecked" value="0" />
	<table class="adminlist">
		<thead><?php echo $this->loadTemplate('head');?></thead>
		<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
		<tbody><?php echo $this->loadTemplate('body');?></tbody>
	</table>
</div>
</form>

