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
		echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none; border:none; border-width:thin\">";
			echo "<div style=\"width:100%; float:none\">";
			// Hier der Text des Profils
			echo "<h3>".$roll->realvname." ".$roll->realname."</h3><br>\n";
			if ($roll->Bild=="")
			{
				$bld = "schattenbild1.jpg";
			} else
			{
				$bld = $roll->Bild;
			}
			$bld = "images/potter/personen/".$bld;
			if ($roll->Comment=="")
			{
				$beschreibung = "Noch kein Profiltext vorhanden!";
			} else
			{
				$beschreibung = $roll->Comment;
			}?>
			<div align="center" style="width:100px;float:left">
			<img src="<? echo $bld; ?>" title="<? echo $roll->realvname." ".$roll->realname; ?>" alt="<? echo $roll->realvname." ".$roll->realname; ?>">
			</div>
			<div>
			<? 
			echo $beschreibung;
			echo "</div></div>\n";

			echo "<div style=\"width:100%; ;clear:left; float:none\">";
			// und hier die Daten
			echo "<br><b>Geburtstag:</b> ";
			if ($roll->birthday!=NULL)
			{
				echo date("d.m.Y",StrToTime(stripslashes($roll->birthday)));
			}
			?>
		    <p><b>Internet:</b> <? echo "<a href=\"".$roll->www."\" target=\"_blank\">".$roll->www."</a>"; ?>
		    <p><b>E-Mail: </b><? echo $roll->email;?>
		    <p><b>Telefon: </b><? echo $roll->Telefon; ?>
			<p><b>Anschrift: </b><? echo $roll->PLZ." ".$roll->Ort.", ".$roll->Strasse;    
			echo "</div><br>";
		
		echo "</div>\n";
	}
	echo "<p><p>&Auml;nderungen derzeit nur durch den Webmaster m&ouml;glich!";
	?>
</div>
