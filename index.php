<!DOCTYPE html>
<html>
<head>
	<title>Рассчет времени навигационных сумерек</title>
</head>
<body>
	<p>
Select a city to find out how many minutes navigational twilight lasts.</p>
	<form  method="POST" action="" >
<select name="city">
<option value="Moscow">Москва</option>
<option value="Sait-Petersburg">Санкт-Петербург</option>
<option value="Irkutsk">Иркутск</option>
<option value="Vladivostok">Владивосток</option>
</select>
<input type="submit" name="submit" value="Отправить">
</form>
</body>
</html>

 <?php if (isset($_POST['submit'])): ?>
 <p>In <?php echo $_POST['city']; ?>:</p>	
 <?php endif ?>
<?php 
if (isset($_POST['submit'])) {
	

class Twillight  
{

	function Civil($x1,$x2)
	{
		 $z1 = deg2rad(96);
		$cosz1 = cos($z1);
		$z2 = deg2rad(102);
		 $sinx1 = sin(deg2rad($x1));
		 $cosx1 = cos(deg2rad($x1));
		 $longitude = $x2/15;
		 $t = date("z") + (6-$longitude)/24;
		 $M = (0.985600 * $t) - 3.289;
		 $L=$M + (1.916*(sin(deg2rad($M)))) + (0.020*sin(deg2rad(2*$M))) + 282.634;
		 $L=$L-360;
		 $tanRA = 0.91746 * tan(deg2rad($L));
		 $Ra = $L/15;
		 $sinb = 0.39782 * sin(deg2rad($L));
		 $cosb = sqrt(1 -($sinb*$sinb));
		 $x = ($cosz1 - ($sinb)*($sinx1))/($cosb*$cosx1);
		 $arccosx = rad2deg(acos($x));
		 $H = (360 - $arccosx)/15;
		 $T = $H + $Ra - (0.065710*$t) - 6.622;
		 $UT = $T - $longitude;
		 $EDT = $UT +3;
		 return $EDT ;
	}
		function Nautical($x1,$x2)
	{
		 $z1 = deg2rad(102);
		$cosz1 = cos($z1);
		 $sinx1 = sin(deg2rad($x1));
		 $cosx1 = cos(deg2rad($x1));
		 $longitude = $x2/15;
		 $t = date("z") + (6-$longitude)/24;
		 $M = (0.985600 * $t) - 3.289;
		 $L=$M + (1.916*(sin(deg2rad($M)))) + (0.020*sin(deg2rad(2*$M))) + 282.634;
		 $L=$L-360;
		 $tanRA = 0.91746 * tan(deg2rad($L));
		 $Ra = $L/15;
		 $sinb = 0.39782 * sin(deg2rad($L));
		 $cosb = sqrt(1 -($sinb*$sinb));
		 $x = ($cosz1 - ($sinb)*($sinx1))/($cosb*$cosx1);
		 $arccosx = rad2deg(acos($x));
		 $H = (360 - $arccosx)/15;
		 $T = $H + $Ra - (0.065710*$t) - 6.622;
		 $UT = $T - $longitude;
		 $EDT = $UT +3;
		 return $EDT ;
	}
}

$a=new Twillight();

if ($_POST['city'] == 'Moscow') {
$time_moscow = date_parse_from_format ("H.i",$a->Civil(55.75,37.61) - $a->Nautical(55.75,37.61));
echo $time_moscow = ($time_moscow["minute"] + $time_moscow["hour"]*60)*2;
}
if ($_POST['city'] == 'Sait-Petersburg') {
$time_sp = date_parse_from_format ("H.i",$a->Civil(59.93,30.31) - $a->Nautical(59.93,30.31));
if ($time_sp["minute"] + $time_sp["hour"]*60 == 0) {
 	echo $time_sp = 24*60;
 }else{echo $time_sp =($time_sp["minute"] + $time_sp["hour"]*60)*2;} 
}
if ($_POST['city'] == 'Irkutsk') {
$time_irkutsk = date_parse_from_format ("H.i",$a->Civil(52.28,104.28) - $a->Nautical(52.28,104.28));
echo $time_irkutsk= ($time_irkutsk["minute"] + $time_irkutsk["hour"]*60)*2;
}
if ($_POST['city'] == 'Vladivostok') {
$time_vladivostok = date_parse_from_format ("H.i",$a->Civil(43.11,131.88) - $a->Nautical(43.11,131.88));
echo $time_vladivostok= ($time_vladivostok["minute"] + $time_vladivostok["hour"]*60)*2;
}


}
?>
