<?php

// generate some random data:
include_once('../../bin/db/db_functions.php');
$data=array();
$label=array();
$counter;
$images=listAllOwnImages("timok");
foreach($images as $key=>$value){

        $val=getImageAttributeV($value, "FocalLength");
        if(!$val=="" && !$val=="0"){
        $counter+=1;
        list($pt1, $pt2) = split('[/.-]', $val);
        $val2=$pt1/$pt2;
        $lab=strval($val2);
        echo $val2;
        $data[$lab]+=1;
                #echo getImageAttributeV($value, "ISOSpeedRatings");
        }
}
ksort($data);
foreach ($data as $key2=>$value2){
$label[]=$key2;
#echo $key2;
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

$bar_blue = new bar_outline( 55, '#5E83BF', '#424581' );
#bar_blue = new bar_3d( 75, '#3334AD' );
$bar_blue->key( 'Focal Length', 10 );
$bar_blue->data=$data;
$g = new graph();

$g->set_data( $data );
// Spoon sales, March 2007
$g->title( 'Focal Length ('.$counter.' images)', '{font-size: 26px;}' );

#$g->data_sets[]=$bar_blue;

// label each point with its value
#$g->set_x_labels( array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' ) );
$g->set_x_axis_steps(3);
$g-> set_y_legend('PCS', 15, '#8B4B50');

$g->set_x_labels($label);
// set the Y max
$g->set_y_max( max($data)+10 );
// label every 20 (0,20,40,60)
$g->y_label_steps( 6 );

// display the data
echo $g->render();
?>
