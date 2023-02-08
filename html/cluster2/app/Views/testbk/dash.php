<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Test_dashboard</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . '/css/style.css' ?>">
    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- Container -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" align="center">
            <ul class="list-unstyled">
                <li>
                    <a href="#" style="background-color: #F8F9FA!important;"> <img
                            src="<?php echo base_url() . '/img/LOGO Clicknext.png' ?>" alt="" style="height:43px;"></a>
                </li>
                <li class="active">
                    <a href="">Dashboard</a>
                </li>
                <li>
                    <a
                        onclick="javascript:location.href = '<?php echo site_url("/TRS_C_Clicknext/approve"); ?>'">อนุมัติการเบิก</a>
                </li>
                <li>
                    <a
                        onclick="javascript:location.href = '<?php echo site_url("/TRS_C_Clicknext/history"); ?>'">ประวัติการเบิก</a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar  -->

        <!-- Content  -->
        <div id="content">
            <!-- Headbar -->
            <nav class="navbar navbar-light bg-light">
                <div>
                    <button type="button" id="sidebarCollapse" class="btn">
                        <i class="fa-solid fa-bars" style="color: #EE3F4C;"></i>
                    </button>
                </div>
                <div align="right">
                    <button type="button" class="btn position-relative">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="color:white;">
                            99+
                        </span>
                    </button>
                    <i class="fas fa-user-circle fa-lg" style="margin-left:20px; margin-right:10px"></i>
                    <span id="name"> Nitiphum Sumpunnang <span>
                </div>
            </nav>
            <!-- Headbar -->

            <!-- Dropdown เลือกระยะเวลาแสดงกราฟ -->
            <select class="form-select form-select-lg shadow mb-3" id="dropdown_dashboard" onchange="changeVal(this)">
                <option value="1">รายวัน</option>
                <option value="2" selected> รายสัปดาห์</option>
                <option value="3">รายเดือน</option>
                <option value="4">Custom</option>
            </select>
            <script>
            const changeVal = (_this) => {
                console.log($(_this).val())
            }
            </script>
            <!-- Dropdown เลือกระยะเวลาแสดงกราฟ -->

            <!-- กราฟ -->
            <div class="row m-0">
                <div class="col-sm-6 col-md-12 col-lg-6 mb-3 pr-3" id="back_graph">
                    <div align="center" id="head_graph">
                        กราฟเส้นแสดงสถานะการเบิกค่าเดินทางของพนักงานทั้งหมดแบบรายเดือน
                    </div>
                    <div id="graph" align="center">
                        <canvas id="lineChart" style="max-width: 100%;"></canvas>
                        <script>
                        const ctx01 = document.getElementById('lineChart');
                        const myChart01 = new Chart(ctx01, {
                            type: 'line',
                            data: {
                                labels: [<?php for ($i = 0; $i < 30; $i++) {
                                        echo json_encode($date[$i]);
                                        if ($i != 30 - 1) {
                                            echo ",";
                                        }
                                    } ?>],
                                datasets: [{
                                    label: 'ยอดการเบิก',
                                    data: [<?php for ($i = 0; $i < 30; $i++) {
                                            echo json_encode($total[$i]);
                                            if ($i != 30) {
                                                echo ",";
                                            }
                                        } ?>],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        </script>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6 mb-3" id="back_graph">
                    <div align="center" id="head_graph">
                        กราฟวงกลมแสดงสถานะการเบิกค่าเดินทางของพนักงานทั้งหมดแบบรายเดือน
                    </div>
                    <div id="graph" align="center">
                        <canvas id="pieChart" style="max-width: 300px;" width=500px" height="220"></canvas>
                        <script>
                        const ctx = document.getElementById('pieChart');
                        const myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['ไม่อนุมัติ', 'อนุมัติ'],
                                datasets: [{
                                    label: '# of Votes',
                                    data: [<?php echo $statusNonPass.','.$statusPass; ?>],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },

                        });
                        </script>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12 col-lg-6 mb-3" id="back_graph">
                    <div align="center" id="head_graph">
                        กราฟวงกลมแสดง
                    </div>
                    <div id="graph" align="center">
                        <canvas id="pieChart03" style="max-width: 300px;" width=500px" height="220"></canvas>
                        <script>
                        const ctx03 = document.getElementById('pieChart03');
                        const myChart03 = new Chart(ctx03, {
                            type: 'pie',
                            data: {
                                labels: ['รถยนต์ส่วนบุคคล', 'รถไฟฟ้า', 'วินมอเตอร์ไซต์', 'Taxi', 'อื่น ๆ'],
                                datasets: [{
                                    label: '# of Votes',
                                    data: [<?php echo $private_car.','.$train.','.$motorcycle.','.$taxi.','.$count ?>],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },

                        });
                        </script>
                    </div>
                </div>
            </div>

            <!-- กราฟ -->

            <!-- ตาราง -->
            <div class="row m-0">
                <div class="col-sm-6 col-md-12 col-lg-6 mb-3 mr-3" id="back_graph">
                    <table class="table table-bordered">
                        <thead>
                            <tr id="head_table" align="center">
                                <th scope="col">วันที่ <i class="fas fa-arrow-down"></i></th>
                                <th scope="col">ยอดจำนวนเงินที่เบิก<i class="fas fa-arrow-down"></i></th>
                            </tr>
                        </thead>
                        <tbody align="center" style="font-weight:bold;">
                            <tr>
                                <td>20/03/2565</td>
                                <td>2000.00</td>
                            </tr>
                            <tr>
                                <td>20/03/2565</td>
                                <td>2500.00</td>
                            </tr>
                            <tr>
                                <td>20/03/2565</td>
                                <td>1800.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ตาราง -->
        </div>
        <!-- Content  -->
    </div>
    <!-- Container -->

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    <!-- script graph -->
    <!-- <script src="dashboard.js"></script>
    <script src="circlegraph.js"></script> -->
    <!-- script sidebar-->
    <script type="text/javascript" src="<?php echo base_url() . '/js/sidebar.js' ?>"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>

</html>