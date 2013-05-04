<?php
if(!isset($conn)){
$conn=false;
}

//tietokannan avaus funktio
function open_db(){
	global $conn;
	
	if ($conn){
		return $conn;}
					
		include ('dbconfig.php');
		$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');
		mysql_select_db($dbname);
		return $conn;
	
}
function validateSQL($string, $conn){
	return mysql_real_escape_string($string, $conn);
}

//kuva-attribuutti-funktiot alkaa tasta (Attribuuttien hallinta)
function listAllAttributes(){
$conn=open_db();
$query  = "SELECT nimi from Attribuutit";
$result = mysql_query($query, $conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
         
}
return $table;	
}
function addAttribute($atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name, $conn);
//tarkistetaan onko jo kannassa
$query  = 'select nimi from Attribuutit where nimi="'.$atr_name.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//jos ei ole kannassa niin sitten lisataan
if($num==0){
$query  = 'INSERT INTO Attribuutit VALUES (null,"'.$atr_name.'",null, null, null)';
mysql_query($query, $conn);
}
}

function delAttribute($atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
$query  = 'delete from Attribuutit where nimi="'.$atr_name.'"';
mysql_query($query, $conn);
}

function getAttributeID($atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
$query  = 'select id from Attribuutit where nimi="'.$atr_name.'"';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$id=$row[0];
return $id;
	
}

//KUVA-funktiot alkaa tasta (kuvien hallinta)
function listAllImages(){
$conn=open_db();
$query  = "SELECT nimi from Kuva";
$result = mysql_query($query, $conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
         
}
return $table;	
}

function addImage($img_name){
$conn=open_db();
//tarkistetaan onko jo kannassa
$img_name=validateSQL($img_name,$conn);
$query  = 'select nimi from Kuva where nimi="'.$img_name.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//jos ei ole kannassa niin sitten lisataan
if($num==0){
$query  = 'INSERT INTO Kuva VALUES (null,"'.$img_name.'",null,null)';
mysql_query($query, $conn);
}
}

function delImage($img_name){
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$query  = 'delete from Kuva where nimi="'.$img_name.'"';
mysql_query($query, $conn);
//mysql_close();
}
//funktiossa on jotain mataa ei toiminut aikaisemmin, jaahylla

/*function delOwnImage($img_name, $owner){
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$owner=validateSQL($owner,$conn);
$query  = 'delete Kuva from Kuva inner join Arvot on Kuva.id=Arvot.kuva inner join Attribuutit on Attribuutit.id=Arvot.attribuutti where Attribuutit.nimi="owner" and Arvot.arvo="'.$owner.'" and Kuva.nimi"'.$img_name.'"';
mysql_query($query, $conn);
mysql_close();
}*/

function getImageID($img_name){
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$query  = 'select id from Kuva where nimi="'.$img_name.'"';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$id=$row[0];
return $id;
	
}

//Kuvien attribuuttien hallintafunktiot alkaa tasta
function listAllImageAttributes($img_name){
//alla olevaa voi kayttaa jos sql korjataan
//$id=getImageID($img_name);
$conn=open_db();
//alla ei ole kiva sql-lause... korjaa, tulee suorituskykyongelmia
$img_name=validateSQL($img_name,$conn);
$query  = 'select Attribuutit.nimi from Kuva inner join Arvot on Kuva.id=Arvot.kuva inner join Attribuutit on Arvot.attribuutti=Attribuutit.id where Kuva.nimi="'.$img_name.'"';
$result = mysql_query($query, $conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi'];
    
         
}
return $table;	
}

function listAllImageAttributesByLevel($img_name, $level){
//alla olevaa voi kayttaa jos sql korjataan
//$id=getImageID($img_name);
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$level=intval($level);
//alla ei ole kiva sql-lause... korjaa, tulee suorituskykyongelmia
$query  = 'select Attribuutit.nimi from Kuva inner join Arvot on Kuva.id=Arvot.kuva inner join Attribuutit on Arvot.attribuutti=Attribuutit.id where Kuva.nimi="'.$img_name.'" and Attribuutit.meta_int="'.$level.'"';
$result = mysql_query($query, $conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi'];
    
         
}
return $table;	
}

function addImageAttributeV($img_name,$atr_name,$value){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
$img_name=validateSQL($img_name,$conn);
$value=validateSQL($value,$conn);
$id=getImageID($img_name);
$atr_id=getAttributeID($atr_name);

//saisiko olla kuitenkin monta arvoa
$query  = 'select attribuutti from Arvot where attribuutti="'.$atr_id.'" and kuva="'.$id.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//laitetaan vain jos ei ole jo arvoa sidottu (pitaa miettia), muuten paivitetaan
if($num==0){
$query  = 'insert into Arvot values (null,"'.$value.'","'.$atr_id.'","'.$id.'",null, null, null, null, null, null)';
mysql_query($query, $conn);
}
if($num==1){
$query = 'update Arvot set arvo="'.$value.'" where attribuutti="'.$atr_id.'" and kuva="'.$id.'"';
mysql_query($query, $conn);		
}
}

