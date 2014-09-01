<?php defined('_JEXEC') or die; ?>
<div id="editcell">
<?
	$row = &$this->darst[0];
	$year = &$this->year[0];
	//print_r($year);
	//echo $year->path;
	if (count( $this->lessons )>0)
	{
		$bgc = "#D6D6D6";
		echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none; border:none; border-width:thin\">";
		echo "<br><h3>Übersicht über alle Unterrichtsfaecher im Zauberschloss ".$year->Jahr."</h3><br>";
		echo "</div>";
		$bgc = "#DFDFDF";
		echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none; border:none; border-width:thin\">";
		echo ".";
		echo "</div>";
		$Anzahl = 0;
		for ($i=0, $n=count( $this->lessons ); $i < $n; $i++)
		{
			$Anzahl++;
			if (($Anzahl % 2) == 0)
			{
				$bgc = "#DFDFDF";
			} else
			{
				$bgc = "#D6D6D6";
			}
			$lesson = &$this->lessons[$i];
			echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none; border:none; border-width:thin\">";
				echo "<div style=\"width:100%; float:none\">";
				// Hier der Text des Profils
				echo "<br>";
				echo "<div style=\"width:450px; float:left\">";
				echo "<h3>".trim($lesson->Fach)."</h3><br>\n";
				echo "</div>";
				if ($lesson->Raum!="")
				{
					echo "<div style=\"width:210px; float:left\"><b>";
					echo "Raum: ".$lesson->Raum;
					echo "</b></div>";
				}
				if ($lesson->Anzahl!="")
				{
					echo "<div style=\"width:210px; float:left\"><b>";
					echo "Anzahl der Teilnehmer: ".$lesson->Anzahl;
					echo "</b></div>";
				}
				if ($lesson->abAlter!="")
				{
					echo "<div style=\"width:210px; float:left\"><b>";
					echo "geeignet ab: ".$lesson->abAlter." Jahren";
					echo "</b></div>";
				}
				echo "<div style=\"clear: both;\"></div>";

				echo "<div style=\"width:100%; float:none\">";
				if ($lesson->Beschreibung=="")
				{
					$beschreibung = "";
				} else
				{
					$beschreibung = $lesson->Beschreibung;
				}
				echo $beschreibung;
				echo "</div>\n";

				echo "<div style=\"width:100%; ;clear:left; float:none\">";
				// und hier die Lehrer
				//echo $lesson->id.":";
				$anz=0;
				$namen ="";
				for ($j=0, $m=count( $this->teachers ); $j < $m; $j++)
				{
					$teacher = &$this->teachers[$j];
					//echo $teacher->id_lehrer.",";
					if ($lesson->id==$teacher->id_lehrer)
					{
						
						if ($anz==0) { echo "<div><b>Lehrer: </b></div>"; }
						echo "<div style=\"width:170px;float:left\">";
						if ($teacher->bild=="")
						{
							$bld = "images/potter/personen/"."schattenbild.jpg";
						} else
						{
							$bld = $year->path."/".$teacher->bild;
						}
						
						$na1 = trim($teacher->ma_titel." ".$teacher->ma_vname." ".$teacher->ma_name);
						echo "<img src=\"".$bld."\" title=\"".$na1."\">";
						$namen .= "<div style=\"width:170px;float:left\">".$na1."</div>";
						$anz++;
						echo "</div>";
					}
				}
				echo "<div style=\"clear: both;\"></div>";
				echo $namen;
				echo "<div style=\"clear: both;\"></div>";
				echo "</div><br>";
			
			echo "</div></div>\n";
		}
		//echo "<p><p>&Auml;nderungen derzeit nur durch den Webmaster m&ouml;glich!";
		echo "<br>".$this->params->get('fuss')."<br>"; 	
	} else
	{// keine Daten
		echo "<br>".$this->params->get('leer')."<br>"; 	
	}
	?>
</div>
