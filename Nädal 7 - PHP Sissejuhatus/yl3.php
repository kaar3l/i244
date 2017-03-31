<head>
</head>
<html>
<title>PHP Sissejuhatus</title>
<body><p><b>Ülesanne 3 - Massiivid</b></p>
<?php
$teed= array( 
		array('number'=>'18175', 'nimi'=>'Põlgaste-Roosi', 'tyyp'=>'kõrvalmaantee', 'klass'=>'6', 'pikkus'=>'4481', 'link'=>'http://xgis.maaamet.ee/xGIS/XGis?app_id=UU75&user_id=at&bbox=667557.763066954,6426387.3,674777.236933046,6430779.7&LANG=1'), 
		array('number'=>'18162', 'nimi'=>'Himmaste-Rasina', 'tyyp'=>'kõrvalmaantee', 'klass'=>'6', 'pikkus'=>'18018', 'link'=>'http://xgis.maaamet.ee/xGIS/XGis?app_id=UU75&user_id=at&bbox=673829.977969762,6441819.8,700224.022030238,6457878.2&LANG=1'),
		array('number'=>'90', 'nimi'=>'Põlva-Karisilla', 'tyyp'=>'tugimaantee', 'klass'=>'5', 'pikkus'=>'34219', 'link'=>'http://xgis.maaamet.ee/xGIS/XGis?app_id=UU75&user_id=at&bbox=677865.8,6422546.51760841,714456.2,6444808.48239159&LANG=1'),
		array('number'=>'62', 'nimi'=>'Kanepi-Leevaku', 'tyyp'=>'tugimaantee', 'klass'=>'5', 'pikkus'=>'41820', 'link'=>'http://xgis.maaamet.ee/xGIS/XGis?app_id=UU75&user_id=at&bbox=661034.3,6424645.43153745,700522.7,6448670.56846255&LANG=1'),
		array('number'=>'2', 'nimi'=>'Tallinn-Tartu-Võru-Luhamaa', 'tyyp'=>'põhimaantee', 'klass'=>'3', 'pikkus'=>'287864', 'link'=>'http://xgis.maaamet.ee/xGIS/XGis?app_id=UU75&user_id=at&punkt=542770,6589013&zoom=373933.046652267&LANG=1'),
		array('number'=>'1', 'nimi'=>'Tallinn-Narva', 'tyyp'=>'põhimaantee', 'klass'=>'3', 'pikkus'=>'212640', 'link'=>'http://xgis.maaamet.ee/xGIS/XGis?app_id=UU75&user_id=at&punkt=542770,6589013&zoom=235525.2&LANG=1')
	);

foreach ($teed as $value) {
   echo "";
   include 'yl3_sise.html';
}
?>
<meta charset="UTF-8" />
<!DOCTYPE html>
