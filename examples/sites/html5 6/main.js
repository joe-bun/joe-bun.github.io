watchID = null;
countMe = 0;

$(document).ready(function () {
    document.getElementsByClassName("media-list").style.display = "none";
    document.getElementById("info").innerHTML = "<h3>Finding your location...</h3>";
    navigator.geolocation.getCurrentPosition(success);
    function success(position) {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
    }
    document.getElementById("info").innerHTML = "<h3>Finding restraurants near you...</h3>";
    $.ajax({url: ' https://csunix.mohawkcollege.ca/tooltime/10133/2017/api/api.php',
        data: {lat: latitude, long: longitude},
        type: 'get',
        success: function (results) {
            document.getElementById("info").innerHTML = "<h3>Found these restaurants...</h3>";
            document.getElementByClassName("media-list").style.display = "block";
            for (var i = 0; i < results.total; i++) {
                var li = document.createElement("li");
                li.addClass("media");
                var htmlString = "<div class='media-left'><img class='media-object' src=" + results.businesses.image_url + " alt=" + results.businesses.name + "></div><div class='media-body'><h4 class='media-heading'>" + results.businesses.name + "</h4>" + results.businesses.categories + "\n" + results.businesses.location.display_address + "\n" + results.businesses.display_phone + "\n" + results.businesses.rating_img_url + "  " + results.businesses.review_count + "</div>";
                li.innerHTML = htmlString;
            }
            document.getElementsByClassName("media-list").appendChild = li;
        }
    });
    //startWatch();
});


//function startWatch() {
//    var options = {frequency: 100};
//    watchID = navigator.accelerometer.watchAcceleration(onSuccess, onError, options);
//}
//
//function stopWatch() {
//    if (watchID) {
//        navigator.accelerometer.clearWatch(watchID);
//        countMe = 0;
//        watchID = null;
//    }
//}
//
//function onSuccess(acceleration) {
//
//    _x = roundNumber(acceleration.x, 3);
//    _y = roundNumber(acceleration.y, 3);
//    _z = roundNumber(acceleration.z, 3);
//
//
//    $('#x').text(_x);
//    $('#y').text(_y);
//    $('#z').text(_z);
//    $('#t').text(countMe++);
//
//    var left = 100 + (_y * 100)
//    var top = 100 + (_x * 100);
//
//    $("#footBall").css({'top': top, 'left': left})
//
//
//}
////rounds number to number of decimal places 
//function roundNumber(number, decimalplaces) {
//    return  Math.round(number * Math.pow(10, decimalplaces)) / Math.pow(10, decimalplaces);
//}
//
//// onError: Failed to get the acceleration
////
//function onError() {
//    $('#messages').text('OnError has happened...').css('color', 'red');
//}

	