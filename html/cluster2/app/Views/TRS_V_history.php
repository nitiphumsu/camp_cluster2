<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ประวัติการเบิกค่าเดินทาง</title>
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
  <!-- pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Krub:ital,wght@0,400;1,300;1,500&display=swap" rel="stylesheet">
  <!-- for set font -->

  <!-- notification -->
  <style>
    /* header
    {
      font-family: 'Lobster', cursive;
      text-align: center;
      font-size: 25px;	
    } */

    /* #info
    {
      font-size: 18px;
      color: #555;
      text-align: center;
      margin-bottom: 25px;
    } */
    .scrollbar {
      margin-top: 0px;
      margin-left: -15px;
      float: left;
      height: 350px;
      width: 330px;
      /* background: #F5F5F5; */
      overflow-y: scroll;
      margin-bottom: 0px;
    }

    /* #wrapper
    {
      text-align: center;
      width: 500px;
      margin: auto;
    } */

    /*
    *  STYLE 1
    */

    #style-1::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      border-radius: 10px;
      background-color: #F5F5F5;
    }

    #style-1::-webkit-scrollbar {
      width: 12px;
      background-color: #F5F5F5;
    }

    #style-1::-webkit-scrollbar-thumb {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
      background-color: #555;
    }
  </style>


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
  </script>

  <!-- Sidebar -->
  <div class="wrapper">
    <!-- sidebar -->
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
          <li class="failed">
            <a onclick="javascript:location.href = '<?php echo site_url("/TRS_V_approve"); ?>'">อนุมัติการเบิกค่าเดินทาง</a>
          </li>
        <?php } ?>
        <li class="active">
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

      <script>
        function selectAll(source) {
          checkboxes = document.getElementsByName('check_history_pdf');
          for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
          }
        }
      </script>
      <!-- DataTable ข้อมูลตาราง -->
      <div class="container">
      <h2><b>ประวัติการเบิก</b></h2>
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered " style="width:100%">
            <thead id="head_table">
              <tr>
              <tr style="background-color: #EE3F4C; color: white;" align="center">
                <!-- <th scope="col">
                  <div style="width: 100px;">
                    <input type="checkbox" align='center' onclick="selectAll(this)">
                  </div>
                </th> -->
                <!-- table ประวัติการเบิก -->
                <th scope="col">
                  <div style="width: 150px;">สถานะ</div>
                </th>
                <th scope="col">
                  <div style="width: 150px; ">หมายเลขการอนุมัติ</div>
                </th>
                <th scope="col">
                  <div style="width: 200px;">หมายเลขการเบิกค่าเดินทาง</div>
                </th>
                <th scope="col">
                  <div style="width: 150px;">วันที่ทำการอนุมัติ</div>
                </th>
                <th scope="col">
                  <div style="width: 150px;">เวลาที่ทำการอนุมัติ</div>
                </th>
                <th scope="col">
                  <div style="width: 100px;">เหตุผลการเบิก</div>
                </th>
                <th scope="col">
                  <div style="width: 130px;">เหตุผลการอนุมัติ</div>
                </th>
                <th scope="col">
                  <div style="width: 130px;">อนุมัติโดย</div>
                </th>
                <th scope="col">
                  <div style="width: 130px;">จำนวนเงิน</div>
                </th>
                <th scope="col">
                  <div style="width: 130px;">รายละเอียด</div>
                </th>
              </tr>

            </thead>
            <tbody>

              <?php for ($i = 0; $i < count($history_table); $i++) { ?>
                <tr>
                  <!-- <td id="check_history " align='center'>
                    <input type="checkbox" name="check_history_pdf" id="check_history_pdf">
                  </td> -->
                  <td id="<?php echo 'status' . $i; ?>" align="center" class="align-middle" >
                    <?php if ($history_table[$i]->withdraw_status == 0) {
                      echo "<span class='badge bg-danger' style='padding:10px; font-size: 14px;'>ไม่ผ่านการอนุมัติ</span>";
                    } else if ($history_table[$i]->withdraw_status == 1) {
                      echo "<span class='badge bg-success' style='padding:10px; font-size: 14px;'>ผ่านการอนุมัติ</span>";
                    } ?>
                  </td>
                  <!-- table อนุมัติ -->
                  <td align="center" id="<?php echo 'approve_id' . $i; ?>">
                    <?php
                    $len = strlen($history_table[$i]->approve_number);
                    echo "A";
                    for ($j = 1; $j <= 10 - $len; $j++) {
                      echo "0";
                    }
                    echo $history_table[$i]->approve_number; ?>
                  </td>
                  <!-- table รหัสขอเบิก -->
                  <td align="center" id="<?php echo 'withdraw_id' . $i; ?>">
                    <?php
                    $len = strlen($history_table[$i]->withdraw_number);
                    echo "W";
                    for ($j = 1; $j <= 10 - $len; $j++) {
                      echo "0";
                    }
                    echo $history_table[$i]->withdraw_number; ?>
                  </td>
                  <!-- table วันที่ -->
                  <td align="center" id="<?php echo 'date' . $i; ?>">
                    <?php
                    $year = (int)substr($history_table[$i]->approve_date, 0, 4);
                    $month = substr($history_table[$i]->approve_date, 0, 7);
                    $month = (int)substr($history_table[$i]->approve_date, 5, 7);
                    $date = (int)substr($history_table[$i]->approve_date, 8, 8);
                    //ตัดสตริง format ปี-เดือน-วัน to วัน-เดือน-ปี
                    if ($date < 10) {
                      if ($month < 10) {
                        echo "0" . $date . "-0" . $month . "-" . $year . "<br>";
                      } else {
                        echo "0" . $date . "-" . $month . "-" . $year . "<br>";
                      }
                    } else {
                      echo $date . "-" . $month . "-" . $year . "<br>";
                    }
                    //echo $date."-".$month."-".$year."<br>";
                    //echo $history_table[$i]->approve_date; 
                    ?>
                  </td>
                  <!-- table วันที่ขอเบิก -->
                  <td id="<?php echo 'withdraw_time' . $i; ?>" align="center">
                    <?php echo $history_table[$i]->withdraw_time; ?>
                  </td>
                  <!-- table เหตุผลขอเบิก -->
                  <td id="<?php echo 'withdraw_reason' . $i; ?>">
                    <?php echo $history_table[$i]->withdraw_reason; ?>
                  </td>
                  <!-- table เหตุผลอนุมัติ -->
                  <td id="<?php echo 'approve_reason' . $i; ?>">
                    <?php echo $history_table[$i]->approve_reason; ?>
                  </td>
                  <!-- table ผู้อนุมัติ -->
                  <td align="left" id="<?php echo 'approve_by' . $i; ?>">
                    <?php echo ${"approve" . $i}[0]->emp_firstname . " " . ${"approve" . $i}[0]->emp_lastname; ?>
                  </td>
                  <td id="<?php echo 'total' . $i; ?>" align="right">
                    <?php echo number_format($history_table[$i]->withdraw_amount, 2); ?>
                  </td>
                  <td id="<?php echo 'detail_button' . $i; ?>" align="center">
                    <!-- botton to read detail -->
                    <a href="#" class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#detail_<?php echo $i; ?>">ดูรายละเอียด</a> <label>&nbsp&nbsp</label>
                    <!-- Modal -->
                    <div class="modal fade" id="detail_<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg ">
                        <div class="modal-content ">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> รายละเอียดการเบิกค่าเดินทาง หมายเลข <?php echo $history_table[$i]->withdraw_number; ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" id="modal_pdf<?php echo $i; ?>" style="font-family: 'Krub', sans-serif;">
                            <!-- format pdf -->
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
                                    <td align="center"><?php echo ${"detail" . $i}[0]->withdraw_number;  ?></td>
                                    <td align="center"><?php echo ${"detail" . $i}[0]->withdraw_datetravel;  ?></td>
                                    <td align="center"><?php echo ${"detail" . $i}[0]->withdraw_reason;  ?></td>
                                    <td align="right"><?php echo ${"detail" . $i}[0]->withdraw_amount = number_format(${"detail" . $i}[0]->withdraw_amount, 2);  ?></td>
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
                                    ( <?php echo ${"approve" . $i}[0]->emp_firstname . " " . ${"approve" . $i}[0]->emp_lastname; ?> )
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
</body>

</html>