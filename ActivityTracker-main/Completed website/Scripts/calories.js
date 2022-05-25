//checking if the browser or phone supports geolocation
if(navigator.geolocation){console.log('Geolocation Avaliable');}
else{console.log('Geolocation Error - Not Supported!')}
var activeDist=false;
var totalDistance = 0;
var kcal = 0;
var prekcal=0;
var m=0;

//when the page loads find the starting position of the person
window.onload = function()
{
    var startPos;
    var lastLat;
    var lastLong;
    
    
    navigator.geolocation.getCurrentPosition
    (
        function(position)
        {
            startPos=position;
                },
                //error handling
                function(error){
                    alert('errorOccurred error code:'+error.code)
                    //   0: unknown error
                    //   1: permission denied
                    //   2: position unavailable (error response from locaton provider)
                }
    )

    
            navigator.geolocation.watchPosition(
            function(position)
            {
                if(activeDist == true)
                {
                
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var accuracy = position.coords.accuracy;
                    var timestamp = position.timestamp;
                    // Document.getElementById("latitude"). innerHTML = 'latitude:' +latitude;
                    // Document.getElementById("longitude"). innerHTML =' longitude:' +longitude;
                    // Document.getElementById("accuracy"). innerHTML = 'Accuracy:' +accuracy;
                    // Document.getElementById("timestamp"). innerHTML = 'timestamp:' +timestamp;
                    if(accuracy >= 30000) {
                    updateStatus("Need more accurate values to calculate distance.");
                    return;
                    }
                    if((lastLat != null) && (lastLong != null)) {
                    var currentDistance = distance(latitude, longitude, lastLat, lastLong);
                    // document.getElementById("speed").innerHTML = currentDistance.toFixed(2) + "km";
                    totalDistance = totalDistance+currentDistance;
                    document.getElementById("distance").innerHTML = Math.round(totalDistance*10)/10;
                    }
                    lastLat = latitude;
                    lastLong = longitude;
                    totalCalsBurned();
                    document.getElementById("calories").innerHTML=kcal;
                    //console.log(outHours + ":" + outMins + ":" + outSecs);
                    
                }
                else if(activeDist==false)
                {
                    console.log("not enabled distance tracking")
                }   

            })
        
   
    

}

function totalCalsBurned()
{
	var spanVal = document.getElementById('display').innerHTML;
    var splitSpanVal = spanVal.split(":");
    //[0]=hours:[1]=minutes:[2]=seconds
    var hour= (parseInt(splitSpanVal[0]))*60;
    var minute= parseInt(splitSpanVal[1]);
    var second= (parseInt(splitSpanVal[2]))/60;
    
    var finalMins=hour+minute+second;
		
    finalMins;
    console.log(finalMins);
    kcal = (Math.round(getMetByUnknownSpeed(outSpeed) * 3.5 * (75) / 200 * finalMins));
    
    
}

function getMetByUnknownSpeed(speed){
	
	var met =-1;

	switch (speed){
		case 4: //speed_4
			met=6;
			break;
		case 5: //speed_5
			met=8.3;
			break;
		case 5.5: //speed_5_2
			met=9;
			break;
		case 6: //speed_6
			met=9.8;
			break;
		case 6.5: //speed_6_7
			met=10.5;
			break;
		case 7: //speed_7
			met=11;
			break;
		case 7.5: //speed_7_5
			met=11.4;
			break;
		case 8: //speed_8
			met=11.8;
			break;
		case 8.5: //speed_8_6
			met=12.3;
			break;
		case 9: //speed_9
			met=12.8;
			break;
		case 10: //speed_10
			met=14.5;
			break;
		case 11: //speed_11
			met=16;
			break;
		case 12: //speed_12
			met=19;
			break;
		case 13: //speed_13
			met=19.8;
			break;
		default : //speed_14
			met=23;
			break;
	}
	 return met;
}


Number.prototype.toRadians = function() {
    return this * Math.PI / 180;
   }
function distance(latitude1, longitude1, latitude2, longitude2) {
    var R = 6371;
    var deltaLatitude = (latitude2 - latitude1).toRadians();
    var deltaLongitude = (longitude2 - longitude1).toRadians();
    latitude1 = latitude1.toRadians(), latitude2 = latitude2.toRadians();
    var a = Math.sin(deltaLatitude / 2) * Math.sin(deltaLatitude / 2) + Math.cos(latitude1) * Math.cos(latitude2) * Math.sin(deltaLongitude / 2) * Math.sin(deltaLongitude / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
   }