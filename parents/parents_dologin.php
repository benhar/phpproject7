<?php
/**
 * Created by PhpStorm.
 * User: rasel
 * Date: 6/3/2016
 * Time: 9:27 PM
 */

include "header.php";

if(isset($_POST['submit_login'])){
    $req = $_REQUEST;


    $db = new DB();


    if(isset($_REQUEST['email'])) {
        $search_email = $db->table('parents')->select('*')->where(['email' => $_REQUEST['email']])->result();



        $count = $db->count();

        if($count == 1){

            if($search_email['password'] == $_REQUEST['password']){

                $_SESSION['logged_in_user'] = $_REQUEST['email'];
                header('Location: parents_dashboard.php');
            }
            else{
                $msg = array(
                    'class' => 'danger',
                    'message' => 'Your password is incorrect'
                );
                $_SESSION['message'] = $msg;
                header('Location: parents_login.php');
            }
        }
        else{
            $msg = array(
                'class' => 'danger',
                'message' => $_REQUEST['email'].' is not exists'
            );
            $_SESSION['message'] = $msg;
            header('Location: parents_login.php');
        }
    }



}