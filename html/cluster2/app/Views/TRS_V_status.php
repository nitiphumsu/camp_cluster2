<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>สถานะการเบิกค่าเดินทาง</title>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Datatables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . '/css/style.css' ?>">
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Import JS -->
    <script type="text/javascript" src="<?php echo base_url() . '/js/datatables.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . '/js/sidebar.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . '/js/notification.js' ?>"></script>
    <!-- pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

</head>

<body>

    <script>
        function generatePDF(targetPdf) {
            var element = document.getElementById(targetPdf);
            html2pdf(element, {
                margin: 0.5,
                filename: 'เอกสารการเบิกค่าเดินทาง.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    dpi: 192,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            });
        }
        /* function generatePDF(targetPdf) {
            let element = document.getElementById('targetPdf')

            let options = {
                margin: 0.5,
                filename: 'เอกสารการเบิกค่าเดินทาง.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    dpi: 192,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            }

            html2pdf().set(options).from(element).save();
        } */

        // function getEditWithdraw(w_id){
        //     // console.log(w_id)
        //     $.ajax({
        //         type: "POST",
        //         url: "<?php echo site_url() . 'TRS_C_Clicknext/getEditWithdraw'; ?>",
        //         data: {
        //             id: w_id
        //         },
        //         dataType: "JSON",
        //         success: function(response){
        //             let data = response;
        //             console.log(data);
        //         }
        //     });
        // }
    </script>

    <div class="wrapper">
        <?php $num = 0; ?>

        <nav id="sidebar" align="center">
            <ul class="list-unstyled">
                <li>
                    <a href="#" style="background-color: #F8F9FA!important;"><img src="<?php echo base_url() . '/img/LOGO Clicknext.png' ?>" alt="Logo Clicknext" style="height:43px;"></a>
                </li>
                <?php if ($_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager") { ?>
                    <li class="active">
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

        <!-- centent -->
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

            <div class="container">
                <div class="table-responsive">


                    <!-- หัวข้อ สถานะคำร้อง -->
                    <h2><b>สถานะคำร้อง</b></h2>

                    <!-- ตารางสถานะ -->
                    <table id="myTable" class="table table-bordered " style="width:100%">
                        <thead id="head_table">
                            <tr style="background-color: #EE3F4C; color: white;" align="center">
                                <th scope="col">
                                    <div>สถานะ</div>
                                </th>
                                <th scope="col">
                                    <div>หมายเลขการเบิกค่าเดินทาง</div>
                                </th>
                                <th scope="col">
                                    <div>เหตุผลการเบิก</div>
                                </th>
                                <th scope="col">
                                    <div>จำนวนเงิน</div>
                                </th>
                                <th scope="col" style="width: 154px;">
                                    <div>รายละเอียด</div>
                                </th>
                            </tr>
                        <tbody>
                            <?php for ($i = 0; $i < count($status_table); $i++) { ?>
                                <tr>
                                    <td style="text-align: center; width: 110px">
                                        <?php if ($status_table[$i]->withdraw_status == '2') { ?>
                                        <div style='color:red;' align='center'>รอการอนุมัติ</div>
                                        <?php } else if ($status_table[$i]->withdraw_status == '3') { ?>
                                            <div style='color:grey;' align='center'>ฉบับร่าง</div>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $len = strlen($status_table[$i]->withdraw_number);
                                        echo "W";
                                        for ($j = 1; $j <= 10 - $len; $j++) {
                                            echo "0";
                                        }
                                        echo $status_table[$i]->withdraw_number; ?>
                                    </td>
                                    <td style="text-align: center; width: 330px">
                                        <?php echo $status_table[$i]->withdraw_reason; ?>
                                    </td>
                                    <td style="text-align: right; width: 150px">
                                        <?php echo number_format($status_table[$i]->withdraw_amount, 2); ?>
                                    </td>

                                    <td id="<?php echo 'detail_button' . $i; ?>" align="center" style="width: 150px">
                                        <a href="#" align="left" class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#detail_<?php echo $i; ?>">ดูรายละเอียด</a> <label>&nbsp&nbsp</label>
                                        <?php if ($status_table[$i]->withdraw_status == "3") { ?>
                                            <a href="#" class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $i; ?>"><i class="fa-solid fa-pen-to-square"></i></a>

                                            <div class="modal fade" id="edit_<?php echo $i; ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> รายละเอียดการเบิกค่าเดินทาง หมายเลข <?php echo $status_table[$i]->withdraw_number; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body" style="font-family: 'Sarabun', sans-serif;">
                                                        <?php $num++; ?>
                                                            <form method="POST" id="form_edit" action="<?php echo base_url() . '/TRS_C_Clicknext/edit'; ?>">
                                                                <div class=" row">
                                                                    <div class="col-6">
                                                                        <div class="form-floating" align="left">
                                                                            <select class="form-select" style="font-size: 17px;" id="selectType<?php echo $i ?>" name="travel_type" onchange="selectOthertype(<?php echo $i ?>)">
                                                                                <option value="รถยนต์ส่วนบุคคล" data-id="1" <?php if ($status_table[$i]->withdraw_traveltype == "รถยนต์ส่วนบุคคล") {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>รถยนต์ส่วนบุคคล</option>
                                                                                <option value="รถไฟฟ้า" data-id="2" <?php if ($status_table[$i]->withdraw_traveltype == "รถไฟฟ้า") {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>รถไฟฟ้า</option>
                                                                                <option value="วินมอเตอร์ไซต์" data-id="3" <?php if ($status_table[$i]->withdraw_traveltype == "วินมอเตอร์ไซต์") {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>วินมอเตอร์ไซต์</option>
                                                                                <option value="Taxi" data-id="4" <?php if ($status_table[$i]->withdraw_traveltype == "วินมอเตอร์ไซต์") {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>Taxi</option>
                                                                                <?php if ($status_table[$i]->withdraw_traveltype != "รถยนต์ส่วนบุคคล" && $status_table[$i]->withdraw_traveltype != "รถไฟฟ้า" && $status_table[$i]->withdraw_traveltype != "วินมอเตอร์ไซต์" && $status_table[$i]->withdraw_traveltype != "Taxi") { ?>
                                                                                    <option value="<?php echo $status_table[$i]->withdraw_traveltype; ?>" data-id="4" <?php if ($status_table[$i]->withdraw_traveltype != "รถยนต์ส่วนบุคคล" && $status_table[$i]->withdraw_traveltype != "รถไฟฟ้า" && $status_table[$i]->withdraw_traveltype != "วินมอเตอร์ไซต์" && $status_table[$i]->withdraw_traveltype != "Taxi") {
                                                                                                                                                                            echo "selected";
                                                                                                                                                                        } ?>><?php echo $status_table[$i]->withdraw_traveltype; ?></option>
                                                                                <?php } ?>

                                                                                <option value="อื่น ๆ" data-id="5">อื่น ๆ</option>
                                                                            </select><br>
                                                                            <label for="selectTypec"> ประเภทการเดินทาง</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-floating">
                                                                                <input type="text" class="form-control" id="showOthertype<?php echo $i ?>" name="type" value="<?php echo $status_table[$i]->withdraw_traveltype; ?>">
                                                                                <label for="showOthertype<?php echo $i ?>" style="margin-left: 12px;"> ประเภทการเดินทาง</label>
                                                                            </div><br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-floating"">
                                                                    <textarea class=" form-control" id="reason" name="reason" required style="height:100px; text-align: left;" placeholder=""><?php echo $status_table[$i]->withdraw_reason; ?></textarea>
                                                                                <label for="reason">เหตุผลการเบิก</label>
                                                                            </div>
                                                                        </div>
                                                                    </div><br>
                                                                    <input type="hidden" name="emp_id" value="<?php echo $status_table[$i]->withdraw_number; ?>">
                                                                    <div class="modal-footer mt-3">
                                                                        <button class="btn btn-danger" type="reset" style="width:200px; margin-right:20px; margin-bottom:20px;" onclick="javascript:location.href = '<?php echo site_url("/TRS_V_status"); ?>'" > ยกเลิก </button>
                                                                        <button class="btn btn-secondary" type="submit" name="action" value="save" style="width:200px; margin-right:20px; margin-bottom:20px;"> บันทึกแบบร่าง </button>
                                                                        <button class="btn btn-success" type="submit" name="action" value="send" style="width:200px; margin-right:20px; margin-bottom:20px;"> ยืนยัน </button>

                                                                    </div>
                                                            </form>
                                                        </div>
                                                    <?php } else { ?>
                                                        <a href="#" class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $i; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                </div>
            </div>
        </div>
    </div>


    </div>


    <!-- Modal -->
    <div class="modal fade" id="detail_<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> รายละเอียดการเบิกค่าเดินทาง หมายเลข <?php echo $status_table[$i]->withdraw_number; ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="font-family: 'Sarabun', sans-serif;" id="modal_pdf<?php echo $i; ?>">
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
                            <div class="col-6">ชื่อ-นามสกุล <b><?php echo $status_table[$i]->emp_firstname . " " . $status_table[$i]->emp_lastname ?></b></div>
                            <div class="col-6">ตำแหน่ง <b><?php echo $status_table[$i]->dep_name ?></b></div>
                        </div><br>
                        <div class="row" align="left">
                            <div class="col-6">วันที่ขอเบิก <b><?php echo $status_table[$i]->withdraw_date ?></b></div>
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
                                    <td align="center"><?php echo $status_table[$i]->withdraw_number;  ?></td>
                                    <td align="center"><?php echo $status_table[$i]->withdraw_datetravel;  ?></td>
                                    <td align="left"><?php echo $status_table[$i]->withdraw_reason;  ?></td>
                                    <td align="right"><?php echo number_format($status_table[$i]->withdraw_amount, 2);  ?></td>
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
                                    (<b><?php echo $status_table[$i]->emp_firstname . " " . $status_table[$i]->emp_lastname ?></b>)
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width:150px;">ยกเลิก</button>
                    <button type="button" class="btn btn-secondary" style="width:150px;" onclick="generatePDF('modal_pdf<?php echo $i; ?>')">Export PDF</button>
                </div>
            </div>
        </div>
    </div>
    </td>


    </tr>
<?php
                            }
?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Modal แสดงรายละเอียด -->
<div class="modal fade" id="detail" tabindex="-1" ">
        <div class=" modal-dialog modal-dialog-centered">
    <div class="modal-content shadow" style="border-radius:10px;">
        <div align="right" style="padding: 8px;">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div align="center" style="font-size:25px; font-weight:bold;">
            รายละเอียดข้อมูลการเบิก
        </div>
        <div class="modal-body">
            <table class="table table-bordered" align="center" style="width: 350px;">
                <tbody align="left">
                    <tr>
                        <td>
                            <div style="width: 100px;">รหัสการเบิก</div>
                        </td>
                        <td>********</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 100px;">วันที่ยื่นเบิก</div>
                        </td>
                        <td>20/03/2565</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 100px;">รหัสผู้ขอเบิก</div>
                        </td>
                        <td>63160019</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 100px;">ระยะทาง</div>
                        </td>
                        <td>10 กิโลเมตร</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 100px;"> ราคาน้ำมัน</div>
                        </td>
                        <td>39.95 ฿</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 100px;">จำนวนเงิน</div>
                        </td>
                        <td>300.00 ฿</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 100px;">ไฟล์แนบ</div>
                        </td>
                        <td>ชื่อไฟล์.pdf</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width: 100px;">เหตุผลการเบิก</div>
                        </td>
                        <td>เดินทางไปทำงานนอกสถานที่</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php echo $num."----------------------------------------------------------------------------1";?>
</div><!-- Modal แสดงรายละเอียด -->
</div> <!-- container -->

<script>
    
    $(document).ready(function() {
          for(let i=0;i< <?php echo $num; ?>; i++){
            $('#showOthertype'+i).hide();
          }
        });
    

    function selectOthertype(target) {
        console.log("ssssssssssssssssssssssss" + $('#selectType'+target).find(':selected').data('id'));
        if ($('#selectType'+target).find(':selected').data('id') == 5) {
            $('#showOthertype'+target).show();
        } else {
            $('#showOthertype'+target).hide();
        }
    }
</script>
</body>

</html>