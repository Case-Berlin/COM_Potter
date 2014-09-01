<?php
 
// Den direkten Aufruf verbieten.
defined('_JEXEC') or die;
?>
 
<tr>
	<th width="5">
		<?php echo JText::_( 'ID' ); ?>
	</th>
	<th width="20" align="center">
	    <?php echo JHtml::_('grid.checkall'); ?>
	</th>			
	<th width="20">
		<?php echo JText::_( 'Standard' ); ?>
	</th>
	<th>
		<?php echo JText::_( 'Events' ); ?>
	</th>
	<th>
		<?php echo JText::_( 'path' ); ?>
	</th>
</tr>
