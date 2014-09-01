<?php defined('_JEXEC') or die; ?>
<div id="editcell">
<?
	$row = &$this->darst[0];
	echo "<h3>Hallo ".$row->realvname." ".$row->realname.", das ist dein Profil:</h3>";
	if ($row->Bild=="")
	{
		$bld = "schattenbild1.jpg";
	} else
	{
		$bld = $row->Bild;
	}
	$bld = "images/potter/personen/".$bld;
	if ($row->Comment=="")
	{
		$beschreibung = "Noch kein Profiltext vorhanden!";
	} else
	{
		$beschreibung = $row->Comment;
	}
?>	
	<img src="<? echo $bld; ?>" title="<? echo $row->realvname." ".$row->realname; ?>" alt="<? echo $row->realvname." ".$row->realname; ?>" hspace="15" vspace="0" align="left">
	<? 
	echo $beschreibung;
	echo "<p><b>Geburtstag:</b> ";
	if ($row->birthday!=NULL)
	{
		echo date("d.m.Y",StrToTime(stripslashes($row->birthday)));
	}

	?>
    <p><b>Internet:</b> <? echo "<a href=\"".$row->www."\" target=\"_blank\">".$row->www."</a>"; ?>
    <p><b>E-Mail: </b><? echo $row->email." (wird "; if ($row->showmail==0) { echo "nicht ";} echo "&ouml;ffentlich anzeigt)";?>
    <p><b>Telefon: </b><? echo $row->Telefon; ?>
	<p><b>Anschrift: </b><? echo $row->PLZ." ".$row->Ort.", ".$row->Strasse;?>    

	<p><b>
	<? if ($row->sex==0){ echo "Ihre"; } else {echo "Seine"; }
	echo " Rollen der letzten Jahre:</b></p>";
	for ($i=0, $n=count( $this->rolls ); $i < $n; $i++)
	{
		$roll = &$this->rolls[$i];
		echo $roll->Jahr.": ".trim($roll->ma_titel." ".$roll->ma_vname." ".$roll->ma_name)."<br>";
	}

	echo "<p><p>&Auml;nderungen derzeit nur durch den Webmaster m&ouml;glich!";
	?>
</div>
