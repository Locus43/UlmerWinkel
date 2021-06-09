loadJson('https://5b5c3771c1629.prepaiddomain.de/info/info.json', function(text){
	var data=JSON.parse(text); 
	console.log(data); 
}); 