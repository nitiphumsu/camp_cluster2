<?php

namespace App\Models;

use CodeIgniter\Model;

class TRS_M_approve extends Model
{
    public function getTable()
    {
        $sql = "SELECT withdraw_date , withdraw_time ,withdraw_number , withdraw_reason , withdraw_amount , withdraw_status 
        FROM `withdrawal_document`
        WHERE withdraw_status=2
        ORDER BY withdraw_number ASC;";
        return $this->db->query($sql)->getResult();
    }

    public function get_detail($target)
    {
        $sql = 'SELECT employee.emp_firstname, employee.emp_lastname, department.dep_name, withdrawal_document.withdraw_date, withdrawal_document.withdraw_number, withdrawal_document.withdraw_datetravel, withdrawal_document.withdraw_amount
        FROM employee INNER JOIN department INNER JOIN withdrawal_document
        ON employee.emp_id = withdrawal_document.emp_id AND employee.dep_id = department.dep_id
        WHERE withdrawal_document.withdraw_number = "' . $target . '";';
        return $this->db->query($sql)->getResult();
    }
    
    public function add_approve($arr_insert, $withdraw_number)
    {
        $today_date = $arr_insert['today_date'];
        $today_time = $arr_insert['today_time'];
        $reject_reason = $arr_insert['reject_reason'];
        $user_id = $arr_insert['user_id'];
        $status_approve = 1;
        echo $status_approve;

        if ($arr_insert['btn_action'] == 0) {
            $word_reason = $reject_reason;
            $status_approve = 0;
        }

        $data = [
            'approve_date' => $today_date,
            'approve_time'  => $today_time,
            'approve_reason'  => $word_reason,
            'withdraw_number'  => $withdraw_number,
            'approve_emp_id'  => $user_id,
        ];
        $this->db->table('approval_document')->insert($data);


        $sql = "UPDATE  withdrawal_document SET withdraw_status='$status_approve' WHERE withdraw_number='$withdraw_number' ";
        $this->db->query($sql);
    }
    //Notification
    public function getNotification()
    {
        $sql = 'SELECT approval_document.approve_number, approval_document.approve_date, withdrawal_document.withdraw_number, withdrawal_document.withdraw_status 
        FROM approval_document INNER JOIN withdrawal_document 
        ON approval_document.withdraw_number = withdrawal_document.withdraw_number 
       	WHERE withdrawal_document.emp_id ="3" 
        ORDER BY approval_document.approve_number DESC;';
        return $this->db->query($sql)->getResult();
    }

}
