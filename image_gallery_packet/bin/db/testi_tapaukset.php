<?php
include ('db_functions.php');

//Listaa kaikki atribuutit
echo "\n"."*** Testataan listAllAttributes ***"."\n";
//haetaan kaikki kuvien attribuutit
$koe=listAllAttributes();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//Listaa kaikki kuvat
echo "\n"."*** Testataan listAllImages ***"."\n";
//haetaan kaikki kuvien attribuutit
$koe=listAllImages();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//Lisaa attribuutti (kuva)
$atr="testi_attribuutti";
echo "\n"."*** Lisätään kuva-attribuutti:".$atr." ***"."\n";
addAttribute($atr);
echo "*** Tulostetaan kaikki attribuutit ja tarkistetaan että atr on siina ****"."\n";
$koe=listAllAttributes();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//Hae attribuutin id
$atr="testi_attribuutti";
echo "\n"."*** Haetaan seuraavan attribuutin id:".$atr." ***"."\n";
$num=getAttributeID($atr);
echo "ID on: ".$num;

//Lisaa kuva
$img="imgXXX.jpg";
echo "\n"."*** Lisätään kuva:".$img." ***"."\n";
addImage($img);
echo "*** Tulostetaan kaikki kuvat ja tarkistetaan että img on siina ****"."\n";
$koe=listAllImages();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//Hae kuvan id
$img="imgXXX.jpg";
echo "\n"."*** Haetaan seuraavan kuvan id:".$img." ***"."\n";
$num=getImageID($img);
echo "ID on: ".$num;

//lisaa kuvan attribuutille arvo
$atr="testi_attribuutti";
$img="imgXXX.jpg";
$value="Jotain kamaa ja paljon, huahahhaah";
echo "\n"."*** Lisätään kuvan attribuutille arvo Kuva: ".$img." Attribuutti: ".$atr." Arvo: ".$value."***"."\n";
addImageAttributeV($img,$atr,$value);


//Listataan kaikki kuvan attribuuttien arvot
$img="imgXXX.jpg";
echo "*** Tulostetaan kaikki kuvalle asetetut attribuutit ****"."\n";
$koe=listAllImageAttributes($img);
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//haetaan attribuutin arvo
$atr="testi_attribuutti";
$img="imgXXX.jpg";
echo "\n"."\n"."*** Haetaan kuvan attribuutin arvo Kuva: ".$img." Attribuutti: ".$atr." ***"."\n";
$arvo=getImageAttributeV($img, $atr);
echo $arvo;

//listataan kaikki albumit
echo "\n"."\n"."*** Listataan listAllAlbums ***"."\n";
//haetaan kaikki kuvien attribuutit
$koe=listAllAlbums();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//lisataan albumi
$alb="Koe_albumi";
echo "\n"."*** Lisätään Albumi:".$alb." ***"."\n";
addAlbum($alb);
echo "*** Tulostetaan kaikki Albumit ja tarkistetaan että alb on siina ****"."\n";
$koe=listAllAlbums();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//lisataan albumi-attribuutti & listataan kaikki albumi atr:t
$atr="testi_albumi_attribuutti";
echo "\n"."*** Lisätään albumi-attribuutti:".$atr." ***"."\n";
addAlbumAttribute($atr);
echo "*** Tulostetaan kaikki attribuutit ja tarkistetaan että atr on siina ****"."\n";
$koe=listAllAlbumAttributes();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//lisataan kuva albumiin ja tulostetaan kaikki albumin kuvat
$img="imgXXX.jpg";
$alb="Koe_albumi";
echo "\n"."*** Lisätään kuva:".$img." albumiin: ".$alb."***"."\n";
addImageToAlbum($img,$alb);
echo "*** Tulostetaan kaikki kuvat albumissa ja tarkistetaan että img on siina ****"."\n";
$koe=listAllImagesInAlbum($alb);
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}


// TAsta alkaa poistot, huom jarjestyksella on valia
echo "\n"."************************************************"."\n";
echo "******** Tasta alkaa poistot********************"."\n";
echo "************************************************"."\n";


//poistetaan kuva albumista
$img="imgXXX.jpg";
$alb="Koe_albumi";
echo "\n"."\n"."*** Poistetaan kuva:".$img." albumista: ".$alb."***"."\n";
delImageFromAlbum($img,$alb);
echo "*** Tulostetaan kaikki kuvat albumissa ja tarkistetaan että img ei ole siina ****"."\n";
$koe=listAllImagesInAlbum($alb);
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//poistetaan albumi attribuutti
$atr="testi_albumi_attribuutti";
echo "\n"."*** Poistetaan albumi-attribuutti:".$atr." ***"."\n";
delAlbumAttribute($atr);
echo "*** Tulostetaan kaikki attribuutit ja tarkistetaan että atr ei ole siina ****"."\n";
$koe=listAllAlbumAttributes();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//poistetaan albumi
$alb="Koe_albumi";
echo "\n"."*** Lisätään Albumi:".$alb." ***"."\n";
delAlbum($alb);
echo "*** Tulostetaan kaikki Albumit ja tarkistetaan että alb ei ole siina ****"."\n";
$koe=listAllAlbums();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//Poistetaan kuvan attribuutin arvo
$atr="testi_attribuutti";
$img="imgXXX.jpg";
echo "\n"."\n"."*** Poistetaan kuvan attribuutin arvo Kuva: ".$img." Attribuutti: ".$atr." ***"."\n";
delImageAttributeV($img,$atr);

//Poista attribuutti (kuva)
$atr="testi_attribuutti";
echo "\n"."\n"."*** Poistetaan kuva-attribuutti:".$atr." ***"."\n";
delAttribute($atr);
echo "*** Tulostetaan kaikki attribuutit ja tarkistetaan että atr ei ole siina ****"."\n";
$koe=listAllAttributes();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}

//Poista kuva
$img="imgXXX.jpg";
echo "\n"."\n"."*** Poistetaan kuva:".$img." ***"."\n";
delImage($img);
echo "*** Tulostetaan kaikki kuvat ja tarkistetaan että img ei ole siina ****"."\n";
$koe=listAllImages();
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi."\n";
}


?>