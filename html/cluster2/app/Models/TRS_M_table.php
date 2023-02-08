<?php

namespace App\Models;

use CodeIgniter\Model;

class TRS_M_table extends Model
{
public function getTable() {
    $sql = "SELECT withdraw_date , withdraw_time ,withdraw_number , withdraw_reason , withdraw_amount , withdraw_status FROM `withdrawal_document` WHERE withdraw_status=3 ORDER BY withdraw_number ASC;";
    return $this->db->query($sql)->getResult();
}

}