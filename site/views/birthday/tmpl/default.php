<?php defined('_JEXEC') or die; ?>
<div id="editcell">
<?
	$mo[0] = JText::_( 'unbekannt' );
	$mo[1] = JText::_( 'Januar' );
	$mo[2] = JText::_( 'Februar' );
	$mo[3] = JText::_( 'March' );
	$mo[4] = JText::_( 'April' );
	$mo[5] = JText::_( 'May' );
	$mo[6] = JText::_( 'June' );
	$mo[7] = JText::_( 'July' );
	$mo[8] = JText::_( 'August' );
	$mo[9] = JText::_( 'September' );
	$mo[10]= JText::_( 'October' );
	$mo[11]= JText::_( 'November' );
	$mo[12]= JText::_( 'December' );
	
	if (count($this->rolls)>0)
	{
		$Anzahl = 0;
		$Mon = -1;
		echo "<h3>bekannte Geburtstage der aktiven Potter Darsteller</h3>";
    	echo "<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\">\n";
    	echo "<tr valign=\"top\" bgcolor=\"#DFDFDF\">";
    	echo "<td width=\"100\"><strong>".JText::_( 'month' )."</strong></td>";
    	echo "<td width=\"50\" align=\"right\"><strong>".JText::_( 'day' )."</strong></td>";
    	echo "<td width=\"400\"><strong>".JText::_( 'name' )."</strong></td>";
    	echo "</tr>\n";

		for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
		{
			$roll = &$this->rolls[$i];
			if ($roll->birthday!="")
			{ 
				$Anzahl++;
				if (($Anzahl % 2) == 0)
				{
					$bgc = "#DFDFDF";
				} else
				{
					$bgc = "#D6D6D6";
				}
				echo "<tr valign=\"top\" bgcolor=\"$bgc\">\n";
				if ($Mon == $roll->m)
				{
					$sMon = "&nbsp;";
				}else
				{
					if ($roll->birthday==NULL)
					{
						$sMon = $mo[0];
					}else
					{
						$sMon = $mo[$roll->m];
					}
					$Mon = $roll->m;
				}
				$alter = $roll->y1-$roll->y;
				if ($roll->cd<$roll->doy)
				{ $alter--;}
				echo "<td>$sMon</td>\n";
				echo "<td>".$roll->d."</td>\n";
				echo "<td>".trim($roll->realvname." ".$roll->realname)." (".$alter.")</td>\n";
				echo "</tr>";
			} // Geburstag bekannt	 
		} // alle Geburtstage ausgeben
		echo "</table>";
		echo "<p><p>&Auml;nderungen derzeit nur durch den Webmaster m&ouml;glich!<br>";
		echo "F&uuml;r die Richtigkeit der Daten sind die Darsteller selber verantwortlich!<br>";
	} // sind überhaupt Darsteller da?
	?>
</div>
