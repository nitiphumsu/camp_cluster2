<?php

namespace App\Models;

use CodeIgniter\Model;

class TRS_M_Dashboard extends Model
{
    public function getRagedate($old, $new){
        $target1 = strtotime($new);
        $target2 = strtotime($old);
        $datediff = $target1 - $target2;
        //echo "target1:" . $target1 ."-- target2:" . $target2 ."---- rage:". round($datediff / (60 * 60 * 24));
        // echo round($datediff / (60 * 60 * 24));
        return round($datediff / (60 * 60 * 24));
    }

    public function getDashboard(){
        $sql = "SELECT withdraw_date, SUM(withdraw_amount) AS 'total' FROM withdrawal_document WHERE withdraw_status = 1 GROUP BY withdraw_date ORDER BY withdraw_date DESC;";
        return $this->db->query($sql)->getResult();
    }
    public function getDashStatus(){
        $sql = "SELECT withdrawal_document.withdraw_status, approval_document.approve_date
        FROM withdrawal_document INNER JOIN approval_document
        ON withdrawal_document.withdraw_number = approval_document.withdraw_number;";
        return $this->db->query($sql)->getResult();
    }
    public function gettraveltype(){
        $sql = "SELECT withdraw_traveltype FROM withdrawal_document;";
        return $this->db->query($sql)->getResult();
    }
}