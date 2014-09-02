<?php 
defined('_JEXEC') or die; 
// Das Tooltip Behavior wird geladen
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

?>
<?php
	//echo print_r($this->Sonder);echo "*";
?>	
<form method="post" name="adminForm" id="adminForm">
<div id="editcell">
	<table>
		<tr>
			<td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php 
				echo $this->lists['jahre']; 
				echo $this->lists['haus']; 
				echo $this->lists['Funktion']; 
				echo $this->lists['Sonder']; 
				echo $this->lists['state']; 
				?>
			</td>
		</tr>
	</table>
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5" align="center">
				<?php echo JText::_( 'Nr' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rolls ); ?>);" />
			</th>			
			<th width="10">
			    <?php echo JHTML::_('grid.sort',   'Aktiv', 'dn.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="10">
			    <?php echo JHTML::_('grid.sort',   'Sicher', 'dn.sicher', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th>
			    <?php echo JHTML::_('grid.sort',   'Roll', 'n.ma_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="50">
			    <?php echo JHTML::_('grid.sort',   'Jahr', 'j.Jahr', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="80">
			    <?php echo JHTML::_('grid.sort',   'Haus', 'n.haus', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>

			<th width="120">
			    <?php echo JHTML::_('grid.sort',   'Funktion', 'dn.Funktion', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="150">
			    <?php echo JHTML::_('grid.sort',   'Sonder', 'dn.Sonder', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="15" align="right">
			    <?php echo JHTML::_('grid.sort',   'id', 'dn.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="10"><?php echo $this->pagination->getListFooter(); ?></td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)	
	{
		$roll = &$this->rolls[$i];
		$checked 	= JHTML::_('grid.id',   $i, $roll->id );
    	$published	= JHTML::_('grid.published', $roll, $i );
//    	$sicher		= JHTML::_('grid.sicher', $roll, $i );

		$link 		= JRoute::_( 'index.php?option=com_potter&controller=charakters&task=edit&cid[]='. $roll->id );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset($i); ?>
			</td>
			<td align="center">
				<?php echo $checked; ?>
			</td>
			<td align="center">
			   <?php echo $published;?>
			</td>
			<td align="center">
			   <?php 
				if ($roll->sicher)
				{
					echo 'ja';
				} else
				{
					echo 'nein';
				}?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo trim($roll->ma_vname." ".$roll->ma_name); ?></a>
			</td>
			<td  align="center">
				<?php echo $roll->Jahr; ?>
			</td>
			<td  align="center">
				<?php 
				if ($roll->haus==0)
				{
				  echo '&nbsp;';
				} else
				{
				  print_r($this->haus[$roll->haus]->text); 
				}?>  
			</td>
			<td align="center">
				<?php print_r($this->Funktion[$roll->Funktion+1]->text); ?>
			</td>
			<td align="center">
				<?php print_r($this->Sonder[$roll->Sonder+1]->text); ?>
			</td>
			<td>
				<?php echo $roll->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
</div>
<input type="hidden" name="task" value="unblock" />
<?php echo JHtml::_('form.token'); ?>
<input type="hidden" name="boxchecked" value="0" />

<input type="hidden" name="option" value="com_potter" />
<input type="hidden" name="context" value="com_potter" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>

