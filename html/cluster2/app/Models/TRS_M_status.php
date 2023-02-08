<?php

namespace App\Models;

use CodeIgniter\Model;

class TRS_M_status extends Model
{

    public function getTableStatus()
    {
        $sql = 'SELECT * FROM `withdrawal_document` INNER JOIN employee ON withdrawal_document.emp_id = employee.emp_id INNER JOIN department ON department.dep_id = employee.dep_id WHERE (withdraw_status = 3 OR withdraw_status = 2 ) AND employee.emp_id = 3;';

        return $this->db->query($sql)->getResult();
    }

    // public function getEditWithdraw($id)
    // {
    //     $sql = "SELECT * FROM `withdrawal_document` INNER JOIN employee ON withdrawal_document.emp_id = employee.emp_id 
    //             INNER JOIN department ON department.dep_id = employee.dep_id WHERE withdraw_number = '$id'";
    //     return $this->db->query($sql)->getResult();
    // }

   public function editTable($travel, $reason, $id, $status){
        $sql = "UPDATE `withdrawal_document` SET `withdraw_traveltype` = '". $travel ."' WHERE `withdrawal_document`.`withdraw_number` = ". $id .";" ;
        $this->db->query($sql);
        $sql = "UPDATE `withdrawal_document` SET `withdraw_reason` = '". $reason ."' WHERE `withdrawal_document`.`withdraw_number` = ". $id .";" ;
        $this->db->query($sql);
        $sql = "UPDATE `withdrawal_document` SET `withdraw_status` = '". $status ."' WHERE `withdrawal_document`.`withdraw_number` = ". $id .";" ;
        $this->db->query($sql);
    }
}
