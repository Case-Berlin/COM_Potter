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
					<?php echo JText::_( 'JoomlaUser' ); ?>:
			</td>
			<td>
					<?php echo $this->lists['user']; ?>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'pers_prof' ); ?>:
			</td>
			<td>
					<?php echo $this->lists['anzeigen']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'vname' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="realvname" id="realvname" size="50" maxlength="50" value="<?php echo $this->darst->realvname;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'nname' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="realname" id="realname" size="50" maxlength="50" value="<?php echo $this->darst->realname;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'e-mail' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="email" id="email" size="100" maxlength="100" value="<?php echo $this->darst->email;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'showmail' ); ?>:
			</td>
			<td>
				<?php echo $this->lists['showmail']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'www' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="www" id="www" size="100" maxlength="100" value="<?php echo $this->darst->www;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'FEZ-MITARBEITER' ); ?>:
			</td>
			<td>
				<?php echo $this->lists['fezma']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'birthday' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="birthday" id="birthday" size="10" maxlength="10" value="<?php echo $this->darst->birthday;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Telefon' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="Telefon" id="Telefon" size="100" maxlength="100" value="<?php echo $this->darst->Telefon;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'PLZ' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="PLZ" id="PLZ" size="5" maxlength="5" value="<?php echo $this->darst->PLZ;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Ort' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="Ort" id="Ort" size="50" maxlength="50" value="<?php echo $this->darst->Ort;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Strasse' ); ?>:
			</td>
			<td>
				<input class="text_area" type="text" name="Strasse" id="Ort" size="100" maxlength="100" value="<?php echo $this->darst->Strasse;?>" />
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
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Bild' ); ?>:
			</td>
			<td>
				<?php echo $this->lists['image'];?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<script language="javascript" type="text/javascript">
				if (document.forms.adminForm.Bild.options.value!='')
				{
					jsimg='images/potter/personen/' + getSelectedValue( 'adminForm', 'Bild' );
				} else {
					jsimg='images/potter/personen/schattenbild.jpg';
				}
				document.write('<img src=/' + jsimg + ' name="imagelib" border="2" alt="<?php echo JText::_( 'Preview', true ); ?>" />');
				</script>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Profil' ); ?>:
			</td>
			<td>
				<?php
				// parameters : areaname, content, width, height, cols, rows, show xtd buttons
				echo $this->editor->display( 'Comment',  $this->darst->Comment, '550', '300', '60', '20', array('pagebreak', 'readmore') ) ;
				?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
					<?php echo JText::_( 'Comment' ); ?>:
			</td>
			<td>
             	<textarea name="intComment" id="intComment"cols="100" rows="10"><?php echo $this->darst->intComment;?></textarea>
			</td>
		</tr>
	</table>
	</fieldset>

</div>

<div class="clr"></div>

<input type="hidden" name="option" value="com_potter" />
<input type="hidden" name="context" value="com_potter" />
<input type="hidden" name="id" value="<?php echo $this->darst->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="artists" />
</form>

