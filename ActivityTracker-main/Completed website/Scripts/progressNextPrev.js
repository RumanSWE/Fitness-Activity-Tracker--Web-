     $(document).ready(function () 
	 {
                var current = -1;
                $(".cycle").click(function () {
                    var timeArr = timeArray;
					var stampArr = stampArray;
					var disArr = disArray;
					var speedArr = speedArray;
					var calArr = caloriesArray;
					//var stampArr = stampArray;
                    if ($(this).attr("id") == "next") {
                        next(timeArr,stampArr,disArr,speedArr,calArr);
						
						
						
                } else {
                    prev(timeArr,stampArr,disArr,speedArr,calArr);
					
					
                }
            });

            function next(data,data1,data2,data3,data4) {
                if (current != len-1) {
                    $("#result").text("Time: " + data[++current]);
					$("#result1").text("Date Time: " + data1[current]);
					$("#result2").text("Distance(km): " + data2[current]);
					$("#result3").text("Average Speed(kph): " + data3[current]);
					$("#result4").text("Calories Burnt: " + data4[current]);
					
				
                }
            }

            function prev(data,data1,data2,data3,data4) {
                if (current >0) {
                    $("#result").text("Time: " + data[--current]);
					$("#result1").text("Date Time: " + data1[current]);
					$("#result2").text("Distance(km): " + data2[current]);
					$("#result3").text("Average Speed(kph): " + data3[current]);
					$("#result4").text("Calories Burnt: " + data4[current]);
					
                }
            }
            });