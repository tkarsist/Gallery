<?php

// generate some random data:
include_once('../../bin/db/db_functions.php');
$data=array();
$label=array();
$counter;
$images=listAllOwnImages("timok");
foreach($images as $key=>$value){
	$val=getImageAttributeV($value, "ISOSpeedRatings");
	if(!$val=="" && !$val=="0"){
        $counter+=1;

	$data[intval($val)]+=1;
		#echo getImageAttributeV($value, "ISOSpeedRatings");
	}
}
ksort($data);
foreach ($data as $key2=>$value2){
$label[]=$key2;
}
/*srand((double)microtime()*1000000);

$max = 50;
$data = array();
for( $i=0; $i<12; $i++ )
{
  $data[] = rand(0,$max);
}
*/
// use the chart class to build the chart:
include_once( 'php-ofc-library/open-flash-chart.php' );

$bar_blue = new bar_glass( 55, '#5E83BF', '#424581' );
#bar_blue = new bar_3d( 75, '#3334AD' );
$bar_blue->key( 'ISO RATING', 10 );
$bar_blue->data=$data;
$g = new graph();

// Spoon sales, March 2007
$g->title( 'Iso rating ('.$counter.' images)', '{font-size: 26px;}' );

$g->data_sets[]=$bar_blue;
// label each point with its value
#$g->set_x_labels( array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' ) );
$g->set_x_labels($label);
$g-> set_y_legend('PCS', 15, '#8B4B50');
$g->set_x_legend('Iso rating', 15, '#8B4B50');

// set the Y max
$g->set_y_max( max($data)+10 );
// label every 20 (0,20,40,60)
$g->y_label_steps( 6 );

// display the data
echo $g->render();
?>
