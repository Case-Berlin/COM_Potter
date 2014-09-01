<?php defined('_JEXEC') or die; ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'ARTISTACTIVATED' ); ?>:
			</td>
			<td>
					<?php echo $this->lists['published']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'vname' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="ma_vname" id="ma_vname" size="50" maxlength="50" value="<?php echo $this->roll->ma_vname;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'nname' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="ma_name" id="ma_name" size="50" maxlength="50" value="<?php echo $this->roll->ma_name;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'ma_titel' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="ma_titel" id="ma_titel" size="30" maxlength="30" value="<?php echo $this->roll->ma_titel;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Magie' ); ?>:
			</td>
			<td>
				<?php echo $this->lists['magie']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Haus' ); ?>:
			</td>
			<td>
				<?php echo $this->lists['haus']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'SEX' ); ?>:
			</td>
			<td>
				<?php echo $this->lists['sex']; ?>
			</td>
		</tr>
	</table>
	</fieldset>

</div>

<div class="clr"></div>

<input type="hidden" name="option" value="com_potter" />
<input type="hidden" name="context" value="com_potter" />
<input type="hidden" name="id" value="<?php echo $this->roll->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="rolls" />
</form>

