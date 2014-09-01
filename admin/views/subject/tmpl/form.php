<?php defined('_JEXEC') or die; ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'SUBJECTACTIVATED' ); ?>:
			</td>
			<td>
					<?php echo $this->lists['published']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'SUBJECT' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="Fach" id="Fach" size="59" maxlength="59" value="<?php echo $this->subject->Fach;?>" />
			</td>
		</tr>
	</table>
	</fieldset>

</div>

<div class="clr"></div>

<input type="hidden" name="option" value="com_potter" />
<input type="hidden" name="context" value="com_potter" />
<input type="hidden" name="id" value="<?php echo $this->subject->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="subjects" />
</form>

