<?php

namespace App\Models;

use CodeIgniter\Model;

class TRS_M_withdraw extends Model
{
    public function insertWithdraw(
        $withdraw_date,
        $withdraw_time,
        $withdraw_datetravel,
        $withdraw_reason,
        $withdraw_amount,
        $withdraw_status,
        $withdraw_distance,
        $withdraw_traveltype,
        $withdraw_startlocation,
        $lon1,
        $lat1,
        $withdraw_stoplocation,
        $lon2,
        $lat2,
        $withdraw_fuel,
        $withdraw_emp_id
    ) {

        $sql = "INSERT INTO withdrawal_document (withdraw_date, withdraw_time,
        withdraw_datetravel, withdraw_reason, withdraw_amount, withdraw_status, 
        withdraw_distance, withdraw_traveltype, withdraw_startlocation, 
        withdraw_startlon, withdraw_startlat, withdraw_stoplocation, withdraw_stoplon,
        withdraw_stoplat, withdraw_fuel, emp_id)
        VALUES ('" . $withdraw_date . "','" . $withdraw_time . "','" . $withdraw_datetravel .
            "', '" . $withdraw_reason . "', '" . $withdraw_amount . "', '" . $withdraw_status .
            "','" . $withdraw_distance . "', '" . $withdraw_traveltype . "','" . $withdraw_startlocation .
            "','" . $lon1 . "', '" . $lat1 . "', '" . $withdraw_stoplocation . "', '" . $lon2 . "','" . $lat2 .
            "', '" . $withdraw_fuel . "', '" . $withdraw_emp_id . "'); ";
        $this->db->query($sql);
    }
}