function delImageAttributeV($img_name,$atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
$img_name=validateSQL($img_name,$conn);
$id=getImageID($img_name);
$atr_id=getAttributeID($atr_name);

$query  = 'delete from Arvot where attribuutti="'.$atr_id.'" and kuva="'.$id.'"';
mysql_query($query, $conn);
}


function getImageAttributeV($img_name, $atr_name){
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$atr_name=validateSQL($atr_name,$conn);
$query  = 'select Arvot.arvo from Kuva inner join Arvot on Kuva.id=Arvot.kuva inner join Attribuutit on Arvot.attribuutti=Attribuutit.id where Attribuutit.nimi="'.$atr_name.'" and Kuva.nimi="'.$img_name.'"';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$arvo=$row[0];
return $arvo;
	
}

//Tasta alkaa albumi-funktiot
function listAllAlbums(){
$conn=open_db();
$query  = "SELECT nimi from Albumi";
$result = mysql_query($query, $conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
         
}
if(isset($table)){
return $table;		
}
}

function listAllAlbumAttributes(){
$conn=open_db();
$query  = "SELECT nimi from Albumi_atr";
$result = mysql_query($query, $conn);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
         
}
return $table;		
}	

function listAllImagesInAlbum($alb_name){
$conn=open_db();
$alb_name=validateSQL($alb_name,$conn);
$alb_id=getAlbumID($alb_name);
$kuva_atr="kuva";
$alb_atr_id=getAlbumAttributeID($kuva_atr);
$query  = 'select Kuva.nimi from Album_meta inner join Kuva on Album_meta.kuva=Kuva.id where albumi_atr="'.$alb_atr_id.'" and albumi="'.$alb_id.'"';
$result = mysql_query($query, $conn);
$num=mysql_num_rows($result);
if(!$num==0){
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
         
}
return $table;
}
else{
	$table[]="";
	return $table;
}
			
}

function addAlbum($alb_name){
$conn=open_db();
$alb_name=validateSQL($alb_name,$conn);
//tarkistetaan onko jo kannassa
$query  = 'select nimi from Albumi where nimi="'.$alb_name.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//jos ei ole kannassa niin sitten lisataan
if($num==0){
$query  = 'INSERT INTO Albumi VALUES (null,"'.$alb_name.'",null,null)';
mysql_query($query, $conn);
}	
}

function delAlbum($alb_name){
$conn=open_db();
$alb_name=validateSQL($alb_name,$conn);
$query  = 'delete from Albumi where nimi="'.$alb_name.'"';
mysql_query($query, $conn);
}

function delOwnAlbum($alb_name, $owner){
$conn=open_db();
$atr_name="owner";
$alb_name=validateSQL($alb_name,$conn);
$owner=validateSQL($owner,$conn);
$query  = 'delete Albumi from Albumi inner join Album_meta on Albumi.id=Album_meta.albumi inner join Albumi_atr on Album_meta.albumi_atr=Albumi_atr.id where Albumi_atr.nimi="'.$atr_name.'" and Albumi.nimi="'.$alb_name.'" and Album_meta.meta="'.$owner.'"';
mysql_query($query, $conn);
}


function addAlbumAttribute($atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
//tarkistetaan onko jo kannassa
$query  = 'select nimi from Albumi_atr where nimi="'.$atr_name.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//jos ei ole kannassa niin sitten lisataan
if($num==0){
$query  = 'INSERT INTO Albumi_atr VALUES (null,"'.$atr_name.'",null, null, null)';
mysql_query($query, $conn);
}	
}

function delAlbumAttribute($atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
$query  = 'delete from Albumi_atr where nimi="'.$atr_name.'"';
mysql_query($query, $conn);
}

function getAlbumID($alb_name){
$conn=open_db();
$alb_name=validateSQL($alb_name,$conn);
$query  = 'select id from Albumi where nimi="'.$alb_name.'"';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$id=$row[0];
return $id;		
}

function getAlbumNameByID($id){
$conn=open_db();
$id=intval($id);
$query  = 'select nimi from Albumi where id="'.$id.'"';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$id=$row[0];
return $id;		
}


function getAlbumAttributeID($atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
$query  = 'select id from Albumi_atr where nimi="'.$atr_name.'"';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$id=$row[0];
return $id;	
}

