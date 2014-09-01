<?php defined('_JEXEC') or die; ?>
<div id="editcell">
<?
	$row = &$this->darst[0];
	$year = &$this->year[0];
//	$imgpath = JPATH_ROOT.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_potter'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
	$imgpath = 'components/com_potter/images/';
	//print_r($year);
	//echo $year->path;
	
	// Hogwarts und Schülersprecher
	$bgc = "#FFFFFF";
	echo "\n<div style=\"background-color: ".$bgc.";width:100%; float:none; color:#000000;border:none; border-width:thin\">";
	echo "\n<div style=\"width:100%; float:none; text-align:center; margin:auto;font-size:16px; font-weight:bolder\">";
	echo "\n<br>Schülersprecher ".$year->Jahr."<br><br>";
	echo "\n</div>";
	echo "\n<div style=\"width:220px; float:left; text-align:center; margin:auto\">";
	echo "<img src=\"".$imgpath."zauberschloss.gif\" title=\"Zauberschloss\">";
	echo "\n</div>";
	for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
	{
		$roll = &$this->rolls[$i];
		if ($roll->Sonder==2)
		{
			echo "\n<div style=\"width:180px; float:left; text-align:center\">";
			echo "<div style=\"float:none\">";
			if ($roll->bild=="")
			{
				$bld = "images/potter/personen/"."schattenbild.jpg";
			} else
			{
				$bld = $year->path."/".$roll->bild;
			}
			$na = trim($roll->ma_vname." ".$roll->ma_name);
			echo "<img src=\"".$bld."\" title=\"".$na."\">";
			echo "</div>";
			echo "<div style=\"float:none\">";
			echo $na;
			echo "</div>";
			echo "\n</div>";
		}
	}
	echo "<div style=\"clear: both;\"></div>";

	echo "\n<br><br></div>";
	
	// Gryffindor
	$bgc = "#FF0000";
	echo "\n<div style=\"background-color: ".$bgc."; width:100%; float:none; color:#000000; border:none; border-width:thin\">";
	echo "\n<div style=\"width:100%; float:none; text-align:center; margin:auto;font-size:16px; font-weight:bolder\">";
	echo "\n<br>Das Haus Gryffindor ".$year->Jahr."<br><br>";
	echo "\n</div>";
	echo "\n<div style=\"width:220px;float:left; text-align:center; margin:auto\">";
	echo "<img src=\"".$imgpath."gryffindor.gif\" title=\"Gryffindor\">";
	echo "\n</div>";
	
	echo "\n<div style=\"float:left\">";
		echo "<div><b>Eigenschaften des Hauses:</b><br>";
		echo "Dort regieren, wie man weiß, Tapferkeit und Mut.";
		echo "</div>";

		echo "<div style=\"float:none\"><br><b>Gemeinschaftsraum: </b>";
		echo $this->params->get('gry');
		echo "</div>";
	//echo "<div style=\"clear: both;\"></div>";

		echo "<div><br>&nbsp;<b>Hauslehrer:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==3) and ($roll->haus==1))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

		echo "<div><br>&nbsp;<b>Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==1) and ($roll->haus==1))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";
		echo "<div><br>&nbsp;<b>Stellvertretender Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==4) and ($roll->haus==1))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

	echo "</div>";
	echo "<div style=\"clear: both;\"></div>";
	echo "\n<br><br></div>";
	
	// Hufflepuff
	$bgc = "#FFFF66";
	echo "\n<div style=\"background-color: ".$bgc."; width:100%; float:none; color:#000000; border:none; border-width:thin\">";
	echo "\n<div style=\"width:100%; float:none; text-align:center; margin:auto;font-size:16px; font-weight:bolder\">";
	echo "\n<br>Das Haus Hufflepuff ".$year->Jahr."<br><br>";
	echo "\n</div>";
	echo "\n<div style=\"width:220px;float:left; text-align:center; margin:auto\">";
	echo "<img src=\"".$imgpath."hufflepuff.gif\" title=\"Hufflepuff\">";
	echo "\n</div>";
	
	echo "\n<div style=\"float:left\">";
		echo "<div><b>Eigenschaften des Hauses:</b><br>";
		echo "Dort ist man gerecht und treu, <br>man hilft dem Anderen und hat vor Arbeit keine Scheu.";
		echo "</div>";

		echo "<div style=\"float:none\"><br><b>Gemeinschaftsraum: </b>";
		echo $this->params->get('huf');
		echo "</div>";
	//echo "<div style=\"clear: both;\"></div>";

		echo "<div><br>&nbsp;<b>Hauslehrer:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==3) and ($roll->haus==3))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

		echo "<div><br>&nbsp;<b>Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==1) and ($roll->haus==3))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";
		echo "<div><br>&nbsp;<b>Stellvertretender Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==4) and ($roll->haus==3))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

	echo "<div style=\"clear: both;\"></div>";
	echo "</div>";
	echo "<div style=\"clear: both;\"></div>";
	echo "\n<br><br></div>";

	// Bossander
