<?php defined('_JEXEC') or die; ?>
<?php
	$isNew		= ($this->darst->id < 1);
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
		<tr>
		    <td colspan="2">
			 <h2><?php echo JText::_( 'LESSON' ).' : '.$this->lessonname; ?></h2>
			</td>
			<td  rowspan="7" valign="top" width="350" bgcolor="#ABFE44">
				<?php 
					if ($isNew==1)
					{
						echo JText::_('FIRSTSAVE');
					} else
					{
						echo JText::_('PICKTEACHER').': '.$this->lists['roll'];
						echo "<p><p>";
						$n=count( $this->teachersname );
						if ($n>0)
						{
							for ($i=0, $n; $i < $n; $i++)	
							{
								$teacher = &$this->teachersname[$i];
								echo '- '.$teacher->text.' ';
								if ($teacher->bild<>'')
								{
									$bild = "/".$this->imgpath.$teacher->bild;
									echo '<img src="'.$bild.'" alt="" width="80" hight="102" align="top" border="0" />';

								}
								$link = JRoute::_( 'index.php?option=com_potter&controller=lessons&task=DelTeacher&tid='. $teacher->value.'&fid='.$this->darst->id );
								echo '<a href="'.$link.'">'.JText::_('DELETE').'</a><br>';
							}
						} else
						{ // keine Lehrer da
							echo JText::_('NOTEACHER');
						}
						//print_r($this->teachersname);
					}
				?>
			</td>
		</tr>
		<tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'LESSONACTIVATED' ); ?>:			</td>
			<td>
					<?php echo $this->lists['published']; ?>			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'LESSONSICHER' ); ?>:			</td>
			<td>
					<?php echo $this->lists['sicher']; ?>			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'YEAR' ); ?>:			</td>
			<td>
					<?php echo $this->lists['years']; ?> </td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'LESSON' ); ?>:			</td>
			<td>
					<?php echo $this->lists['fach']; ?></td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'ROOM' ); ?>:			</td>
			<td>
				<input class="text_area" type="text" name="Raum" id="Raum" size="30" maxlength="30" value="<?php echo $this->darst->Raum;?>" />			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'ANZSCHUELER' ); ?>:			</td>
			<td>
				<input class="text_area" type="text" name="Anzahl" id="Anzahl" size="2" maxlength="2" value="<?php echo $this->darst->Anzahl;?>" />			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'ABALTER' ); ?>:			</td>
			<td>
				<input class="text_area" type="text" name="abAlter" id="abAlter" size="2" maxlength="2" value="<?php echo $this->darst->abAlter;?>" />			</td>
		</tr>

		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'LEBESCHREIBUNG' ); ?>:			</td>
			<td colspan="2">
				<?php
				// parameters : areaname, content, width, height, cols, rows, show xtd buttons
				echo $this->editor->display( 'Beschreibung',  $this->darst->Beschreibung, '550', '300', '60', '20', array('pagebreak', 'readmore') ) ;
				?>			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'LECOMMENT' ); ?>:			</td>
			<td colspan="2">
				<?php
				// parameters : areaname, content, width, height, cols, rows, show xtd buttons
				echo $this->editor->display( 'comment',  $this->darst->comment, '550', '300', '60', '20', array('pagebreak', 'readmore') ) ;
				?>			</td>
		</tr>
	</table>
	</fieldset>

</div>

<div class="clr"></div>

<input type="hidden" name="option" value="com_potter" />
<input type="hidden" name="context" value="com_potter" />
<input type="hidden" name="id" value="<?php echo $this->darst->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="lessons" />
</form>

