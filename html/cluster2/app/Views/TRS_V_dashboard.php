<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>dashboard</title>
    <!-- Datatables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . '/css/style.css' ?>">
    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    <!-- script graph -->
    <!-- <script src="dashboard.js"></script>
    <script src="circlegraph.js"></script> -->
    <!-- script sidebar-->
    <script type="text/javascript" src="<?php echo base_url() . '/js/sidebar.js' ?>"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url() . '/js/notification.js' ?>"></script>

</head>

<body>
    <!-- Container -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" align="center">
            <ul class="list-unstyled">
                <li>
                    <a href="#" style="background-color: #F8F9FA!important;"><img src="<?php echo base_url() . '/img/LOGO Clicknext.png' ?>" alt="Logo Clicknext" style="height:43px;"></a>
                </li>
                <?php if ($_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager") { ?>
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_status"); ?>'">สถานะการเบิกค่าเดินทาง</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager") { ?>
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_withdraw"); ?>'">ขอเบิกค่าเดินทาง</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager") { ?>
                    <li class="active">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_dashboard"); ?>'">Dashboard</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager") { ?>
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_approve"); ?>'">อนุมัติการเบิกค่าเดินทาง</a>
                    </li>
                <?php } ?>
                <li class="failed">
                    <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_history"); ?>'">ประวัติการเบิกค่าเดินทาง</a>
                </li>
                <hr>
                <li class="failed">
                    <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_logout"); ?>'">ออกจากระบบ</a>
                </li>

            </ul>
        </nav>
        <!-- Sidebar  -->

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

            <!-- Dropdown เลือกระยะเวลาแสดงกราฟ -->
            <select class="form-select form-select-lg shadow mb-3" id="dropdown_dashboard" onchange="changeVal(this)">
                <option value="1" selected> รายสัปดาห์</option>
                <option value="2">รายเดือน</option>
            </select>
            <!-- <script>
            const changeVal = (_this) => {
                console.log($(_this).val())
            }
            </script> -->
            <!-- Dropdown เลือกระยะเวลาแสดงกราฟ -->
            <script>
                const changeVal = (_this) => {
                    //console.log($(_this).val())
                    const ctx01 = document.getElementById('lineChart');
                    const myChart01 = new Chart(ctx01, {
                        type: 'line',
                        data: {
                            labels: $(_this).val() == 2 ? [<?php for ($i = 0; $i < 30; $i++) {
                                                                echo json_encode($date[$i]);
                                                                if ($i != 30 - 1) {
                                                                    echo ",";
                                                                }
                                                            } ?>] : [<?php for ($i = 0; $i < 7; $i++) {
                                                                            echo json_encode($date[$i]);
                                                                            if ($i != 7 - 1) {
                                                                                echo ",";
                                                                            }
                                                                        } ?>],
                            datasets: [{
                                label: 'ยอดการเบิก',
                                data: $(_this).val() == 2 ? [<?php for ($i = 0; $i < 30; $i++) {
                                                                    echo json_encode($total[$i]);
                                                                    if ($i != 30 - 1) {
                                                                        echo ",";
                                                                    }
                                                                } ?>] : [<?php for ($i = 0; $i < 7; $i++) {
                                                                                echo json_encode($total[$i]);
                                                                                if ($i != 7 - 1) {
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
                }
            </script>
            <!-- กราฟ -->
            <div class="row m-0">
                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 pr-3" id="back_graph">
                    <div align="center" id="head_graph">
                        กราฟเส้นแสดงสถานะการเบิกค่าเดินทางของพนักงานทั้งหมดแบบรายเดือน
                    </div>
                    <div id="graph" align="center">
                        <canvas id="lineChart" style="max-height: 450px;"></canvas>
                        <script>
                            const ctx01 = document.getElementById('lineChart');
                            const myChart01 = new Chart(ctx01, {
                                type: 'line',
                                data: {
                                    labels: [<?php for ($i = 0; $i < 7; $i++) {
                                                    echo json_encode($date[$i]);
                                                    if ($i != 7 - 1) {
                                                        echo ",";
                                                    }
                                                } ?>],
                                    datasets: [{
                                        label: 'ยอดการเบิก',
                                        data: [<?php for ($i = 0; $i < 7; $i++) {
                                                    echo json_encode($total[$i]);
                                                    if ($i != 7) {
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
                        กราฟวงกลมแสดงสถานะการเบิกค่าเดินทางของพนักงานทั้งหมด
                    </div>
                    <div id="graph" align="center">
                        <canvas id="pieChart" style="max-height: 380px;"></canvas>
                        <script>
                            const ctx = document.getElementById('pieChart');
                            const myChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['ไม่อนุมัติ', 'อนุมัติ'],
                                    datasets: [{
                                        label: '# of Votes',
                                        data: [<?php echo $statusNonPass . ',' . $statusPass; ?>],
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
                        กราฟวงกลมแสดงประเภทการเดินทางของพนักงานทั้งหมด
                    </div>
                    <div id="graph" align="center">
                        <canvas id="pieChart03" style="max-height: 380px;"></canvas>
                        <script>
                            const ctx03 = document.getElementById('pieChart03');
                            const myChart03 = new Chart(ctx03, {
                                type: 'pie',
                                data: {
                                    labels: ['รถยนต์ส่วนบุคคล', 'รถไฟฟ้า', 'วินมอเตอร์ไซต์', 'Taxi', 'อื่น ๆ'],
                                    datasets: [{
                                        label: '# of Votes',
                                        data: [
                                            <?php echo $private_car . ',' . $train . ',' . $motorcycle . ',' . $taxi . ',' . $count ?>
                                        ],
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
                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 mr-3" id="back_graph">
                    <table class="table table-bordered">
                        <thead>
                            <tr id="head_table" align="center">
                                <th scope="col">วันที่ </th>
                                <th scope="col">ยอดจำนวนเงินที่เบิก</th>
                            </tr>
                        </thead>
                        <tbody align="center" style="font-weight:bold;">
                            <!-- loop show table -->
                            <?php
                            for ($k = 0; $k < 7; $k++) {
                                echo "<tr>";
                                echo "<td>" . $date[$k] . "</td>";
                                echo "<td>" . $total[$k] = number_format(($total[$k]), 2) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            <!-- --------------- -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ตาราง -->
        </div>
        <!-- Content  -->
    </div>
    <!-- Container -->
</body>
</html>