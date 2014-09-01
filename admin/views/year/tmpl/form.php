<?php defined('_JEXEC') or die; ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'year' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="Jahr" id="Jahr" size="4" maxlength="4" value="<?php echo $this->year->Jahr;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'title' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="Titel" id="Titel" size="100" maxlength="200" value="<?php echo $this->year->Titel;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'path' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="path" id="path" size="100" maxlength="200" value="<?php echo $this->year->path;?>" />
			</td>
		</tr>
	</table>
	</fieldset>

</div>

<div class="clr"></div>

<input type="hidden" name="option" value="com_potter" />
<input type="hidden" name="context" value="com_potter" />
<input type="hidden" name="id" value="<?php echo $this->year->id; ?>" />
<input type="hidden" name="aktuell" value="<?php echo $this->year->aktuell; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="years" />
</form>

