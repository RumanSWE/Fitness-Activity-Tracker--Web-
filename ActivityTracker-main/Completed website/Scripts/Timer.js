var expSecs;
var outHours;
var outMins;
var outSecs;
var sw = {
  // (A) INITIALIZE
  etime : null, // HTML time display
  erst : null, // HTML reset button
  ego : null, // HTML start/stop button
  init : function () {
    // (A1) GET HTML ELEMENTS
    sw.etime = document.getElementById("display");
    sw.erst = document.getElementById("buttonStop");
    sw.ego = document.getElementById("buttonPlay");

    // (A2) ENABLE BUTTON CONTROLS
    sw.erst.addEventListener("click", sw.reset);
    sw.erst.disabled = false;
    sw.ego.addEventListener("click", sw.start);
    sw.ego.disabled = false;
  },

  // (B) TIMER ACTION
  timer : null, // timer object
  now : 0, // current elapsed time
  tick : function () {
    // (B1) CALCULATE HOURS, MINS, SECONDS
    sw.now++;
    var remain = sw.now;
    var hours = Math.floor(remain / 3600);
    remain -= hours * 3600;
    var mins = Math.floor(remain / 60);
    remain -= mins * 60;
    var secs = remain;
    expSecs = sw.now;
    // (B2) UPDATE THE DISPLAY TIMER
    if (hours<10) { hours = "0" + hours; }
    if (mins<10) { mins = "0" + mins; }
    if (secs<10) { secs = "0" + secs; }
    sw.etime.innerHTML = hours + ":" + mins + ":" + secs;
    
    outHours=hours;
    outMins=mins;
    outSecs=secs;
    
  },
  
  // (C) START!
  start : function () {
    sw.timer = setInterval(sw.tick, 1000);
    document.getElementById("playButton").src = "Assets/Images/pauseImg.svg"
    sw.ego.removeEventListener("click", sw.start);
    sw.ego.addEventListener("click", sw.stop);
    geolocation.setTracking(true);
    activeDist == true;
  },

  // (D) STOP
  stop  : function () {
    clearInterval(sw.timer);
    sw.timer = null;
    document.getElementById("playButton").src = "Assets/Images/playImg.svg"
    sw.ego.removeEventListener("click", sw.stop);
    sw.ego.addEventListener("click", sw.start);
    geolocation.setTracking(false);
    activeDist = false;
  },

  // (E) RESET
  reset : function () {
    if (sw.timer != null) { sw.stop(); }
    sw.now = -1;
    sw.tick();
    document.getElementById("track").checked = false;
  }
};
window.addEventListener("load", sw.init);