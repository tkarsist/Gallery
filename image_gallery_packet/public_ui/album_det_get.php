<?php
if (isset($_GET['image'])) {
	$image_safe=strip_tags($_GET['image']);
	foreach($_SESSION['kuvat'] as $key => $nimi){
		if ($image_safe==$nimi){
			$taulu=array_navigate($_SESSION['kuvat'],$key);
			$next_image=$_SESSION['kuvat'][$taulu['next']];
			$prev_image=$_SESSION['kuvat'][$taulu['prev']];

		}
	}
	$_SESSION['current_image']=$image_safe;
	$_SESSION['next_image']=$next_image;
	$_SESSION['prev_image']=$prev_image;
}


?>

<?php
if (isset($_GET['size'])) {
	if (empty($_GET['size'])) {

	}
	else {
		$size_safe=strip_tags($_GET['size']);
		$_SESSION['size']=$size_safe;
	}
}
?>

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
