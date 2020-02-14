<?php 

// Ausgabe als Text-Datei
header('Content-Type: text/plain');         # its a text file
header('Content-Disposition: attachment; filename=ARK_game.ini');


$multiP = $_GET['maxExP'] / pow($_GET['maxPlv'], $_GET['facktorP']);
$multiD = $_GET['maxExD'] / pow($_GET['maxDlv'], $_GET['facktorD']);
$multiE = $_GET['maxEgP'] / pow( ( $_GET['maxElv'] - 1 ) , $_GET['facktorE']);

if($_GET['ini'] == "i"){ $noRaw = true; }
// Rubrik Start in der ini
print("[/script/shootergame.shootergamemode]\n");

// Funktion die sicher stellt das der nächste Wert immer mindesten um 1 grösser ist
function Not_Null($base, $min, $lv)
{
	if( $base < $min + ($lv * 10))
	{
		$base = $min + ($lv * 10);
	}
	return($base);
}

// Ausgabe der Experience Liste (brauch ich 2 mal (Spieler, Dinosaurier) deswegen als Funktion)
function Print_Experience($maxLv, $facktor, $multiplicator, $noRaw, $Clv, $Cfaktor)
{
	$temp = 0;
	$Cmultiplicator = ceil( pow($Clv - 1, $facktor) * $multiplicator ) / ($Clv * $Cfaktor);
	if(!$noRaw){ print("Parameter: $maxLv, $facktor, $multiplicator, $Clv, $Cfaktor, $Cmultiplicator\n"); }
	for ($i = 1; $i <= $maxLv; $i++)
	{
		if( $i <= $Clv - 1 ){ $exp = ceil( $i * $Cmultiplicator ); }
		else{ $exp = Not_Null( ceil( pow($i, $facktor) * $multiplicator ), $temp, $i ); }
		if($noRaw)
		{
			print("ExperiencePointsForLevel[" . ($i - 1) . "]=$exp");
			if($i < $maxLv){ print(","); }
			else{ print(")\n"); }
		}
		else{ print("$exp\n"); }
		$temp = $exp;
	}
}

function StatusBlock($typ, $factor)
{
	if($typ == "P"){ $text = "PerLevelStatsMultiplier_Player"; }
	if($typ == "D"){ $text = "PerLevelStatsMultiplier_DinoTamed"; }
	if($typ == "W"){ $text = "PerLevelStatsMultiplier_DinoWild"; }
	for($i = 0; $i <= 11; $i++)
	{
		print($text . "[" . $i . "]=$factor\n");
	}
}

if($noRaw){ print("LevelExperienceRampOverrides=("); }
else{ print("Spieler Exp Liste\n"); }
Print_Experience($_GET['maxPlv'], $_GET['facktorP'], $multiP, $noRaw,$_GET['Clv'],$_GET['Cfaktor']);

if($noRaw){ print("LevelExperienceRampOverrides=("); }
else{ print("Dinosaurier Exp Liste\n"); }
print("LevelExperienceRampOverrides=(");
Print_Experience($_GET['maxDlv'], $_GET['facktorD'], $multiD, $noRaw,0,1);

// Ausgabe der Engrampunkte
$allPoint = 0;
if($noRaw){ print("OverridePlayerLevelEngramPoints=0\n"); }
else{ print("Engram Punkte Liste\nParameter: " . $_GET['maxElv'] . "," . $_GET['maxEgP'] . "," . $_GET['facktorE'] . "\n"); }
for ($i = 1; $i <= ( $_GET['maxElv'] - 1 ) ; $i++)
{
	$point = ceil( pow($i, $_GET['facktorE'] ) * $multiE ) - $allPoint;
	if( $point < ( ceil($i / 3) + 7 ) ){ $point = ceil($i / 3) + 7; }
	if( $allPoint + $point > $_GET['maxEgP'] )
	{
		$point = $_GET['maxEgP'] - $allPoint - ( $_GET['maxElv'] - $i );
	}
	if( $point < 0 ){ $point = 1; }
	if($noRaw)
	{
		print("OverridePlayerLevelEngramPoints=$point\n");
	}
	else
	{
		print("$point\n");
	}
	$allPoint = $allPoint + $point;
}

if($i < $_GET['maxPlv'])
{
	for(; $i <= $_GET['maxPlv']; $i++)
	{
		if($noRaw)
		{
			print("OverridePlayerLevelEngramPoints=0\n");
		}
		else
		{
			print("0\n");
		}
	}
}

if($noRaw)
{
	$maxExP = $_GET['maxExP'];
	$maxExD = $_GET['maxExD'];
	print("OverrideMaxExperiencePointsPlayer=$maxExP\n");
	print("OverrideMaxExperiencePointsDino=$maxExD\n");
	
	if( $_GET['statP'] <> 1)
	{
		StatusBlock("P", $_GET['statP']);
	}
	if( $_GET['statD'] <> 1)
	{
		StatusBlock("D", $_GET['statD']);
	}
	if( $_GET['statW'] <> 1)
	{
		StatusBlock("W", $_GET['statW']);
	}
}

?>
