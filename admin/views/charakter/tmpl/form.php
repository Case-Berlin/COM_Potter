<?php defined('_JEXEC') or die; ?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
		<tr>
		    <td colspan="2">
			 <h2><?php echo JText::_( 'ROLL' ).' : '.$this->rollname; ?></h2>
			</td>
		</tr>
		<tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'CHARAKTERACTIVATED' ); ?>:			</td>
			<td>
					<?php echo $this->lists['published']; ?>			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'CHARAKTERSICHER' ); ?>:			</td>
			<td>
					<?php echo $this->lists['sicher']; ?>			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'YEAR' ); ?>:			</td>
			<td>
					<?php echo $this->lists['years']; ?> <b>nach &Auml;nderung erst speichern und neu &ouml;ffnen!</b></td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Darsteller' ); ?>:			</td>
			<td>
					<?php echo $this->lists['person']; ?></td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'ROLL' ); ?>:			</td>
			<td>
					<?php echo $this->lists['roll']; ?> <b>nach &Auml;nderung erst speichern und neu &ouml;ffnen!</b></td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Funktion' ); ?>:			</td>
			<td>
					<?php echo $this->lists['Funktion']; ?></td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Sonder' ); ?>:			</td>
			<td>
					<?php echo $this->lists['Sonder']; ?></td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'kcomment' ); ?>:			</td>
			<td>
				<input class="text_area" type="text" name="kcomment" id="kcomment" size="200" maxlength="255" value="<?php echo $this->darst->kcomment;?>" />			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Bild' ); ?>:			</td>
			<td>
				<?php echo $this->lists['image'];?>			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<script language="javascript" type="text/javascript">
				if (document.forms.adminForm.bild.options.value!='')
				{
					jsimg='<?php echo $this->imgpath; ?>' + getSelectedValue( 'adminForm', 'bild' );
				} else {
					jsimg='images/potter/personen/schattenbild.jpg';
				}
				document.write('<img src=/' + jsimg + ' name="imagelib" border="2" alt="<?php echo JText::_( 'Preview', true ); ?>" />');
				</script>			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'CHCOMMENT' ); ?>:			</td>
			<td>
				<?php
				// parameters : areaname, content, width, height, cols, rows, show xtd buttons
				echo $this->editor->display( 'comment',  $this->darst->comment, '550', '300', '60', '20', array('pagebreak', 'readmore') ) ;
				?>			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'ZURPERSON' ); ?>:			</td>
			<td>
				<?php
				// parameters : areaname, content, width, height, cols, rows, show xtd buttons
				echo $this->editor->display( 'zurperson',  $this->darst->zurperson, '550', '300', '60', '20', array('pagebreak', 'readmore') ) ;
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
<input type="hidden" name="controller" value="charakters" />
</form>

