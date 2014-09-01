<?php defined('_JEXEC') or die; ?>
<div id="editcell" style=" font-weight:bold">
<?
	$row = &$this->darst[0];
	$Anzahl = 0;
	$tz = date("Z",time());
	// Header
	echo "\n<div style=\"background-color:#DFDFDF;width:100%; float:none; font-weight:bold\">";
	echo "<div style=\"width:150px; float:left\">";
		echo "Benutzername";
	echo "</div>";
	echo "<div style=\"width:100px; float:left\">";
		echo "Funktion";
	echo "</div>";
	echo "<div style=\"width:40px; float:left\" align=\"center\">";
		echo "SNE";
	echo "</div>";
	echo "<div style=\"width:140px; float:left\">";
		echo "letzter Besuch";         
	echo "</div>";
	echo "<div style=\"width:150px; float:left\">";
		echo "Darsteller Name";
	echo "</div>";
	echo "<div style=\"clear: both;\"></div>";
	echo "</div></div>\n";
	for ($i=0, $n=count( $this->joouser ); $i < $n; $i++)
	{
		$Anzahl++;
		if (($Anzahl % 2) == 0)
		{
			$bgc = "#DFDFDF";
		} else
		{
			$bgc = "#D6D6D6";
		}
		$joo = &$this->joouser[$i];
		echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none\">";
			// Hier der Text des Profils
			echo "<div style=\"width:150px; float:left\">";
				echo "<b>".trim($joo->name)."</b>\n";
			echo "</div>";
			echo "<div style=\"width:100px; float:left\">";
				if ($joo->usertype==NULL)
				{
					echo "&nbsp;";
				} else
				{
					echo JText::_(trim($joo->usertype));
				}
			echo "</div>";
			echo "<div style=\"width:40px; float:left\" align=\"center\">";
				if ($joo->sendEmail==0)
				{
					echo "-";
				} else
				{
					echo "x";
				}
			echo "</div>";
			echo "<div style=\"width:140px; float:left\">";
				if ($joo->lastvisitDate!='0000-00-00 00:00:00')
				{
					echo date("d.m.Y H:i",StrToTime(stripslashes($joo->lastvisitDate))+$tz);
				} else
				{
					echo "&nbsp;";
				}
			echo "</div>";
			echo "<div style=\"width:150px; float:left\">";
				$darst ="&nbsp;";
				for ($j=0, $m=count( $this->rolls ); $j < $m; $j++)
				{
					$roll = &$this->rolls[$j];
					if ($joo->id==$roll->joomlaid)
					{
						$darst = trim($roll->realvname." ".$roll->realname);
					}
				}
				echo $darst;
			echo "</div>";
			echo "<div style=\"clear: both;\"></div>";
		echo "</div>\n";
	}
	echo "<p><p>&Auml;nderungen derzeit nur durch den Webmaster m&ouml;glich!";
	?>
</div>
