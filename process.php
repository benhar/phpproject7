<?php
/**
 * Created by PhpStorm.
 * User: rasel
 * Date: 5/27/2016
 * Time: 9:11 PM
 */
include('DB.php');

$db = new DB();

if(isset($_REQUEST)){
    $data = $_REQUEST;

    $name = $_REQUEST['full_name'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $email = $_REQUEST['email'];
    $mobile_no = $_REQUEST['mobile_no'];

    $_REQUEST['password'] = md5($_REQUEST['password']);


    if(validate($name) && validate($username) && validate($password)){
        $db->table('users')->insert($_REQUEST);
        $db->print_error();
        if($db){
            echo 'Signed Up';
        }
        else {
            echo "failed";
        }
    }
    else{
        echo 'One or more null parameters given';
    }







}




function validate($input){
    if(!empty($input)){
        return true;
    }
    elseif($input != ''){
        return true;
    }
    else{
        return false;
    }
}


