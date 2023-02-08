<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ขอเบิกค่าเดินทาง</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . '/css/style.css' ?>">
    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Api map -->
    <script type="text/javascript" src="https://api.longdo.com/map/?key=ce7bc6077f0a777cce3ddba8c386042e"></script>
    <!-- script sidebar -->
    <script type="text/javascript" src="<?php echo base_url() . '/js/sidebar.js' ?>"></script>
    <!-- script map -->
    <script type="text/javascript" src="<?php echo base_url() . '/js/map.js' ?>"></script>
    <!-- script notification -->
    <script type="text/javascript" src="<?php echo base_url() . '/js/notification.js' ?>"></script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        #map {
            height: 800px;
            width: 100%px;
            position: relative;

        }

        .box-fix-detail {
            position: absolute;
            top: 50px;
            right: 50px;
            overflow: auto;
            height: 300px;
            width: 400px;
        }

        #seearch_box {
            color: black;
            background: whitesmoke;
            padding: 1.5px;
        }

        #overflow {
            /* width: 0px; */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            /* display: inline-block; */
        }

        #search_target1,
        #search_target2 {}

        #search_show1,
        #search_show2 {
            width: 280px;
            height: 170px;
            margin: 20px;
            overflow: scroll;
            background-color: #eff5f5;
            border-color: black;
            border-radius: 10px;
        }

        #search_box {
            position: absolute;
            background-color: #fff;
            width: 350px;
            height: 580px;
            margin-top: 50px;
            margin-left: 60px;
            padding: 10px;
            border-radius: 20px;
        }

        #selectmap {
            padding: 10px;

        }
    </style>

    <script>
        // ค้นหาแผนที่
        function get_long() {
            $("#search_show1").html(" ");
            $("#search_show2").html(" ");
            let location1 = $("#search_target1").val();
            let numcount1 = 1;
            console.log("--------------------------------arear1");
            for (let area1 = 10; area1 <= 96; area1++) {
                $.ajax({
                    dataType: "JSON",
                    method: "GET",
                    url: "https://search.longdo.com/mapsearch/json/search?keyword=" + location1 + "&area=" + area1 + "&span=5000km&limit=1000&key=ce7bc6077f0a777cce3ddba8c386042e",
                }).done(function(latlon) {
                    // console.log(latlon);
                    // for (let i = 0; i < Object.keys(latlon).length; i++) {
                    //     console.log(i);
                    // }
                    let op = latlon.data;
                    console.log("=========================================op1");
                    console.log(op);
                    for (let i = 0; i < Object.keys(op).length - 1; i++) {
                        console.log("looppp1");
                        console.log(op[i].name);
                        if (op[i].type == "poi" || op[i].type == "khet" || op[i].type == "road" || op[i].type == "geom") {
                            $("#search_show1").append("<div id='seearch_box'> <div id='overflow'> <input type='radio' id='target1" + i + "' name='target1' style='margin-right:5px;' required value='" + op[i].lat + "-" + op[i].lon + "' data-text='" + op[i].name + "'>" + op[i].name + "</ div></div>");
                            numcount1++;
                        }
                    }
                });
            }
            let location2 = $("#search_target2").val();
            console.log("--------------------------------arear2");
            let numcount2 = 1;
            for (let area2 = 10; area2 <= 96; area2++) {

                $.ajax({
                    dataType: "JSON",
                    method: "GET",
                    url: "https://search.longdo.com/mapsearch/json/search?keyword=" + location2 + "&area=" + area2 + "&span=5000km&limit=1000&key=ce7bc6077f0a777cce3ddba8c386042e",
                }).done(function(latlon) {
                    // console.log(latlon);
                    // for (let i = 0; i < Object.keys(latlon).length; i++) {
                    //     console.log(i);
                    // }
                    let op = latlon.data;
                    console.log("=========================================op2");
                    console.log(op);
                    for (let i = 0; i < Object.keys(op).length - 1; i++) {
                        console.log("looppp1");
                        console.log(op[i].name);
                        if (op[i].type == "poi" || op[i].type == "khet" || op[i].type == "road" || op[i].type == "geom") {
                            $("#search_show2").append("<div id='seearch_box'> <div id='overflow'> <input type='radio' id='target2" + i + "' name='target2' style='margin-right:5px;' required value='" + op[i].lat + "-" + op[i].lon + "' data-text='" + op[i].name + "'>" + op[i].name + "</ div></div>");
                            numcount2++;
                        }
                    }

                });
            }
        }

        //calculate distance
        async function cal_distant() {
            map = new longdo.Map({
                placeholder: document.getElementById('map')
            });


            // let temp1 = $("#target1").val();
            let temp1 = $("input[name='target1']:checked").val();
            console.log("temp from value1:" + temp1);
            let lat1 = temp1.substring(0, temp1.indexOf("-"));
            let lon1 = temp1.substring(temp1.indexOf("-") + 1, 36);
            console.log("lat1:" + lat1 + " lon1:" + lon1);

            // let temp2 = $("#target2").val();
            let temp2 = $("input[name='target2']:checked").val();
            console.log("temp from value2:" + temp2);
            let lat2 = temp2.substring(0, temp2.indexOf("-"));
            let lon2 = temp2.substring(temp2.indexOf("-") + 1, 36);
            console.log("lat2:" + lat2 + " lon2:" + lon2);
            AddM(lat1, lon1, lat2, lon2);

            map.Route.placeholder(document.getElementById('result'));
            // map.Route.mode(longdo.RouteMode.Cost);
            //hide distance on map
            // map.Route.mode(map.RouteLabel.time);
            // map.RouteLabel.Hide();
            map.Route.search();


            // map.Route.search().then(res => {
            //     console.log(res);
            // });

            getDistance(lat1, lon1, lat2, lon2);

            //create hidden for get lat lon
            $("#latlon").html(" ");
            $("#latlon").append("<input type='hidden' name='lat1' id='lat1' value='" + lat1 + "'>");
            $("#latlon").append("<input type='hidden' name='lon1' id='lon1' value='" + lon1 + "'>");
            $("#latlon").append("<input type='hidden' name='lat2' id='lat2' value='" + lat2 + "'>");
            $("#latlon").append("<input type='hidden' name='lon2' id='lon2' value='" + lon2 + "'>");
            console.log('in v lat1:' + lat1 + ' lon1:' + lon1 + ' lat2' + lat2 + ' lon2:' + lon2);
        }

        //add marker
        const AddM = (lat1, lon1, lat2, lon2) => {
            console.log("addmarker la1:" + lat1 + " lon:" + lon1 + " lat:" + lat2 + "lon2:" + lon2);
            //add map target
            map.Route.add({
                lon: lon1,
                lat: lat1
            });
            map.Route.add({
                lon: lon2,
                lat: lat2
            });


        }

        //get distance
        async function getDistance(lat1, lon1, lat2, lon2) {
            // Default options are marked with *
            fetch(
                'https://api.longdo.com/RouteService/json/route/guide?flon=' + lon1 + '&flat=' + lat1 + '&tlon=' + lon2 + '&tlat=' + lat2 + '&mode=t&type=25&locale=en&key=ce7bc6077f0a777cce3ddba8c386042e'
            ).then(response => response.json()).then(data => {
                const val = data.data[0].distance / 1000;
                console.log("val1" + val)
                const val2 = data.data[0].distance;
                console.log("val22" + val2)
                $('#distant').html("ระยะทาง : " + val.toFixed(2) + " กิโลเมตร<br>");
                $('#distant').append("<input type='hidden' name='distance_map' id='distance_map' value='" + val.toFixed(2) + "'>");
                setnew();
            });
            // parses JSON response into native JavaScript objects
        }

        //get name of 2 location
        function setnew() {
            $('#namelocation').html(" ");
            let id1 = $("input[name='target1']:checked").attr('id');
            location_name1 = $("input[name='target1']:checked").attr('data-text');
            let id2 = $("input[name='target2']:checked").attr('id');
            location_name2 = $("input[name='target2']:checked").attr('data-text');
            $('#namelocation').html("<input type='hidden' id='loca_name1' name='loca_name1' value='" + location_name1 + "'><input type='hidden' id='loca_name2'  name='loca_name2' value='" + location_name2 + "'>");
        }
    </script>
