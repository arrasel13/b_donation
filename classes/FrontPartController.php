<?php
include_once 'admin/db/connection.php';
include_once 'FrontPartProcess.php';

//$process = new FrontPartProcess;

class FrontPartController
{


    public function becomeADoner($fname,$lname,$display_name,$email,$contact_no,$gender,$contact_address,$additional_info,$password,$c_password){
        $data = [];
        $data['fname'] = $fname;
        $data['lname'] = $lname;
        $data['display_name'] = $display_name;
        $data['email'] = $email;
        $data['contact_no'] = $contact_no;
        $data['gender'] = $gender;
        $data['contact_address'] = $contact_address;
        $data['additional_info'] = $additional_info;
        $data['password'] = $password;
        $data['c_password'] = $c_password;

        $sendInfo =

    }
}