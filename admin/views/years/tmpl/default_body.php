<?php
 
// Den direkten Aufruf verbieten
defined('_JEXEC') or die;
?>
 
<?php 
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	
	{
		$row = &$this->items[$i];
		$checked 	= JHtml::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_potter&task=year.edit&id='.(int) $row->id );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo (int) $row->id; ?>
			</td>
			<td  align="center">
				<?php echo $checked; ?>
			</td>
			<td align="center">
               <?php
			   if ($row->aktuell == 1) 
			   {
			      echo "<img src=\"templates/bluestork/images/menu/icon-16-default.png\" alt=\"". JText::_( 'aktyear' )."\"/>";
			   } else 
			   {
			      echo "&nbsp;";
   			   }
			   ?> 			
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo (int) $row->Jahr." - ".$this->escape($row->Titel); ?></a>
			</td>
			<td>
				<?php echo $this->escape($row->path); ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
?>