if ($year->Jahr==2011)
{	
	$bgc = "#FF7200";
	echo "\n<div style=\"background-color: ".$bgc."; width:100%; float:none; color:#000000; border:none; border-width:thin\">";
	echo "\n<div style=\"width:100%; float:none; text-align:center; margin:auto;font-size:16px; font-weight:bolder\">";
	echo "\n<br>Das Haus Bossander ".$year->Jahr."<br><br>";
	echo "\n</div>";
	echo "\n<div style=\"width:220px;float:left; text-align:center; margin:auto\">";
	echo "<img src=\"".$imgpath."bossander.gif\" title=\"Bossander\">";
	echo "\n</div>";
	
	echo "\n<div style=\"float:left\">";
		echo "<div><b>Eigenschaften des Hauses:</b><br>";
		echo "Hier sind die Kreativen zu Haus, doch auch das Gefuehlvolle zeichnet diese Schueler aus.";
		echo "</div>";

		echo "<div style=\"float:none\"><br><b>Gemeinschaftsraum: </b>";
		echo $this->params->get('bos');
		echo "</div>";
	//echo "<div style=\"clear: both;\"></div>";

		echo "<div><br>&nbsp;<b>Hauslehrer:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==3) and ($roll->haus==5))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

		echo "<div><br>&nbsp;<b>Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==1) and ($roll->haus==5))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";
		echo "<div><br>&nbsp;<b>Stellvertretender Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==4) and ($roll->haus==5))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

	echo "<div style=\"clear: both;\"></div>";
	echo "</div>";
	echo "<div style=\"clear: both;\"></div>";
	echo "\n<br><br></div>";
}
	// Ravenclaw
	$bgc = "#0033CC";
	echo "\n<div style=\"background-color: ".$bgc."; width:100%; float:none; color:#000000; border:none; border-width:thin\">";
	echo "\n<div style=\"width:100%; float:none; text-align:center; margin:auto;font-size:16px; font-weight:bolder\">";
	echo "\n<br>Das Haus Ravenclaw ".$year->Jahr."<br><br>";
	echo "\n</div>";
	echo "\n<div style=\"width:220px;float:left; text-align:center; margin:auto\">";
	echo "<img src=\"".$imgpath."ravenclaw.gif\" title=\"Ravenclaw\">";
	echo "\n</div>";
	
	echo "\n<div style=\"float:left\">";
		echo "<div><b>Eigenschaften des Hauses:</b><br>";
		echo "Geschwind im Denken, gelehrsam auch und Weise.";
		echo "</div>";

		echo "<div style=\"float:none\"><br><b>Gemeinschaftsraum: </b>";
		echo $this->params->get('rav');
		echo "</div>";
	//echo "<div style=\"clear: both;\"></div>";

		echo "<div><br>&nbsp;<b>Hauslehrer:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==3) and ($roll->haus==2))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

		echo "<div><br>&nbsp;<b>Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==1) and ($roll->haus==2))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";
		echo "<div><br>&nbsp;<b>Stellvertretender Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==4) and ($roll->haus==2))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

	echo "<div style=\"clear: both;\"></div>";
	echo "</div>";
	echo "<div style=\"clear: both;\"></div>";
	echo "\n<br><br></div>";

	// Slytherin
	$bgc = "#006633";
	echo "\n<div style=\"background-color: ".$bgc."; width:100%; float:none; color:#000000; border:none; border-width:thin\">";
	echo "\n<div style=\"width:100%; float:none; text-align:center; margin:auto;font-size:16px; font-weight:bolder\">";
	echo "\n<br>Das Haus Syltherin ".$year->Jahr."<br><br>";
	echo "\n</div>";
	echo "\n<div style=\"width:220px;float:left; text-align:center; margin:auto\">";
	echo "<img src=\"".$imgpath."slytherin.gif\" title=\"Slytherin\">";
	echo "\n</div>";
	
	echo "\n<div style=\"float:left\">";
		echo "<div><b>Eigenschaften des Hauses:</b><br>";
		echo "Hier weiß man noch List und Tücke zu verbinden, <br>dafür wirst du hier noch echte Freunde finden.";
		echo "</div>";

		echo "<div style=\"float:none\"><br><b>Gemeinschaftsraum: </b>";
		echo $this->params->get('sly');
		echo "</div>";
	//echo "<div style=\"clear: both;\"></div>";

		echo "<div><br>&nbsp;<b>Hauslehrer:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==3) and ($roll->haus==4))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

		echo "<div><br>&nbsp;<b>Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==1) and ($roll->haus==4))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";
		echo "<div><br>&nbsp;<b>Stellvertretender Vertrauensschüler:</b></div>";
		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
		
			if (($roll->Sonder==4) and ($roll->haus==4))
			{
				echo "\n<div style=\"width:180px; float:left; text-align:center\">";
					echo "<div style=\"float:none\">";
					if ($roll->bild=="")
					{
						$bld = "images/potter/personen/"."schattenbild.jpg";
					} else
					{
						$bld = $year->path."/".$roll->bild;
					}
					$na = trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name);
					echo "<img src=\"".$bld."\" title=\"".$na."\">";
					echo "</div>";
					echo "<div style=\"float:none\">";
					echo $na;
					echo "</div>";
				echo "\n</div>";
			}
		}
		echo "<div style=\"clear: both;\"></div>";
		//echo "</div>";

	echo "<div style=\"clear: both;\"></div>";
	echo "</div>";
	echo "<div style=\"clear: both;\"></div>";
	echo "\n<br><br></div>";
	
?>

</div>
