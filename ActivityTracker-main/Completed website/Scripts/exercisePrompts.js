
    var distance = document.getElementById("distanceSpan").innerHTML;
    var speed = document.getElementById("speedSpan").innerHTML;
    var calories = document.getElementById("caloriesSpan").innerHTML;
    console.log(distance);
    console.log(speed);
    console.log(calories);


    if(calories >= 700){
        document.getElementById("adviseSpan").innerHTML="Advise: Please Slow Down";
    }
    if(calories  <50){
        document.getElementById("adviseSpan").innerHTML="Advise: Increase Your Speed or Distance";
    }
    if(speed >= 12){
        document.getElementById("adviseSpan").innerHTML="Advise: Slow Donw";
    }
    if(speed <10){
        document.getElementById("adviseSpan").innerHTML="Advise: Run Faster";
    }
    
    if(distance >=45){
        document.getElementById("adviseSpan").innerHTML="Advise: Running Too Far";
    }
    if(distance <1){
        document.getElementById("adviseSpan").innerHTML="Advise: Run Further";
    }
