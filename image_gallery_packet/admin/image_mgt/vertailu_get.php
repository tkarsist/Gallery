<?php
//asetetaan default kuvakoko
if(!isset($_SESSION['size'])){
	$_SESSION['size']="800_600";
}


//haetaan omat imaget ja laitetaan ne session tauluun
if(!isset($_SESSION['kuva_taulu'])){
	include_once ('config_img_mgt.php');
	include_once ($db_functions_file);
	$_SESSION['kuva_taulu']=listAllOwnImages($_SESSION['hiiripippeli']);

}

if (isset($_GET['alb_filt'])) {
	include_once ('config_img_mgt.php');
	include_once ($db_functions_file);
	if($_GET['alb_filt']=="All"){
		$_SESSION['kuva_taulu']=listAllOwnImages($_SESSION['hiiripippeli']);
		$_SESSION['alb_filter']=$_GET['alb_filt'];
		unset($_SESSION['rating_check']);
			}
	if ($_GET['alb_filt']=="NotInAlb"){
		$_SESSION['kuva_taulu']=listOwnImagesNotInAlbums($_SESSION['hiiripippeli']);
		$_SESSION['alb_filter']=$_GET['alb_filt'];
		unset($_SESSION['rating_check']);
			}
	if ($_GET['alb_filt']!="NotInAlb" && $_GET['alb_filt']!="All"){
		if(getAlbumAttributeV($_GET['alb_filt'],"owner")==$_SESSION['hiiripippeli'])
		$_SESSION['kuva_taulu']=listAllImagesInAlbum($_GET['alb_filt']);
		$_SESSION['alb_filter']=$_GET['alb_filt'];
		unset($_SESSION['rating_check']);
		}

}
if (isset($_GET['rating'])) {
		include_once ('config_img_mgt.php');
		include_once ($db_functions_file);
	//jos on jo karsittu kuvia pois ratingin avulla, niin haetaan uudestaan kaikki kuvat ennen karsimista
	if(isset($_SESSION['rating_check'])){
		
		if($_SESSION['alb_filter']=="All"){
						
			$_SESSION['kuva_taulu']=listAllOwnImages($_SESSION['hiiripippeli']);
			
		}
		if($_SESSION['alb_filter']=="NotInAlb"){
			$_SESSION['kuva_taulu']=listOwnImagesNotInAlbums($_SESSION['hiiripippeli']);
		}
		if ($_SESSION['alb_filter']!="All" && $_SESSION['alb_filter']!="NotInAlb"){
			$_SESSION['kuva_taulu']=listAllImagesInAlbum($_SESSION['alb_filter']);
	
			}
			//unset($_SESSION['rating_check']);
	}

	if ($_GET['rating']=="1" || $_GET['rating']=="2"|| $_GET['rating']=="3"|| $_GET['rating']=="4"|| $_GET['rating']=="5"){
		$_SESSION['rating_check']=$_GET['rating'];
		foreach ($_SESSION['kuva_taulu'] as $key => $nimi){
			if(getImageAttributeV($nimi, "ownRating")!=$_GET['rating']){
				unset($_SESSION['kuva_taulu'][$key]);
			}
		}
	}
	if($_GET['rating']=="null"){
		$_SESSION['rating_check']=$_GET['rating'];
		foreach ($_SESSION['kuva_taulu'] as $key => $nimi){
			if(getImageAttributeV($nimi, "ownRating")!=""){
				unset($_SESSION['kuva_taulu'][$key]);
			}
		}
	}
	if($_GET['rating']=="XXX"){
		$_SESSION['rating_check']=$_GET['rating'];
	}
}
?>

