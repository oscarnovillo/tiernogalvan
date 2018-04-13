var cont = 0;
var bule = false;
var aux;

function contador(){

	if(bule==false){
		aux = setInterval ("crono()", 1000);
		
	}
	if(bule==true){
    	clearInterval(aux);    
     	bule=false;
	}
}

function crono(){
	cont++;
	document.getElementById("cvisitas").innerHTML = cont;
	bule= true;
}
