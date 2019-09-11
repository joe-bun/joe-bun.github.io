$(document).ready(function ()
{
    if (jQuery.browser.mobile) {
        document.getElementById("DeviceClientSide").innerHTML = "Mobile";
        document.getElementById("Device").innerHTML = "Mobile";
    } else {
        document.getElementById("DeviceClientSide").innerHTML = "Desktop";
        document.getElementById("Device").innerHTML = "Desktop";
    }
    document.getElementById("HeightPage").innerHTML = $(document).height();
    document.getElementById("HeightScreen").innerHTML = window.screen.height;
    document.getElementById("HeightViewPort").innerHTML = $(window).height();
    
    document.getElementById("WidthPage").innerHTML = $(document).width();
    document.getElementById("WidthScreen").innerHTML = window.screen.width;
    document.getElementById("WidthViewPort").innerHTML = $(window).width();
});