<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>การอนุมัติการเบิก</title>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Datatables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . '/css/style.css' ?>">
    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Import JS -->
    <script type="text/javascript" src="<?php echo base_url() . '/js/datatables.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . '/js/sidebar.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . '/js/notification.js' ?>"></script>

</head>

<body>
    <div class="wrapper">
        <!-- side bar -->
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
                    <li class="failed">
                        <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_dashboard"); ?>'">Dashboard</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager") { ?>
                    <li class="active">
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

            <h2 style="margin-left: 25px; font-size: 32px"><b>รายการรออนุมัติการเบิกค่าเดินทาง</b></h2>
            <!-- ส่วนปุ่มกดอนุมัติ -->
            <div class="container">
                <div class="row m-0 justify-content-end">

                    <div class="col-12 col-md-8 col-lg-5 shadow m-0 mb-4 mt-3" id="back_approve">
                        <div class="row m-0">
                            <div class="approve-icon col-2" style="font-size: 30px;">
                                <i class="fas fa-clipboard"></i>
                            </div>
                            <div class="approve-word col-4">
                                รายการรออนุมัติ<br>
                                เลือก <span id="totalapprove">0</span> รายการ
                            </div>
                            <div class="approve-button col-6" style="text-align: center;">
                                <button type="button" class="button_notapprove btn-danger" id="button_notapprove" onclick="summary(0)" value="0" data-bs-toggle="modal" data-bs-target="#cancle">
                                    <i class="fas fa-times"></i> ไม่อนุมัติ </button>
                                <button type="button" class="button_approve btn-success" id="button_approve" onclick="summary(1)" value="1" data-bs-toggle="modal" data-bs-target="#confirm">
                                    <i class="fas fa-check"></i> อนุมัติ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ส่วนปุ่มกดอนุมัติ -->


            <div class="container">
                <div class="table-responsive">
                    <form method="post" id="form_submit_approve" action="<?php echo base_url() . '/TRS_C_Clicknext/add_approve'; ?>">
                        <table id="myTable_hide_sort" class="table table-bordered " style="width:100%">
                            <input type="hidden" name="btn_action" id="btn_action">
                            <thead>
                                <tr id="head_table" align="center">
                                    <th>
                                        <div style="width: 30px;" align="center"><input type="checkbox" id="checkAll" class="select-all checkbox" name="select-all"></div>
                                    </th>
                                    <th scope="col">
                                        <div style="width: 150px;">วันที่ขอเบิก</div>
                                    </th>
                                    <th scope="col">
                                        <div style="width: 200px;">รหัสการเบิก</div>
                                    </th>
                                    <th scope="col">
                                        <div style="width: 300px;">เหตุผลการเบิก </div>
                                    </th>
                                    <th scope="col">
                                        <div style="width: 100px;">จำนวนเงิน</div>
                                    </th>
                                    <th scope="col">
                                        <div style="width: 100px;">สถานะ</div>
                                    </th>
                                    <th scope="col">
                                        <div style="width: 100px;">รายละเอียด</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                for ($i = 0; $i < count($des); $i++) {
                                ?>
                                    <tr>
                                        <td align="center" class="align-middle"><input onclick="countcheck()" type="checkbox" class="select-item checkbox Sub_ID" name="select-item[]" value="<?php echo $des[$i]->withdraw_number ?>">
                                            <input type="hidden" id="item_sub_wdnumber_<?php echo $des[$i]->withdraw_number ?>" value="<?php echo $des[$i]->withdraw_number ?>">
                                            <input type="hidden" id="item_sub_wddate_<?php echo $des[$i]->withdraw_number ?>" value="<?php echo $des[$i]->withdraw_date ?>">
                                            <input type="hidden" id="item_sub_wdreason_<?php echo $des[$i]->withdraw_number ?>" value="<?php echo $des[$i]->withdraw_reason ?>">
                                            <input type="hidden" id="item_sub_wdamount_<?php echo $des[$i]->withdraw_number ?>" value="<?php echo $des[$i]->withdraw_amount ?>">
                                        </td>

                                        <td  align="center" class="align-middle">
                                            <?php
                                            $year = (int)substr($des[$i]->withdraw_date, 0, 4);
                                            $month = substr($des[$i]->withdraw_date, 0, 7);
                                            $month = (int)substr($des[$i]->withdraw_date, 5, 7);
                                            $date = (int)substr($des[$i]->withdraw_date, 8, 8);
                                            if ($date < 10) {
                                                if ($month < 10) {
                                                    echo "0" . $date . "-0" . $month . "-" . $year . "<br>";
                                                } else {
                                                    echo "0" . $date . "-" . $month . "-" . $year . "<br>";
                                                }
                                            } else {
                                                if ($month < 10) {
                                                    echo $date . "-0" . $month . "-" . $year . "<br>";
                                                } else {
                                                    echo "0" . $date . "-" . $month . "-" . $year . "<br>";
                                                }
                                            }
                                            //echo $date."-".$month."-".$year."<br>";
                                            //echo $history_table[$i]->approve_date; 
                                            ?>
                                        </td>
                                        <td align="center" class="align-middle">
                                            <?php
                                            $len = strlen($des[$i]->withdraw_number);
                                            echo "W";
                                            for ($j = 1; $j <= 10 - $len; $j++) {
                                                echo "0";
                                            }
                                            echo $des[$i]->withdraw_number; ?></td>
                                        <td align="left" class="align-middle"><?php echo $des[$i]->withdraw_reason ?></td>
                                        <td align="right" class="align-middle"><?php echo $des[$i]->withdraw_amount = number_format($des[$i]->withdraw_amount, 2); ?></td>
                                        <td align="center"  class="align-middle">
                                            <span class='badge bg-warning' style='padding:10px; font-size: 14px;'>รออนุมัติ</span>

                                        </td>
                                        <td id="<?php echo 'detail_button' . $i; ?>" align="center" class="align-middle">
                                            <!-- botton to read detail -->
                                            <a href="#" class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#detail_<?php echo $i; ?>">ดูรายละเอียด</a> <label>&nbsp&nbsp</label>
                                            <!-- Modal -->
                                            <div class="modal fade" id="detail_<?php echo $i; ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg ">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" รายละเอียดการเบิกค่าเดินทาง หมายเลข <?php echo $des[$i]->withdraw_number; ?> </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="modal_pdf<?php echo $i; ?>" style="font-family: 'Krub', sans-serif;">
                                                            <!-- content in pdf -->
                                                            <div id="file" class="container" style="height:877px; width:620px; padding:10px;">
                                                                <img align="right" src="<?php echo base_url() . '/img/LOGO Clicknext.png' ?>" style="height:30px;"><br><br>
                                                                <div align="right" style="font-size:12px;"><b>
                                                                        บริษัท คลิกเน็กซ์ จำกัด <br>
                                                                        128/323-333 ชั้น 30 อาคารพญาไทพลาซ่า ถนนพญาไท <br>
                                                                        Thung Phaya Thai Ratchathewi Bangkok 10400<br></b>
                                                                </div>
                                                                <br>

                                                                <div align="center" style="font-size:18px;"><b>ใบเบิกเงิน</b></div>
                                                                <br><br>
                                                                <div class="row" align="left">
                                                                    <div class="col-6">ชื่อ-นามสกุล <b><?php echo ${"detail" . $i}[0]->emp_firstname . " " . ${"detail" . $i}[0]->emp_lastname ?></b></div>
                                                                    <div class="col-6">ตำแหน่ง <b><?php echo ${"detail" . $i}[0]->dep_name ?></b></div>
                                                                </div><br>
                                                                <div class="row" align="left">
                                                                    <div class="col-6">วันที่ขอเบิก <b><?php echo ${"detail" . $i}[0]->withdraw_date ?></b></div>
                                                                </div>
                                                                <br>

                                                                <table id="example" class="table table-bordered">
                                                                    <thead style="border-width:1px; border-color: #DEE2E6; background-color: #F2F2F2;">
                                                                        <tr>

                                                                            <td align="center"><b>เลขที่บิล</b></td>
                                                                            <td align="center"><b>วันที่เดินทาง</b></td>
                                                                            <td align="center"><b>รายละเอียดรายจ่าย</b></td>
                                                                            <td align="center"><b>จำนวนเงิน (บาท)</b></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <?php
                                                                                $len = strlen($des[$i]->withdraw_number);
                                                                                echo "W";
                                                                                for ($j = 1; $j <= 10 - $len; $j++) {
                                                                                    echo "0";
                                                                                }
                                                                                echo $des[$i]->withdraw_number; ?></td>
                                                                            <td align="center"><?php echo ${"detail" . $i}[0]->withdraw_datetravel;  ?></td>
                                                                            <td align="left"><?php echo $des[$i]->withdraw_reason;  ?></td>
                                                                            <td align="right"> <?php echo $des[$i]->withdraw_amount; ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <br><br>
                                                                <div class="row">
                                                                    <div class="col-6" align="center" style="width:300px;">
                                                                        <div>
                                                                            ลงชื่อ ................................. ผู้เบิกจ่าย
                                                                        </div>
                                                                        <div>
                                                                            ( <?php echo ${"detail" . $i}[0]->emp_firstname . " " . ${"detail" . $i}[0]->emp_lastname; ?> )
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6" align="center" style="width:300px;">
                                                                        <div>
                                                                            ลงชื่อ ................................. ผู้รับเงิน
                                                                        </div>
                                                                        <div>
                                                                            ( ................................. )
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-6" align="center" style="width:300px;">

                                                                    </div>
                                                                    <div class="col-6" align="center" style="width:300px;">
                                                                        <div>
                                                                            ลงชื่อ ................................. ผู้อนุมัติ
                                                                        </div>
                                                                        <div>
                                                                            ( ................................. )
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width:150px;">ยกเลิก</button>
                                                                <button type="button" class="btn btn-secondary" style="width:150px;" onclick="generatePDF('modal_pdf<?php echo $i; ?>')">Export PDF</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                        ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Modal Comfirm -->
    <div class="modal fade" id="confirm" tabindex="-1">
        <div class=" modal-dialog modal-dialog-centered">
            <div class="modal-content shadow" style="border-radius:10px; padding:20px;">
                <div align="right" style="padding: 8px;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div align="center" style="font-size:100px; color:#FFBE3F;">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div align="center" style="font-size:20px; color:#FFBE3F;">
                    <i class="fa-solid fa-list"></i>&nbsp; รายการทั้งหมด <span id="total_list_confirm"> 0 </span> รายการ
                </div>
                <div align="center" style="font-size:15px;">
                    </i>&nbsp; รวมเป็นเงิน <span id="total_sum"> 0 </span> บาท
                </div>
                <div id="sumlist_confirm" align="center" style="max-height: 150px; ; overflow:auto">
                    <table class="table table-bordered" align="center" style="width: 350px;">
                        <thead>
                            <tr id="head_table" align="center">
                                <th scope="col">
                                    <div style="width: 150px;">วันที่ขอเบิก</div>
                                </th>
                                <th scope="col">
                                    <div style="width: 200px;">รหัสการเบิก</div>
                                </th>
                                <th scope="col">
                                    <div style="width: 300px;">เหตุผลการเบิก </div>
                                </th>
                                <th scope="col">
                                    <div style="width: 100px;">จำนวนเงิน</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody align="left" id="modal_table_confirm">

                        </tbody>
                    </table>
                </div>
                <div align="center" style="font-size:25px; font-weight:bold;">
                    ยืนยันการอนุมัติหรือไม่ ?
                </div>
                <div align="center" style="padding: 20px;">
                    <button type="button" id="button_unconfirm" onclick="javascript:location.href = '<?php echo site_url("/TRS_V_approve"); ?>'">
                        <i class="fas fa-times"></i> ยกเลิก</button>
                    <button type="button" id="button_confirm" onclick="btn_approve(1)">
                        <i class="fas fa-check"></i> ยืนยัน
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- Modal Comfirm -->

    <!-- Modal Cancle -->
    <div class="modal fade" id="cancle" tabindex="-1" ">
            <div class=" modal-dialog modal-dialog-centered">
        <div class="modal-content shadow" style="border-radius:10px;">
            <div align="right" style="padding: 8px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div align="center" style="font-size:100px; color:#FFBE3F;">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div align="center" style="font-size:20px; color:#FFBE3F;">
                <i class="fa-solid fa-list"></i>&nbsp; รายการทั้งหมด <span id="total_list_cancle"> 0 </span> รายการ
            </div>
            <div id="sumlist_cancle" align="center" style="max-height: 70px; overflow:auto;">

            </div>
            <div align="center" style="font-size:25px; font-weight:bold;">
                เหตุผลการไม่อนุมัติ
            </div>
            <div align="center">
                <textarea class="form-control" id="reject_reason" rows="2" style="width: 50%;"></textarea>
            </div>
            <div align="center" style="padding: 20px;">
                <button type="button" id="button_unconfirm" onclick="javascript:location.href = '<?php echo site_url("/TRS_V_approve"); ?>'">
                    <i class="fas fa-times"></i> ยกเลิก</button>
                <button type="submit" id="button_confirm" onclick="btn_approve(0)">
                    <i class="fas fa-check"></i> ยืนยัน</button>
            </div>
        </div>
    </div>
    </div> <!-- Modal Cancle -->

    </div>


    </div> <!-- container -->

    <script>
        $(document).ready(function() {
            $('.button_approve').prop('disabled', true);
            $('.button_approve').attr("style", 'background-color: grey');

            $('.button_notapprove').prop('disabled', true);
            $('.button_notapprove').attr("style", 'background-color: grey');
        });

        $("#select-all").click(function() {
            var all = $("input.select-all")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function(index, item) {
                item.checked = checked;
            });
        });
        //column checkbox select all or cancel
        $("input.select-all").click(function() {
            var checked = this.checked;
            $("input.select-item").each(function(index, item) {
                item.checked = checked;
            });
            countcheck();
        });

        function countcheck() {
            var x = 0;
            var rows = $('.Sub_ID');
            for (var i = 0; i < rows.length; i++) {
                if (rows[i].checked) {
                    x++;
                } else {

                }
            }
            if (x >= 1) {
                $('.button_approve').prop('disabled', false);
                $('.button_approve').attr("style", 'background-color: green');

                $('.button_notapprove').prop('disabled', false);
                $('.button_notapprove').attr("style", 'background-color: red');
            } else {
                $('.button_approve').prop('disabled', true);
                $('.button_approve').attr("style", 'background-color: gray');

                $('.button_notapprove').prop('disabled', true);
                $('.button_notapprove').attr("style", 'background-color: gray');
            }

            if (rows.length != x) {
                $('#checkAll').prop('checked', false);
            } else {
                $('#checkAll').prop('checked', true);
            }
            // alert(x);
            $('#totalapprove').html(x);
        }

        function summary(action) {
            // $('#modal_table_confirm').append('<tr> <td> '+ $('#item_sub_wddate_' + rows[i].value).val() +' </td> <td> '+ $('#item_sub_wdnumber_' + rows[i].value).val() +'</td> <td>'+ $('#item_sub_wdreason_' + rows[i].value).val() +'</td> <td> '+ $('#item_sub_wdamount_' + rows[i].value).val() +'</td><tr>');

            $('#btn_action').val(action);
            $('#modal_table_confirm').html('');
            // $('#sumlist_cancle').html('');
            var x = 0;
            var sum = 0;
            var rows = $('.Sub_ID');
            for (var i = 0; i < rows.length; i++) {
                if (rows[i].checked) {
                    x++;
                    sum += parseInt($('#item_sub_wdamount_' + rows[i].value).val());
                    $('#modal_table_confirm').append('<tr> <td> ' + $('#item_sub_wddate_' + rows[i].value).val() + ' </td> <td> ' + $('#item_sub_wdnumber_' + rows[i].value).val() + '</td> <td>' + $('#item_sub_wdreason_' + rows[i].value).val() + '</td> <td> ' + $('#item_sub_wdamount_' + rows[i].value).val() + '</td><tr>');
                    // $('#sumlist_cancle').append('<div>' + $('#item_sub_' + rows[i].value).val() + '</div>');
                }
            }
            $('#total_sum').html(sum);
            $('#total_list_confirm').html(x);
            $('#total_list_cancle').html(x);
            


        }

        function btn_approve(action) {
            var a = $('#reject_reason').val();
            if (action == 0) {
                if (jQuery.trim(a) == '') {
                    alert("Please enter reason !!!");
                    return false;
                }
                $('#btn_action').val($('#reject_reason').val());
            } else if (action == 1) {
                $('#btn_action').val("เหตุผลสมควร");
            }
            $('#form_submit_approve').submit();
        }
    </script>

</body>

</html>