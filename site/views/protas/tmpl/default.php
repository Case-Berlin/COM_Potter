<?php defined('_JEXEC') or die; ?>
<div id="editcell">
<?
	$row = &$this->darst[0];
	$year = &$this->year[0];
	//print_r($year);
	//echo $year->path;
	if (count( $this->rolls )>0)
	{
		$bgc = "#D6D6D6";
		echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none; border:none; border-width:thin\">";
		echo "<br><h3>Übersicht über alle wichtigen Personen im Zauberschloss ".$year->Jahr."</h3><br>";
		echo "</div>";
		$bgc = "#DFDFDF";
		echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none; border:none; border-width:thin\">";
		echo ".";
		echo "</div>";
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
				echo "<br>";
				if ($roll->anzeigen)
				{
//					echo "<div style=\"width:20px; float:left\">";
//					echo '<img src="images/M_images/con_info.png" title="Info zum Darsteller (in Arbeit)" alt="Info">';
//					echo "</div>";
				}
				echo "<div style=\"width:450px; float:left\">";
				echo "<h3>".trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name)."</h3><br>\n";
				echo "</div>";
				echo "<div style=\"width:150px; float:left\">";
				// @var int 0 - sonstiges, 1 - Lehrer, 2 - Schüler, 3 - Ministerium, 4 - Ministerium/Lehrer, 5 - Presse
				$job = "";
				switch ($roll->Funktion)
				{

					case 0 :
							switch ($roll->Sonder)
							{
							    case 6 : 
								$job = JText::_('Direktor');
								break;
							    case 7 : 
								$job = JText::_('HEK');
								break;
							    case 8 : 
								$job = JText::_('FOG');
								break;
							}
							break;

					case 1 :
							$job = JText::_('Lehrer');
							break;
					case 2 :
							$job = JText::_('Schueler');
							break;
					case 3 :
							$job = JText::_('Ministerium');
							break;
					case 4 :
							$job = JText::_('Ministerium/Lehrer');
							break;
					case 5 :
							$job = JText::_('Presse');
							break;
				}
				echo $job;
				echo "</div>";
				echo "<div style=\"width:100px; float:left\">";
				// @var int 0 - unbekannt; 1 - Gryffindor; 2 - Ravenclaw; 3 - Hufflepuff; 4 - Slytherin; 5 - Bossander
				$haus = "";
				switch ($roll->haus)
				{
					case 1 :
							$haus = 'Gryffindor';
							break;
					case 2 :
							$haus = 'Ravenclaw';
							break;
					case 3 :
							$haus = 'Hufflepuff';
							break;
					case 4 :
							$haus = 'Slytherin';
							break;
					case 5 :
							$haus = 'Bossander';
							break;
				}
				echo $haus;
				echo "</div>";
				echo "<div style=\"clear: both;\"></div>";
				if ($roll->kcomment<>"")
				{
					echo "<div style=\"width:300px; float:left\">";
					echo "<b>".$roll->kcomment."</b><p>";
					echo "</div>";
					echo "<div style=\"clear: both;\"></div>";
				}

				if ($roll->bild=="")
				{
					$bld = "images/potter/personen/"."schattenbild.jpg";
				} else
				{
					$bld = $year->path."/".$roll->bild;
				}
				if ($roll->comment=="")
				{
					$beschreibung = "";
				} else
				{
					$beschreibung = $roll->comment;
				}
				if ($roll->zurperson=="")
				{
					$beschreibung .= "";
				} else
				{
					$beschreibung .= "<p><p><b>Zur Person:</b><br>".$roll->zurperson;
				}?>
				<div align="center" style="width:170px;float:left">
				<img src="<? echo $bld; ?>" title="<? echo $roll->ma_vname." ".$roll->ma_name; ?>" alt="<? echo $roll->ma_vname." ".$roll->ma_name; ?>">
				</div>
				<div>
				<? 
				echo $beschreibung;
				echo "</div></div>\n";

				echo "<div style=\"width:100%; ;clear:left; float:none\">";
				// und hier die Daten
				echo "</div><br>";
			
			echo "</div>\n";
		}
		//echo "<p><p>&Auml;nderungen derzeit nur durch den Webmaster m&ouml;glich!";
		echo "<br>".$this->params->get('fuss')."<br>"; 	
	} else
	{// keine Daten
		echo "<br>".$this->params->get('leer')."<br>"; 	
	}
	?>
</div>
