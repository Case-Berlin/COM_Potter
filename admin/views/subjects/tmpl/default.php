<?php defined('_JEXEC') or die; ?>
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" id="adminForm">
<div id="editcell">
	<table>
		<tr>
			<td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<? echo $this->lists['state']; ?>
			</td>
		</tr>
	</table>

	<table class="adminlist">
	<thead>
		<tr>
			<th width="20" align="center">
				<?php echo JText::_( 'Nr' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rolls ); ?>);" />
			</th>			
			<th width="10">
			    <?php echo JHTML::_('grid.sort',   'Aktiv', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th>
			    <?php echo JHTML::_('grid.sort',   'subject', 'Fach', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="20">
			    <?php echo JHTML::_('grid.sort',   'id', 'id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
   <tfoot>
      <tr>
         <td colspan="5"><?php echo $this->pagination->getListFooter(); ?></td>
      </tr>
   </tfoot>

   <tbody>

	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	
	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
    	$published		= JHTML::_('grid.published', $row, $i );

		$link 		= JRoute::_( 'index.php?option=com_potter&controller=subjects&task=edit&cid[]='. $row->id );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="right">
				<?php echo $this->pagination->getRowOffset($i); ?>
			</td>
			<td align="center">
				<?php echo $checked; ?>
			</td>
			<td align="center">
			   <?php echo $published;?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->Fach; ?></a>
			</td>
			<td align="right">
				<?php echo $row->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
</div>

<input type="hidden" name="option" value="com_potter" />
<input type="hidden" name="context" value="com_potter" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="subjects" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>