function getAlbumAttributeV($alb_name, $atr_name){
$conn=open_db();
$atr_name=validateSQL($atr_name,$conn);
$alb_name=validateSQL($alb_name,$conn);
$query  = 'select Album_meta.meta from Albumi inner join Album_meta on Albumi.id=Album_meta.albumi inner join Albumi_atr on Album_meta.albumi_atr=Albumi_atr.id where Albumi_atr.nimi="'.$atr_name.'" and Albumi.nimi="'.$alb_name.'" and Album_meta.kuva is NULL';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$id=$row[0];
return $id;	
}

function addAlbumAttributeV($alb_name,$atr_name, $value){
$conn=open_db();
$alb_name=validateSQL($alb_name,$conn);
$atr_name=validateSQL($atr_name,$conn);
$value=validateSQL($value,$conn);
//tarkistetaan onko jo kannassa
$query  = 'select Album_meta.meta from Albumi inner join Album_meta on Albumi.id=Album_meta.albumi inner join Albumi_atr on Album_meta.albumi_atr=Albumi_atr.id where Albumi_atr.nimi="'.$atr_name.'" and Albumi.nimi="'.$alb_name.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//jos ei ole kannassa niin sitten lisataan
if($num==0){
$atr_id=getAlbumAttributeID($atr_name);
$alb_id=getAlbumID($alb_name);
$query  = 'insert into Album_meta values (null, "'.$value.'",null,"'.$alb_id.'","'.$atr_id.'",null, null, null, null, null)';
mysql_query($query, $conn);
}	
if($num==1){
$query = 'update Album_meta inner join Albumi on Albumi.id=Album_meta.albumi inner join Albumi_atr on Albumi_atr.id=Album_meta.albumi_atr set Album_meta.meta="'.$value.'" where Albumi.nimi="'.$alb_name.'" and Albumi_atr.nimi="'.$atr_name.'"';
mysql_query($query, $conn);		
}
	
}

function addAlbumAttributeVToImage($alb_name,$atr_name, $img_name, $value){
$conn=open_db();
$alb_name=validateSQL($alb_name,$conn);
$atr_name=validateSQL($atr_name,$conn);
$value=validateSQL($value,$conn);
$img_name=validateSQL($img_name,$conn);

//tarkistetaan onko jo kannassa
$query  = 'select Album_meta.meta from Albumi inner join Album_meta on Albumi.id=Album_meta.albumi inner join Albumi_atr on Album_meta.albumi_atr=Albumi_atr.id where Albumi_atr.nimi="'.$atr_name.'" and Albumi.nimi="'.$alb_name.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//jos ei ole kannassa niin sitten lisataan
if($num==0){
$atr_id=getAlbumAttributeID($atr_name);
$alb_id=getAlbumID($alb_name);
$img_id=getImageID($img_name);
$query  = 'insert into Album_meta values (null, "'.$value.'","'.$img_id.'","'.$alb_id.'","'.$atr_id.'",null, null, null, null, null)';
mysql_query($query, $conn);
}		
}

function addImageToAlbum($img_name, $alb_name){
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$alb_name=validateSQL($alb_name,$conn);
$id=getImageID($img_name);
//varmistetaan etta albumi attribuuteissa on "kuva" joka on varattu kuville
$kuva_atr="kuva";
addAlbumAttribute($kuva_atr);
$alb_atr_id=getAlbumAttributeID($kuva_atr);
$alb_id=getAlbumID($alb_name);

//varmistetaan etta kuva ei ole jo albumissa
$query  = 'select Album_meta.kuva from Album_meta where kuva="'.$id.'" and albumi_atr="'.$alb_atr_id.'" and albumi="'.$alb_id.'"';
$result=mysql_query($query, $conn);
//palauttaa hakutuloksen rivien maaran
$num=mysql_num_rows($result);

//laitetaan vain jos ei ole jo arvoa sidottu (pitaa miettia)
if($num==0){
$query  = 'insert into Album_meta values (null, null, "'.$id.'","'.$alb_id.'","'.$alb_atr_id.'",null, null, null, null, null)';
mysql_query($query, $conn);
}
}

function delImageFromAlbum($img_name, $alb_name){
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$alb_name=validateSQL($alb_name,$conn);
$id=getImageID($img_name);
$alb_id=getAlbumID($alb_name);

$query  = 'delete from Album_meta where kuva="'.$id.'" and albumi="'.$alb_id.'"';
mysql_query($query, $conn);
}			

//special funktiot alkaa tasta
function listOwnImagesNotInAlbums($owner){
$conn=open_db();
$owner=validateSQL($owner,$conn);
$query  = 'select Kuva.nimi from Kuva left join Album_meta on Album_meta.kuva=Kuva.id inner join Arvot on Kuva.id=Arvot.kuva inner join Attribuutit on Attribuutit.id=Arvot.attribuutti where Album_meta.kuva is NULL and Attribuutit.nimi="owner" and Arvot.arvo="'.$owner.'"';
$result = mysql_query($query, $conn);
$num=mysql_num_rows($result);
if(!$num==0){
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
         
}
return $table;
}
else{
	$table[]="";
	return $table;
}
			
}

