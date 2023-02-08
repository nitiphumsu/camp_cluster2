<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <title>Routing Map Sample | Longdo Map</title>
    <style type="text/css">
        html {
            height: 100%;
        }

        body {
            margin: 0px;
            height: 100%;
        }

        #map {
            height: 100%;
            width: 100%;
            height: 400px;
        }

        #result {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            width: 1px;
            height: 80%;
            margin: auto;
            border: 4px solid #dddddd;
            background: #ffffff;
            overflow: auto;
            z-index: 2;
        }
    </style>

    <script type="text/javascript" src="https://api.longdo.com/map/?key=52fcc42705dc40fa0570714dd8e957a5"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    <script>
        function init() {
            map = new longdo.Map({
                placeholder: document.getElementById('map')
            });
            map.Route.placeholder(document.getElementById('result'));
            map.Route.add({
                lon: 100,
                lat: 15
            });
            map.Route.add({
                lon: 100,
                lat: 18
            });
            map.Route.search();
        }

        map.Search.placeholder(document.getElementById('search'));

        search = document.getElementById('search');

        //When user press an Enter button #search
        search.onkeyup = function(event) {
            if ((event || window.event).keyCode != 13)
                return;
            doSearch();
        }
    </script>
</head>

<body onload="init();">
    <!-- <div id="map"></div>
    <div id="result"></div>


    <script>
        let $varr = $('#result').html();
        console.log($varr);
        console.log("wooo");
    </script>

    <div id="result2"></div> -->
    search<input type="text" id="search">
    <input type="submit" value="Search" onclick="get_long()"></input>

    <script>
        function get_long() {
            let location = $("#search").val();
            $("#searchshow").html(" ");
            let numcount = 1;

            for (let area = 10; area <= 96; area++) {
                console.log("--------------------------------arear" + area);
                $.ajax({
                    dataType: "JSON",
                    method: "GET",
                    url: "https://search.longdo.com/mapsearch/json/search?keyword=" + location + "&area=" + area + "&span=5000km&limit=5000&key=52fcc42705dc40fa0570714dd8e957a5",
                }).done(function(latlon) {
                    console.log(latlon);
                    // console.log(Object.keys(latlon));
                    for (let i = 0; i < Object.keys(latlon).length; i++) {
                        console.log(i);
                    }
                    // console.log(JSON.stringify(latlon.data));
                    // let op = JSON.stringify(latlon.data);
                    let op = latlon.data;
                    // let ok = JSON.stringify(op);
                    // console.log(ok);
                    // console.log(Object.keys(op));
                    // for(let i = 0; i < Object.keys(op).length; i++){
                    //     console.log(op.name[0]);
                    // }
                    // $("#searchshow").html(JSON.stringify(latlon.data));
                    console.log(op);


                    for (let i = 0; i < Object.keys(op).length - 1; i++) {
                        // console.log(op[i].name);
                        if (op[i].type == "poi" || op[i].type == "khet") {
                            $("#searchshow").append("ลำดับที่ : " + numcount + " ชื่อ : " + op[i].name + " ที่อยู่ : " + op[i].address + "<br>");
                            numcount++;
                        }
                    }
                });
            }
        }
    </script>

    <br>
    <div style="overflow:scroll; width:800px;height:800px; border-color:red;" id="searchshow">
    </div>

</body>

</html>