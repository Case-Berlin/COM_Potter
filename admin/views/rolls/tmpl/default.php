<?php 
defined('_JEXEC') or die; 
// Das Tooltip Behavior wird geladen
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
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
				<? echo $this->lists['state']; ?>
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
			    <?php echo JHTML::_('grid.sort',   'Aktiv', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th>
			    <?php echo JHTML::_('grid.sort',   'ma_Name', 'ma__name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="150">
			    <?php echo JHTML::_('grid.sort',   'Haus', 'haus', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="200">
			    <?php echo JHTML::_('grid.sort',   'Magie', 'Magie', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="100">
			    <?php echo JHTML::_('grid.sort',   'Geschlecht', 'sex', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="15" align="right">
			    <?php echo JHTML::_('grid.sort',   'id', 'id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="8"><?php echo $this->pagination->getListFooter(); ?></td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)	
	{
		$roll = &$this->rolls[$i];
		$checked 	= JHTML::_('grid.id',   $i, $roll->id );
    	$published		= JHTML::_('grid.published', $roll, $i );

		$link 		= JRoute::_( 'index.php?option=com_potter&controller=rolls&task=edit&cid[]='. $roll->id );
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
			<td>
				<a href="<?php echo $link; ?>"><?php echo trim($roll->ma_titel." ".$roll->ma_vname."  ".$roll->ma_name); ?></a>
			</td>
			<td>
				<?php 
				switch ($roll->haus) 
				{
					case 0:
					    echo JText::_( 'UNKNOWN' );
					    break;
					case 1:
					    echo JText::_( 'Gryffindor' );
					    break;
					case 2:
					    echo JText::_( 'Ravenclaw' );
					    break;
					case 3:
					    echo JText::_( 'Hufflepuff' );
					    break;
					case 4:
					    echo JText::_( 'Slytherin' );
					    break;
					case 5:
					    echo JText::_( 'Bossander' );
					    break;
				}
				?>
			</td>
			<td>
				<?php 
				switch ($roll->Magie) 
				{
					case 0:
					    echo JText::_( 'neutral' );
					    break;
					case 1:
					    echo JText::_( 'WHITE_B' );
					    break;
					case 2:
					    echo JText::_( 'BLACK_B' );
					    break;
					case 3:
					    echo JText::_( 'WHITE_U' );
					    break;
					case 4:
					    echo JText::_( 'BLACK_U' );
					    break;
				}
				?>
			</td>
			<td>
				<?php
				switch ($roll->sex) 
				{
					case 0:
					    echo JText::_( 'WOMAN' );
					    break;
					case 1:
					    echo JText::_( 'MAN' );
					    break;
					case 2:
					    echo JText::_( 'GMORF' );
					    break;
				}
				?>
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

