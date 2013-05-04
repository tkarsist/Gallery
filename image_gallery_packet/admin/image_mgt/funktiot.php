<?php
function array_navigate($array, $key)
{
    $keys = array_keys($array);
    $index = array_flip($keys);
   
    $return = array();
    
    $return['prev'] = (isset($keys[$index[$key]-1])) ? $keys[$index[$key]-1] : end($keys);
		
	$return['next'] = (isset($keys[$index[$key]+1])) ? $keys[$index[$key]+1] : current($keys);

    return $return;
}
?>

<?php
include_once('config_img_mgt.php');
function remove_pic($array){
foreach ($array as $kuva) {
 	   		foreach($_SESSION['kuva_taulu'] as $index => $im)	{
 	   			if($im == $kuva){
 	   				
 	   				unset($_SESSION['kuva_taulu'][$index]);
					break;
				}
			}
    	}
}

function remove_pic_permanent($array){
	global $image_functions_file;
	include_once ($image_functions_file);
	foreach ($array as $kuva) {
 		   		foreach($_SESSION['kuva_taulu'] as $index => $im)	{
 	   				if($im == $kuva){
 	   					//poistaa kuvan kannasta ja levylta
 	   					delImageFromSystem($im, $_SESSION['hiiripippeli']);
 	   					//paivittaa kayttoliittyman taulukon
 	   					unset($_SESSION['kuva_taulu'][$index]);
 	   					
						break;
					}
				}
    		}
}
function getOwnRating(){
	global $image_functions_file;
	include_once ($image_functions_file);
	$atr_name="ownRating";
	$value=getImageAttributeV($_SESSION['current_image'], $atr_name);
	switch ($value) {
		case  "1":
			$_SESSION[$_SESSION['current_image']]="aarhg...";
			break;
		case  "2":
			$_SESSION[$_SESSION['current_image']]="no jaaa...";
			break;
		case "3":
			$_SESSION[$_SESSION['current_image']]="Menettelee";
			break;
		case "4":
			$_SESSION[$_SESSION['current_image']]="Aika kurko";
			break;
		case "5":
			$_SESSION[$_SESSION['current_image']]="Megasumee!!!";
			break;

	}
}
?>