</head>

<body onload="init();">

    <!-- Container -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" align="center">
            <ul class="list-unstyled">
                <li>
                    <a href="#" style="background-color: #F8F9FA!important;"><img src="<?php echo base_url() . '/img/LOGO Clicknext.png' ?>" alt="Logo Clicknext" style="height:43px;"></a>
                </li>
                <?php if ($_SESSION["position"][0]->dep_name != "Project Manager" || $_SESSION["position"][0]->dep_name != "Project Manager") { ?>
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_status"); ?>'">สถานะการเบิกค่าเดินทาง</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name != "Project Manager") { ?>
                    <li class="active">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_withdraw"); ?>'">ขอเบิกค่าเดินทาง</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name != "Project Manager") { ?>
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_history"); ?>'">ประวัติการเบิกค่าเดินทาง</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name == "Project Manager") { ?>
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_dashboard"); ?>'">Dashboard</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name == "Project Manager") { ?>
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_approve"); ?>'">อนุมัติการเบิกค่าเดินทาง</a>
                    </li>
                <?php } ?>
                <hr>
                <li class="failed">
                    <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_logout"); ?>'">ออกจากระบบ</a>
                </li>

            </ul>
        </nav>
        <!-- Content  -->
        <div id="content">

            <!-- Headbar -->
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn">
                        <i class="fa-solid fa-bars" style="color: #EE3F4C;"></i>
                    </button>
                    <span class="notification">
                        <span class="icon_wrap"><i class=" fas fa-bell fa-lg"></i></span>
                        <div class="notification_dd">
                            <ul class="notification_ul">
                                <div class="scrollbar" id="style-default">

                                    <?php for ($i = 0; $i < count($noti); $i++) { ?>
                                        <tr>
                                            <td id="<?php echo 'status' . $i; ?>">
                                                <?php if ($noti[$i]->withdraw_status == 0) {
                                                    //echo "<div style='color:red;' align='center'>ไม่ผ่านการอนุมัติ</div>";
                                                    echo '<li class="success">
                                <div class="notify_icon">
                                  <i class="fa-solid fa-circle" style="background-position: 1rem"></i>
                                </div>
                                <div class="notify_data">
                                  <div class="title">
                                    รหัสการเบิก ' . $noti[$i]->withdraw_number . '
                                  </div>
                                </div>
                                <div class="notify_status">
                                  <p class="failed-text">ไม่อนุมัติ</p>
                                </div>
                              </li>';
                                                } else if ($noti[$i]->withdraw_status == 1) {
                                                    // echo "<div style='color:green;' align='center'>ผ่านการอนุมัติ</div>";
                                                    echo '<li class="success">
                                <div class="notify_icon">
                                  <i class="fa-solid fa-circle" style="background-position: 1rem"></i>
                                </div>
                                <div class="notify_data">
                                  <div class="title">
                                    รหัสการเบิก ' . $noti[$i]->withdraw_number . '
                                  </div>
                                </div>
                                <div class="notify_status">
                                  <p class="success-text">อนุมัติ</p>
                                </div>
                              </li>';
                                                } else if ($noti[$i]->withdraw_status == 2) {
                                                    // echo "<div style='color:green;' align='center'>ผ่านการอนุมัติ</div>";
                                                    echo '<li class="success">
                                <div class="notify_icon">
                                  <i class="fa-solid fa-circle" style="background-position: 1rem"></i>
                                </div>
                                <div class="notify_data">
                                  <div class="title">
                                    รหัสการเบิก ' . $noti[$i]->withdraw_number . '
                                  </div>
                                </div>
                                <div class="notify_status">
                                  <p class="text-warning">รออนุมัติ</p>
                                </div>
                              </li>';
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </ul>
                        </div>
                    </span>
                    <i class="fas fa-user-circle fa-lg" style="margin-left:20px; margin-right:10px"></i> <span id="name"><?php echo $_SESSION["user"][0]->emp_firstname . " " . $_SESSION["user"][0]->emp_lastname; ?></span>
                </div>
            </nav>
            <!-- Headbar -->

            <form method="post" action="<?php echo site_url() . '/TRS_C_Clicknext/add_withdraw'; ?>" enctype="multipart/form-data">
                <div class="row mb-5">
                    <div id="map"></div>

                    <div id="search_box">
                        จุดเริ่มต้น <input type="text" id="search_target1" required style="width: 232.98438px" ;><br>
                        <div id="search_show1" class="overflow-auto">
                        </div>
                        ปลายทาง <input type="text" id="search_target2" required style="width: 232.98438px" ;><br>
                        <div id="search_show2" class="overflow-auto">
                        </div>

                        <div class="" id="distant">
                            ระยะทาง :
                        </div>

                        <button class="btn btn-primary" type="button" onclick="get_long()" style="margin-bottom:10px; width:150px;">ค้นหา</button>
                        <button class="btn btn-secondary" type="button" onclick="cal_distant()" style="margin-bottom:10px; width:150px;">คำนวณระยะทาง</button>

                    </div>
                </div>


                <div class="container">
                    <div class="row  justify-content-center">

                        <div class="col-4">
                            <div class="form-floating">
                                <select class="form-select form-select-md" style="font-size: 17px;" id="selectType" name="travel_type" onchange="selectOthertype()">
                                    <option value="รถยนต์ส่วนบุคคล" data-id="1">รถยนต์ส่วนบุคคล</option>
                                    <option value="รถไฟฟ้า" data-id="2">รถไฟฟ้า</option>
                                    <option value="วินมอเตอร์ไซต์" data-id="3">วินมอเตอร์ไซต์</option>
                                    <option value="Taxi" data-id="4">Taxi</option>
                                    <option value="อื่น ๆ" data-id="5">อื่น ๆ</option>
                                </select>
                                <label for="selectTypec"> ประเภทการเดินทาง</label>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingInputGrid" name="oil_price" step="0.01" required>
                                <label for="floatingInputGrid"> ราคาน้ำมัน</label>
                            </div>
                        </div>

                    </div><br>

                    <div class="row justify-content-center" id="input2">
                        <br>
                        <div class="col-4" id="showOthertype">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="etc" name="travel_typeinput" >
                                <label for="etc" style="margin-left: 12px;"> ประเภทการเดินทาง</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="etc" name="travel_date" required>
                                <label for="etc" style="margin-left: 12px;"> วันที่เดินทาง</label>
                            </div>
                        </div>
                        <div class="col-4" id="hide1" style="opacity: 0%;">
                            <input type="text" class="form-control" name="">
                        </div>
                        <br>
                    </div><br>
                    <!-- <div class="row  justify-content-center">
                        <div class="col-4">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingInputGrid" name="oil_price" required>
                                <label for="floatingInputGrid"> </label>
                            </div>
                        </div>

                    </div><br> -->

                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="form-floating">
                                <textarea class="form-control" id="reason" name="reason" required style="height:100px; text-align: left;"></textarea>
                                <label for="reason">เหตุผลการเบิก</label>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <hr><br>
                <div id="namelocation">

                </div>
                <div id="latlon">

                </div>
                <div class="row ">
                    <div class="col-12" align="right" style="">
                        <button class="btn btn-danger" type="reset" style="width:200px; margin-right:20px; margin-bottom:20px;"> ยกเลิก </button>
                        <button class="btn btn-secondary" type="submit" name="action" value="save" style="width:200px; margin-right:20px; margin-bottom:20px;"> บันทึกแบบร่าง </button>
                        <button class="btn btn-success" type="submit" name="action" value="send" style="width:200px; margin-right:20px; margin-bottom:20px;"> ยืนยัน </button>
                    </div>
                </div>

        </div>

        </form>
    </div>
    </div><!-- Content  -->
    <!-- <button class="btn btn-success" onclick="get_long()"> TESDT </button> -->
    </div> <!-- Container -->



    <script>
        $('#showOthertype').hide();

        function selectOthertype() {
            console.log("ssssssssssssssssssssssss" + $('#selectType').find(':selected').data('id'));
            if ($('#selectType').find(':selected').data('id') == 5) {
                $('#showOthertype').show();
                $('#etc').attr("required", true);
                $('#hide1').hide();
            } else {
                $('#showOthertype').hide();
                $('#etc').attr("required", false);
                $('#date_travel').css('align', 'left');
                $('#hide1').show();
            }
        }
    </script>
    <style>
        .ldmap_geomlabel {
            display: none;
        }
    </style>
</body>

</html>