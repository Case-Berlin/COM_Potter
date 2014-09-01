<?php defined('_JEXEC') or die; ?>
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
		<tr>
<?		
//void sort ( $title, $order, $direction, $selected, $task )
//$title 	  string 	is a string containing the link title. This is often the title of the column.
//$order 	  string 	is a string containing the order field for the column. This is often a field name that can be used directly in the query.
//$direction  string 	is a string containing the direction in which the data is currently sorted. This can be either ‘asc’ or ‘desc’.
//$selected   string 	is a string containing the currently selected ordering. These values should match those in the $order parameter.
//$task 	  string 	is a string containing an optional task override. This task is passed to the tableordering function. This parameter is optional and if //omitted defaults to null. 
// http://dev.joomla.org/component/option,com_jd-wiki/Itemid,/id,references:joomla.framework:html:jhtmlgrid-sort/
?>


			<th  width="30" class="title">
				<?php echo JHtml::_('grid.sort',   'Jahr', 'Jahr', @$lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th align="Left">
				<?php echo JHtml::_('grid.sort',   'Titel', 'Titel', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHtml::_('grid.sort',   'ID', 'id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
		</tr>
			
	</thead>
	<?php
	$k = 0;

	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
//		if ($this->params->get('idjahr')==$row->id)
		if ($row->aktuell==1)
		{
		  $fe1='<strong>';
		  $fe2='</strong>';
		} else
		{
		  $fe1='';
		  $fe2='';
		}
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $fe1.$row->Jahr.$fe2; ?></a>
			</td>
						</td>
			<td align="left">
				<?php echo $fe1.$row->Titel.$fe2;?>
			</td>
			<td align="center">
				<?php echo $row->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
	<?php 
	//print_r($this->params);
	//echo "<br>>".$this->params->get('idjahr')."<<br>"; 
	//echo $this->params->get('filter'); 
	//echo $this->params->get('text1'); 
	?>
</div>
