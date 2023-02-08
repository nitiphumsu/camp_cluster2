<?php

namespace App\Controllers;

use App\Models\TRS_M_login;
use App\Models\TRS_M_dashboard;
use App\Models\TRS_M_History;
use App\Models\TRS_M_status;
use App\Models\TRS_M_approve;
use App\Models\TRS_M_withdraw;

class TRS_C_Clicknext extends BaseController
{
    public function index()
    {
        return view('TRS_V_login');
    }

    public function login()
    {
        return view('TRS_V_login');
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION["user"]);
        unset($_SESSION["status"]);
        unset($_SESSION["position"]);
        return redirect()->to(base_url() . "/TRS_V_login");
    }
    //check login by email and password
    // รหัสผ่านแปลงมาโดยวิธี RSA
    public function check_login()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('pass');
        // echo "email:" . $email . " password:" . $password . "<br>";
        $encryption = new TRS_M_login();
        // echo "encrypt email:" . $email . " password:" . $encryption->encrypt($email, $password) . "<br>";
        $pass = $encryption->encrypt($email, $password);

        if ($encryption->login($email, $pass)) {
            // $user = $encryption->getData($email);
            $_SESSION["user"] = $encryption->getData($email);
            $_SESSION["status"] = 1;
            $_SESSION["position"] = $encryption->getPosition($_SESSION["user"][0]->dep_id);

            // echo $_SESSION["user"][0]->dep_id ." ". $_SESSION["status"] ." ". $_SESSION["position"][0]->dep_name ." <br>";
            // exit(0);
            if ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager") {
                return redirect()->to(base_url() . "/TRS_V_approve");
            } else {
                return redirect()->to(base_url() . "/TRS_V_status");
            }
        } else {
            // echo "no passssssssssssssssssssssss";
            return redirect()->to(base_url() . "/TRS_C_Clicknext/login");
        }
        // exit(0);
    }
    public function status()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SESSION["status"] == null || $_SESSION["user"] == null || $_SESSION["position"] == null) {
            return redirect()->to(base_url() . "/TRS_V_login");
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager")) {
            $db_status = new TRS_M_status();
            $data['status_table'] = $db_status->getTableStatus();
            $noti = new TRS_M_History();
            $data['noti'] = $noti->getNotification();
            echo view('TRS_V_status', $data);
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager")) {
            return view("TRS_V_dashboard");
        }
    }

    public function edit()
    {
        //edit ข้อมูลประเภทเอกสารแบบร่าง
        $reason =  $this->request->getPost('reason');
        $id = $this->request->getPost(('emp_id'));
        if ($this->request->getPost('travel_type') == "อื่น ๆ") {
            $type =   $this->request->getPost('type');
        } else {
            $type = $this->request->getPost('travel_type');
        }
        if ($_POST['action'] == 'save') {
            //if click button บันทึกแบบร่าง 
            $status = 3;
        } else if ($_POST['action'] == 'send') {
            // if click button ยืนยัน
            $status = 2;
        }
        echo "reason" . $reason . "---id:" . $id . "---type:" . $type . "--startus:" . $status . "<br>";
        // exit();

        $db = new TRS_M_status();
        $db->editTable($type, $reason, $id, $status);
        return redirect()->to(base_url() . "/TRS_V_status");
    }

    public function dashboard()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["status"]) || !isset($_SESSION["user"]) ||  !isset($_SESSION["position"])) {
            return redirect()->to(base_url() . "/TRS_V_login");
        } else if ($_SESSION["status"] == 1 && $_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager") {
            return redirect()->to(base_url() . "/TRS_V_status");
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager")) {
            $db = new TRS_M_Dashboard();
            $dash = $db->getDashboard();
            $data['pieChart'] = $db->getDashStatus();
            $travel_type = $db->gettraveltype();
            // ---------------------------------------------------------------- //
            //pie chart traveltype
            $private_car = 0;
            $train = 0;
            $motorcycle = 0;
            $taxi = 0;
            $count = 0;

            for ($j = 0; $j < count($travel_type); $j++) {
                if ($travel_type[$j]->withdraw_traveltype == "รถยนต์ส่วนตัว") {
                    $private_car++;
                } else if ($travel_type[$j]->withdraw_traveltype == "รถไฟฟ้า") {
                    $train++;
                } else if ($travel_type[$j]->withdraw_traveltype == "วินมอเตอร์ไซต์") {
                    $motorcycle++;
                } else if ($travel_type[$j]->withdraw_traveltype == "taxi") {
                    $taxi++;
                } else {
                    $count++;
                }
                // echo $j. $travel_type[$j]->withdraw_traveltype."<br>";
            }
            // echo $travel_type[0]->withdraw_traveltype."<br>";
            $data['private_car'] = $private_car;
            $data['train'] = $train;
            $data['motorcycle'] = $motorcycle;
            $data['taxi'] = $taxi;
            $data['count'] = $count;
            // ---------------------------------------------------------------- //
            //line chart withdraw

            $year = (int)substr(date("Y-m-d"), 0, 4);
            $month = substr(date("Y-m-d"), 0, 7);
            $month = (int)substr($month, 5, 7);
            $date = (int)substr(date("Y-m-d"), 8, 8);

            $i = 0;
            if ((int)$db->getRagedate($dash[count($dash) - 1]->withdraw_date, $dash[0]->withdraw_date) % 7 != 0) {

                $round = (int)$db->getRagedate($dash[count($dash) - 1]->withdraw_date, $dash[0]->withdraw_date);
                $checkloop = true;
                do {
                    $round++;
                    if ($round % 7 == 0) {
                        $checkloop = false;
                    }
                } while ($checkloop);

                $data["date"] = array();
                $data["total"] = array();
                $index = 0;
                for ($i = 0; $i < $round; $i++) {
                    if ($date < 10) {
                        if ($month < 10) {
                            $tempdate = $year . "-0" . $month . "-0" . $date;
                            $tempdateforset = "0" . $date . "/0" . $month . "/" . $year;
                        } else {
                            $tempdate = $year . "-" . $month . "-0" . $date;
                            $tempdateforset = "0" . $date . "/" . $month . "/" . $year;
                        }
                    } else {
                        if ($month < 10) {
                            $tempdate = $year . "-0" . $month . "-" . $date;
                            $tempdateforset = $date . "/0" . $month . "/" . $year;
                        } else {
                            $tempdate = $year . "-" . $month . "-" . $date;
                            $tempdateforset = $date . "/" . $month . "/" . $year;
                        }
                    }
                    if ($index != count($dash) && $tempdate == $dash[$index]->withdraw_date) {
                        $data["date"][$i] = $tempdateforset;
                        $data["total"][$i] = (int)$dash[$index]->total;
                        //echo "_____round" . $i . "--loop date:" . $data["date"][$i] . "--- total :" . $data["total"][$i] . "---- index:" . $index . "<br>";
                        $index++;
                    } else {
                        $data["date"][$i] = $tempdateforset;
                        $data["total"][$i] = 0;
                    }

                    $date--;
                    if ($date == 0) {
                        $month--;
                        if ($month == "1" || $month == "3" || $month == "5" || $month == "7" || $month == "8" || $month == "10" || $month == "12") {
                            $date = "31";
                        } else if ($month == "2") {
                            if (($year % 4) == 0 && $date > 0) {
                                if ($date > 29) {
                                    $date = "29";
                                } else {
                                    $date = "28";
                                }
                            }
                        } else {
                            $date = "30";
                        }
                        if ($month < 10) {
                            $tempsetdate = date("Y-m-t", strtotime($year . "-0" . $month . "-01"));;
                        } else {
                            $tempsetdate = date("Y-m-t", strtotime($year . "-" . $month . "-01"));
                        }

                        if ($month == 0) {
                            $year--;
                            $month = 12;
                        }
                    }

                    //echo "round" . $i . "--loop date:" . $data["date"][$i] . "--- total :" . $data["total"][$i] . "<br>";
                }
            } else {
                //echo "false :" . (int)$db->getRagedate($dash[count($dash) - 1]->withdraw_date, $dash[0]->withdraw_date) % 7 . "<br>";
            }
            // ---------------------------------------------------------------- //
            //pie chart approve
            $statusPass = 0; //สถานะคำขอเบิกที่ผ่านการอนุมัติ
            $statusNonPass = 0; //สถานะคำขอเบิกที่ไม่ผ่านการอนุมัติ 
            $year = (int)substr(date("Y-m-d"), 0, 4);
            $month = substr(date("Y-m-d"), 0, 7);
            $month = (int)substr($month, 5, 7);
            $date = (int)substr(date("Y-m-d"), 8, 8);
            $tmp_date = "";
            if ((int)$date < 10) {
                $tmp_date = $year . "-0" . $month . "-0" . $date;
            }
            if ((int)$month < 10) {
                $tmp_date = $year . "-0" . $month . "-" . $date;
            }
            for ($j = 0; $j < count($data['pieChart']); $j++) {
                if ($data['pieChart'][$j]->withdraw_status == 1) {
                    $statusPass++;
                } else {
                    $statusNonPass++;
                }
            }

            $data['statusPass'] = $statusPass;
            $data['statusNonPass'] = $statusNonPass;
            // ---------------------------------------------------------------- /


            $noti = new TRS_M_History();
            $data['noti'] = $noti->getNotification();
            return view('TRS_V_dashboard', $data);
        }
    }

    public function withdraw()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SESSION["status"] == null || $_SESSION["user"] == null || $_SESSION["position"] == null) {
            return redirect()->to(base_url() . "/TRS_V_login");
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager")) {
            $noti = new TRS_M_History();
            $data['noti'] = $noti->getNotificationAll();
            echo view("TRS_V_withdraw", $data);
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager")) {
            return redirect()->to(base_url() . "/TRS_V_dashboard");
        }
    }
    public function add_withdraw()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $db_withdraw = new TRS_M_withdraw;
        $withdraw_date = date("Y-m-d");
        $withdraw_time = date("H:i:s");
        $withdraw_datetravel = $this->request->getPost('travel_date');
        $withdraw_reason = $this->request->getPost('reason');
        $withdraw_fuel = $this->request->getPost('oil_price');
        $temp = $this->request->getPost('distance_map');
        $withdraw_distance = number_format($temp, 2, '.', '');
        $withdraw_amount = number_format((($withdraw_fuel / 7) + 2) * $withdraw_distance, 2, '.', '');
        if ($this->request->getPost('travel_type') == "อื่น ๆ") {
            $withdraw_traveltype = $this->request->getPost('travel_typeinput');
        } else {
            $withdraw_traveltype = $this->request->getPost('travel_type');
        }
        $withdraw_stratlocation = $this->request->getPost('loca_name1');
        $withdraw_stoplocation = $this->request->getPost('loca_name2');
        $emp_id = $_SESSION["user"][0]->emp_id;
        $lat1 = $this->request->getPost('lat1');
        $lat2 = $this->request->getPost('lat2');
        $lon1 = $this->request->getPost('lon1');
        $lon2 = $this->request->getPost('lon2');
        $withdraw_emp_id = $_SESSION["user"][0]->emp_id;

        if ($_POST['action'] == 'save') {
            //if click button  บันทึกแบบร่าง
            $withdraw_status = 3;
        } else if ($_POST['action'] == 'send') {
            // if click button ยืนยัน
            $withdraw_status = 2;
        }

        echo "wdate:" . $withdraw_date . " time:" . $withdraw_time . " datetravel:" . $withdraw_datetravel . " reason:" . $withdraw_reason . " amount:" . $withdraw_amount . " status:" . $withdraw_status
            . " distance:" . $withdraw_distance . " type:" . $withdraw_traveltype . " strat:" . $withdraw_stratlocation . " lat1:" . $lat1 . " lon1" . $lon1
            . " stop" . $withdraw_stoplocation . " lat2:" . $lat2 . " lon2" . $lon2 . " fuel:" . $withdraw_fuel . " emp_id:" . $withdraw_emp_id . " reason:" . $withdraw_reason . "<br>";

        // exit(0);
        $db_withdraw->insertWithdraw(
            $withdraw_date,
            $withdraw_time,
            $withdraw_datetravel,
            $withdraw_reason,
            $withdraw_amount,
            $withdraw_status,
            $withdraw_distance,
            $withdraw_traveltype,
            $withdraw_stratlocation,
            $lon1,
            $lat1,
            $withdraw_stoplocation,
            $lon2,
            $lat2,
            $withdraw_fuel,
            $withdraw_emp_id
        );
        return redirect()->to(base_url() . "/TRS_V_withdraw");
    }
    public function approve()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION["status"] == null || $_SESSION["user"] == null || $_SESSION["position"] == null) {
            return redirect()->to(base_url() . "/TRS_V_login");
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager")) {
            return redirect()->to(base_url() . "/TRS_V_dashboard");
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager")) {
            $noti = new TRS_M_History();
            $data['noti'] = $noti->getNotification();
            $db = new TRS_M_approve();
            $data['des'] = $db->getTable();
            for ($i = 0; $i < count($data['des']); $i++) {
                $data['detail' . $i] = array();
                $data['detail' . $i] = $db->get_detail($data['des'][$i]->withdraw_number);
            }

            return view('TRS_V_approve', $data);
        }
    }


    public function history()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION["status"] == null || $_SESSION["user"] == null || $_SESSION["position"] == null) {
            return redirect()->to(base_url() . "/TRS_V_login");
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name != "Project Manager" && $_SESSION["position"][0]->dep_name != "Accounting Manager")) {
            $db = new TRS_M_history();
            $data['history_table'] = $db->getHistory($_SESSION["user"][0]->emp_id);

            for ($i = 0; $i < count($data['history_table']); $i++) {
                // echo "status:" . $data['history_table'][$i]->withdraw_status . "approve_id : " . $data['history_table'][$i]->approve_number . " withdraw_id : " . $data['history_table'][$i]->withdraw_number . " date : " . $data['history_table'][$i]->approve_date . " withdraw_reason : " . $data['history_table'][$i]->withdraw_reason . " approve_reason : " . $data['history_table'][$i]->approve_reason . " approve_by : " . $data['history_table'][$i]->approve_emp_id . " total : " . $data['history_table'][$i]->withdraw_amount . "<br>";
                $data['detail' . $i] = array();
                $data['approve' . $i] = array();
                // echo "----------------wwww" . $data['history_table'][$i]->withdraw_number . "<br>";
                $data['detail' . $i] = $db->getWithdraw($data['history_table'][$i]->withdraw_number);
                $data['approve' . $i] = $db->getApprove($data['history_table'][$i]->withdraw_number);
            }
            $data['noti'] = $db->getNotification();
            echo view('TRS_V_history', $data);
        } else if ($_SESSION["status"] == 1 && ($_SESSION["position"][0]->dep_name == "Project Manager" || $_SESSION["position"][0]->dep_name == "Accounting Manager")) {
            $db = new TRS_M_history();
            $data['history_table'] = $db->getAllHistory();

            for ($i = 0; $i < count($data['history_table']); $i++) {
                $data['detail' . $i] = array();
                $data['approve' . $i] = array();
                $data['detail' . $i] = $db->getWithdraw_all();
                $data['approve' . $i] = $db->getApprove_all();
            }
            $data['noti'] = $db->getNotificationAll();
            echo view('TRS_V_history', $data);
        }
    }
    
    public function pass()
    {
        return view('password_generator');
    }

    public function test()
    {
        return view('test');
    }

    public function passShow()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $encryption = new TRS_M_login();
        $en_pass = $encryption->encrypt($email, $password);
        echo "Input Email : " . $email . "<br>";
        echo "Input Password : " . $password . "<br><hr>";
        echo "Encrypt Email : " . $email . "<br>";
        echo "Encrypt Password : " . $en_pass . "<br><hr>";
        echo "Decrypt Email : " . $email . "<br>";
        echo "Decrypt Password : " . $encryption->decrypt($email, $en_pass) . "<br><hr>";
        exit(0);
    }
    public function pdf()
    {
        return view('TRS_V_pdf_format.php');
    }

    public function map()
    {
        return view('/testbk/map');
    }

    public function add_approve()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $db = new TRS_M_approve();
        $arr_insert['today_date'] = date("Y-m-d");
        $arr_insert['today_time'] = date("H:i:s");
        $arr_insert['btn_action'] = $this->request->getPost('btn_action');
        $arr_insert['reject_reason'] = $this->request->getPost('btn_action');
        // echo  $arr_insert['reject_reason']; exit;
        $arr_insert['user_id'] =  $_SESSION["user"][0]->emp_id;
        $arr_insert['item'] = $this->request->getPost('select-item');
        foreach ($arr_insert['item'] as $val) {
            $db->add_approve($arr_insert, $val);
        }
        return redirect()->to(base_url() . "/TRS_C_Clicknext/approve");
    }
}
