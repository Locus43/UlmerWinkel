var xhttp = new XMLHttpRequest();
//var jsonResponse = JSON.parse(xhttp).version;
var jsonResponse = xhttp.responseText;
const error = "Error 505"; 
xhttp.onreadystatechange = _ => {
	"use strict"; 
	//document.getElementById('version').innerHTML = xhttp.responseText;
	console.log(xhttp.response); 
	document.getElementById('version').innderHTML = JSON.parse(xhttp.response).version;
	//console.log(xhttp.responseText);
    if (this.readyState === 4 && this.status === 200) {
		console.log('sdfsdf');
	document.getElementById("version").innerHTML = jsonResponse;	 
    }/*else{
		document.getElementById("version").innerHTML = error; 
	}*/
};
xhttp.open("GET", "https://5b5c3771c1629.prepaiddomain.de/info/info.json", true);
xhttp.send(); 
