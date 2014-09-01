<?php defined('_JEXEC') or die; ?>
<div id="editcell">
<?
	$row = &$this->darst[0];
	$Anzahl = 0;
	for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
	{
		$Anzahl++;
		if (($Anzahl % 2) == 0)
		{
			$bgc = "#DFDFDF";
		} else
		{
			$bgc = "#D6D6D6";
		}
		$roll = &$this->rolls[$i];
		echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none\">";
			// Hier der Text des Profils
			echo "<div style=\"width:150px; float:left\">";
				echo "<b>".trim($roll->realvname." ".$roll->realname)."</b>\n";
			echo "</div>";
			echo "<div align=\"center\" style=\"width:100px; float:left\">";
				if ($roll->Bild=="")
				{
					$bld = "schattenbild1.jpg";
				} else
				{
					$bld = $roll->Bild;
				}
				$bld = "images/potter/personen/".$bld;
				?>
				<img src="<? echo $bld; ?>" title="<? echo $roll->realvname." ".$roll->realname; ?>" alt="<? echo $roll->realvname." ".$roll->realname; ?>">
				<br>
			</div>
			<? 
			echo "<div style=\"width:150px; float:left\">";
				if ($roll->Telefon==NULL) { $txt = "&nbsp;";} else { $txt = $roll->Telefon;}
				echo $txt;
			echo "</div>";
			echo "<div style=\"width:150px; float:left\">";
				echo $roll->email;
			echo "</div>";
			echo "<div style=\"clear: both;\"></div>";
		echo "</div>\n";
	}
	echo "<p><p>&Auml;nderungen derzeit nur durch den Webmaster m&ouml;glich!";
	?>
</div>
