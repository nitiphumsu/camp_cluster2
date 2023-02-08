<?php

namespace App\Models;

use CodeIgniter\Model;


class TRS_M_History extends Model
{
    //for get all history in database

    public function getAllHistory()
    {
        $sql = "SELECT withdrawal_document.withdraw_status , approval_document.approve_number, withdrawal_document.withdraw_number, approval_document.approve_date, withdrawal_document.withdraw_time, withdrawal_document.withdraw_reason , approval_document.approve_reason, approval_document.approve_emp_id, withdrawal_document.withdraw_amount, employee.emp_firstname, employee.emp_lastname
        FROM approval_document INNER JOIN withdrawal_document 
        ON approval_document.withdraw_number = withdrawal_document.withdraw_number
        INNER JOIN employee
        ON withdrawal_document.emp_id = employee.emp_id
        ORDER BY approval_document.approve_number DESC;";

        return $this->db->query($sql)->getResult();
    }
    public function getHistory($target)
    {
        $sql = "SELECT withdrawal_document.withdraw_status , approval_document.approve_number, withdrawal_document.withdraw_number, approval_document.approve_date, withdrawal_document.withdraw_time, withdrawal_document.withdraw_reason , approval_document.approve_reason, approval_document.approve_emp_id, withdrawal_document.withdraw_amount, employee.emp_firstname, employee.emp_lastname
        FROM approval_document INNER JOIN withdrawal_document 
        ON approval_document.withdraw_number = withdrawal_document.withdraw_number
        INNER JOIN employee
        ON withdrawal_document.emp_id = employee.emp_id
        WHERE withdrawal_document.emp_id ='". $target .
        "' ORDER BY approval_document.approve_number DESC;
        ";

        return $this->db->query($sql)->getResult();
    }
    //for get withdraw detail in database
    public function getWithdraw($target)
    {
        $sql = 'SELECT employee.emp_firstname, employee.emp_lastname, department.dep_name, withdrawal_document.withdraw_date, withdrawal_document.withdraw_number, withdrawal_document.withdraw_datetravel, withdrawal_document.withdraw_amount , withdrawal_document.withdraw_reason
        FROM employee INNER JOIN department INNER JOIN withdrawal_document
        ON employee.emp_id = withdrawal_document.emp_id AND employee.dep_id = department.dep_id
        WHERE withdrawal_document.withdraw_number = "' . $target . '";';
        return $this->db->query($sql)->getResult();
    }
    public function getWithdraw_all()
    {
        $sql = 'SELECT employee.emp_firstname, employee.emp_lastname, department.dep_name, withdrawal_document.withdraw_date, withdrawal_document.withdraw_number, withdrawal_document.withdraw_datetravel, withdrawal_document.withdraw_amount , withdrawal_document.withdraw_reason
        FROM employee INNER JOIN department INNER JOIN withdrawal_document
        ON employee.emp_id = withdrawal_document.emp_id AND employee.dep_id = department.dep_id;';
        return $this->db->query($sql)->getResult();
    }
    //for get employee approve
    public function getApprove($target)
    {
        $sql = "SELECT approval_document.approve_number, employee.emp_firstname, employee.emp_lastname
        FROM approval_document INNER JOIN employee
        ON approval_document.approve_emp_id = employee.emp_id 
        WHERE approval_document.withdraw_number = " . $target . ";";
        return $this->db->query($sql)->getResult();
    }
    public function getApprove_all()
    {
        $sql = "SELECT approval_document.approve_number, employee.emp_firstname, employee.emp_lastname
        FROM approval_document INNER JOIN employee
        ON approval_document.approve_emp_id = employee.emp_id ;";
        return $this->db->query($sql)->getResult();
    }
    //Notification
    public function getNotificationAll()
    {
        $sql = 'SELECT approval_document.approve_number, approval_document.approve_date, withdrawal_document.withdraw_number, withdrawal_document.withdraw_status 
        FROM approval_document INNER JOIN withdrawal_document 
        ON approval_document.withdraw_number = withdrawal_document.withdraw_number 
        WHERE withdrawal_document.emp_id ="3" 
        ORDER BY approval_document.approve_number DESC;';

        $sql = 'SELECT withdrawal_document.withdraw_number, withdrawal_document.withdraw_date, withdrawal_document.withdraw_status 
        FROM withdrawal_document 
        WHERE withdrawal_document.withdraw_status ="2" 
        ORDER BY withdrawal_document.withdraw_number DESC;';
        return $this->db->query($sql)->getResult();
    }
    public function getNotification()
    {
        $sql = 'SELECT withdrawal_document.withdraw_number, withdrawal_document.withdraw_date, withdrawal_document.withdraw_status 
        FROM withdrawal_document 
        ORDER BY withdrawal_document.withdraw_number DESC;';
        return $this->db->query($sql)->getResult();
    }
}
