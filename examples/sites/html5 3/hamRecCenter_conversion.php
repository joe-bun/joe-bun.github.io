<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>



    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">Comp10133: Lab 3 Hamilton Region Recreation Center Geo-map</h1>
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">

                <article>
                    <div id="Buttons"></div><br>
                    <div id="map"></div><br>
                    <div id="JSON"></div>
                    <pre id="JSONinfo"></pre>
                </article>

            </div> <!-- #main -->
        </div> <!-- #main-container -->
        <div class="footer-container">
            <footer class="wrapper">
                <h1>Comp10133: Lab 3 Hamilton Region Recreation Center Geo-map</h1>
            </footer>
        </div>

        <?php
        $file = fopen("hamRecCenter.csv", "r");

        $n = 0;
        while (!feof($file)) {
            $line = fgetcsv($file);
            $data[$n] = $line;
            $n++;
        }

        fclose($file);

        $newData = [];
        for ($no = 0; $no < 39; $no = $no + 2) {
            $newLine = array_merge($data[$no], $data[$no + 1]);
            array_push($newData, $newLine);
        }

        for ($no = 0; $no < 20; $no++) {
            $addr = str_replace(' ', '+', $newData[$no][1] . " " . $newData[$no][2]);
            $xmlDoc = file_get_contents("http://maps.googleapis.com/maps/api/geocode/xml?address={$addr}&sensor=false");

            $xmlObj = new SimpleXMLElement($xmlDoc);

            $long = $xmlObj->result->geometry->location->lng->__toString();
            $lat = (string) $xmlObj->result->geometry->location->lat;
            array_push($newData[$no], $lat, $long);
            sleep(1.2);
        }
        $Array = [];
        for ($no = 0; $no < 20; $no++) {
            $Array[$no]["name"] = $newData[$no][0];
            $Array[$no]["address"] = $newData[$no][1];
            $Array[$no]["city"] = $newData[$no][2];
            $Array[$no]["phone"] = $newData[$no][4];
            $Array[$no]["latitude"] = $newData[$no][6];
            $Array[$no]["longitude"] = $newData[$no][7];
        }
        $myPropertyMapString = json_encode($Array);
//        file_put_contents("listRecCenter.js", $myPropertyMapString);
//        echo "<script src='listRecCenter.json'></script>";
        ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>');</script>
        <script src="js/plugins.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqGjPCdZ50q-KCSoV1aWSwbVRIHtSDs_4"></script>
        <script src="js/gmaps.js"></script>
        <script src="js/main.js"></script>
        <script>
            $("#JSONinfo").hide();
            var listRecCenters = <?= $myPropertyMapString; ?>;

            map = new GMaps({div: '#map', lat: 43.2724181, lng: -79.8562665});

            for (var no = 0; no < 20; no++) {
                latitude = listRecCenters[no].latitude;
                longitude = listRecCenters[no].longitude;
                info = "<div>" + listRecCenters[no].name + "<br>" + listRecCenters[no].address + "<br>" + listRecCenters[no].city + " " + listRecCenters[no].phone + " </div>";
                map.addMarker({lat: latitude, lng: longitude, infoWindow: {content: info}, title: listRecCenters[no].name});
            }
            

            
            $("#JSONinfo").html(JSON.stringify(listRecCenters, null, '\t'));
            var btn = document.createElement("BUTTON");
            var t = document.createTextNode("Show JSON Data");
            btn.appendChild(t);
            btn.setAttribute("id", "ShowJSON");
            document.getElementById("JSON").appendChild(btn);
            $("#ShowJSON").click(function () {
                $("#JSONinfo").toggle();
            });
            
            
        </script>
    </body>
</html>
