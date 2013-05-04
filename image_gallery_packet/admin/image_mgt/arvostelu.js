/*
Author: Addam M. Driver
Date: 10/31/2006
*/

var sMax;	// Isthe maximum number of stars
var holder; // Is the holding pattern for clicked state
var preSet; // Is the PreSet value onces a selection has been made
var rated;

// Rollover for image Stars //
function rating(num){
	sMax = 0;	// Isthe maximum number of stars
	for(n=0; n<num.parentNode.childNodes.length; n++){ //kattoo kuinka monta tahtea on maaritelty, sMAX
		if(num.parentNode.childNodes[n].nodeName == "A"){
			sMax++;	
		}
	}
	
	if(!rated){
		s = num.id.replace("_", ''); // Get the selected star
		a = 0;
		for(i=1; i<=sMax; i++){		//luuppaa tahtien maaraan asti
			if(i<=s){				//kaikki tahdet ennen "valittua" laiteaan "on"
				document.getElementById("_"+i).className = "on";
				document.getElementById("rateStatus").innerHTML = num.title;	
				holder = a+1;
				a++;
			}else{
				document.getElementById("_"+i).className = ""; //ne jotka on valitun jalkeen on vain "" eli harmaita
			}
		}
	}
}

// For when you roll out of the the whole thing //
function off(me){
	if(!rated){
		if(!preSet){
			for(i=1; i<=sMax; i++){		
				document.getElementById("_"+i).className = "";
				document.getElementById("rateStatus").innerHTML = me.parentNode.title;
			}
		 }
		else{
			rating(preSet);
			//document.getElementById("rateStatus").innerHTML = document.getElementById("ratingSaved").innerHTML;
		}
	}
}

// When you actually rate something //
function rateIt(me){
	if(!rated){
		//document.getElementById("rateStatus").innerHTML = document.getElementById("ratingSaved").innerHTML + " :: "+me.title;
		document.getElementById("rateStatus").innerHTML = me.title;
		//preSet = me; //laitetaan valittu id
		//rated=1;	//laittaa arvoksi 1, niin ei enaa voi uudestaan tehda
		//sendRate(me); //kutsuu vain alert-funktiota
		rating(me);		//kutsuu rating, jotta tahdet saadaan piirrettya
		sendIT('arvosana',me);
	}
}

// Send the rating information somewhere using Ajax or something like that.
function sendRate(sel){
	//alert("Your rating was: "+sel.title);
	alert("Your rating was: "+sel);
}
function sendIT() {
    // Luodaan uusi lomake
    lomake = document.createElement("form");
    lomake.action = "detailed_vertailu.php";
    // asetetaan metodiksi POST
    lomake.method = "post";
    // Käydään läpi funktion parametrit
    if (sendIT.arguments.length) {
        for (i = 0; i < sendIT.arguments.length; i += 2) {
            // Luodaan uusi kenttä
            kentta = document.createElement("input");
            // Piilotetaan kenttä
            kentta.type = "hidden";
            // Asetetaan kentälle nimi
            kentta.name = sendIT.arguments[i];
            //kentta.name = "arvosana";
            // Asetetaan kentälle arvo
            kentta.value = sendIT.arguments[i + 1].title;
            //kentta.value = "poo";
            // Liitetään kenttä lomakkeeseen
            lomake.appendChild(kentta);
        }
    }
    // Liitetään lomake sivuun
    document.body.appendChild(lomake);
    // Lähetetään lomake
    lomake.submit();
} 
