
function reset()
{
	
	createCookie("distance", totalDistance , "10");
	createCookie("time", document.getElementById("display").innerHTML , "10");
	createCookie("calories", kcal , "10"); 

	
    totalDistance=0;//distance
    if (sw.timer != null) { sw.stop(); }
    sw.now = -1;
    sw.tick();
	
	
	
							
    document.getElementById("distance").innerHTML="0";
    kcal=0;//calories 
    document.getElementById("calories").innerHTML="0";
    document.getElementById("speed").innerHTML="0";
	

}
function addToDatabase()
{

}
function createCookie(name, value, days) { //this function is used for the cookies to send varibles to PHP
        var expires; 
      
        if (days) { 
            var date = new Date(); 
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
            expires = "; expires=" + date.toGMTString(); 
        } 
        else { 
            expires = ""; 
        } 
     
        document.cookie = escape(name) + "=" +  
        escape(value) + expires + "; path=/"; 
}