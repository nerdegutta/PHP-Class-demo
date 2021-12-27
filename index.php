<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $settings[site_title]; ?></title>	
</head>
<body>
<?php
$dir = "/var/www/html/smart-pest.org/class/example/02_";
$files = scandir($dir);

for ($i=0;$i<count($files); $i++) {
	echo "<a href='$files[$i]'>".$files[$i]."</a><br />";
}
?>
</body>
</html>