//pitaa tehda listAllOwnImages
function listAllOwnImages($owner){
$conn=open_db();
$owner=validateSQL($owner,$conn);
$query  = 'select Kuva.nimi from Kuva inner join Arvot on Kuva.id=Arvot.kuva inner join Attribuutit on Attribuutit.id=Arvot.attribuutti where Attribuutit.nimi="owner" and Arvot.arvo="'.$owner.'"';
$result = mysql_query($query, $conn);
$num=mysql_num_rows($result);
if(!$num==0){
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
         
}
return $table;
}
else{
	$table[]="";
	return $table;
}	
}

function listAllOwnAlbums($owner){
$conn=open_db();
$owner=validateSQL($owner,$conn);
$query  = 'select Albumi.nimi from Albumi inner join Album_meta on Album_meta.albumi=Albumi.id inner join Albumi_atr on Album_meta.albumi_atr=Albumi_atr.id where Albumi_atr.nimi="owner" and Album_meta.meta="'.$owner.'"';
$result = mysql_query($query, $conn);
$num=mysql_num_rows($result);
if(!$num==0){
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
 
}

}
if (isset($table)){
return $table;	
}
}

function addOwnAlbum($alb_name,$owner){
	$conn=open_db();
	$owner=validateSQL($owner,$conn);
	$alb_name=validateSQL($alb_name,$conn);
	$alb_atr="owner";
	addAlbum($alb_name);
	addAlbumAttribute($alb_atr);
	addAlbumAttributeV($alb_name,$alb_atr,$owner);
	
	
}

function listAlbumsWhereImageIs($img_name){
$conn=open_db();
$img_name=validateSQL($img_name,$conn);
$query  = 'select Albumi.nimi from Albumi inner join Album_meta on Album_meta.albumi=Albumi.id inner join Kuva on Kuva.id=Album_meta.kuva where Kuva.nimi="'.$img_name.'"';
$result = mysql_query($query, $conn);
$num=mysql_num_rows($result);
if(!$num==0){
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    $table[]=$row['nimi']; 
    }

}
if (isset($table)){
return $table;	
}
		
}

function isImageInAlbum($img_name, $alb_name){
$conn=open_db();

$img_name=validateSQL($img_name,$conn);
$alb_name=validateSQL($alb_name,$conn);
$query  = 'select Albumi.nimi from Albumi inner join Album_meta on Album_meta.albumi=Albumi.id inner join Kuva on Kuva.id=Album_meta.kuva where Kuva.nimi="'.$img_name.'" and Albumi.nimi="'.$alb_name.'"';
$result=mysql_query($query, $conn);
$num=mysql_num_rows($result);
if(!$num==0){
	return false;
}
return true;
}

function getRandomImageFromAlbum($alb_name){
$conn=open_db();
$alb_name=validateSQL($alb_name,$conn);
$query  = 'select Kuva.nimi from Kuva inner join Album_meta on Album_meta.kuva=Kuva.id inner join Albumi_atr on Albumi_atr.id=Album_meta.albumi_atr inner join Albumi on Albumi.id=Album_meta.albumi where Albumi.nimi="'.$alb_name.'" order by rand() limit 1';
$result=mysql_query($query, $conn);
$row=mysql_fetch_row($result);
$id=$row[0];
return $id;		
}

function addImageToWorkQueue($img_name, $dir, $owner){
$conn=open_db();
$atr_name=validateSQL($img_name, $conn);
$atr_name=validateSQL($dir, $conn);
//lisataan jonoon
$query  = 'INSERT INTO queue VALUES (null,"'.$img_name.'","'.$dir.'","'.$owner.'","0")';
mysql_query($query, $conn);

}

function getImageFromWorkQueue(){
	$conn=open_db();
//lisatty order
$query  = 'SELECT filename,dir,owner from queue where status="0" ORDER BY filename limit 1';
$result = mysql_query($query, $conn);
$row = mysql_fetch_row($result);
if($row[0]!="" && $row[1]!="" && $row[2]!=""){
$query='update queue set status="1" where filename="'.$row[0].'" and dir="'.$row[1].'" and owner="'.$row[2].'"';
mysql_query($query, $conn);	
}

return $row;
		
}

function delImageFromQueue($row){
$conn=open_db();
$query  = 'delete from queue where filename="'.$row[0].'" and dir="'.$row[1].'" and owner="'.$row[2].'" and status="1"';
mysql_query($query, $conn);
}

?>
