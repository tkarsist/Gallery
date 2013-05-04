<html>
<head>
</head>
<body>
<?php
include_once 'php-ofc-library/open_flash_chart_object.php';
open_flash_chart_object( 800, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/paska/open_flash_chart2/chart-data.aperture.php', true );
open_flash_chart_object( 800, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/paska/open_flash_chart2/chart-data.focal.php', true );
open_flash_chart_object( 800, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/paska/open_flash_chart2/chart-data.iso.php', true );

?>
</body>
</html>
