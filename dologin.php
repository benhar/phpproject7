<?php
/**
 * Created by PhpStorm.
 * User: rasel
 * Date: 6/3/2016
 * Time: 9:27 PM
 */

session_start();
include('DB.php');

if(isset($_POST['submit_login'])){
    $req = $_REQUEST;

    $db = new DB();


    if(isset($_REQUEST['email'])) {


        if(isset($_REQUEST['level'])) {

            $level = $_REQUEST['level'];

            if($level == 'student') {
                $search_email = $db->table('student_admission')->select('*')->where(['email' => $_REQUEST['email']])->result();
                $count = $db->count();
                $location = "dashboard.php";
            }
            elseif($level == 'parent'){
                $search_email = $db->table('parents')->select('*')->where(['email' => $_REQUEST['email']])->result();
                $count = $db->count();
                $location = "parents/parents_dashboard.php";
            }
            elseif($level == 'admin'){
                $search_email = $db->table('admin_panel')->select('*')->where(['email' => $_REQUEST['email']])->result();
                $count = $db->count();
                $location = "admin/admin_dashboard.php";
            }
            else{
                $msg = array(
                    'class' => 'danger',
                    'message' => 'Please select valid level'
                );
                $_SESSION['message'] = $msg;
                header('Location: login.php');
            }

            if ($count == 1) {
                if ($search_email['password'] == $_REQUEST['password']) {
                    $_SESSION['logged_in_user'] = $_REQUEST['email'];
                    header("Location: $location");
                } else {
                    $msg = array(
                        'class' => 'danger',
                        'message' => 'Your password is incorrect'
                    );
                    $_SESSION['message'] = $msg;
                    header('Location: login.php');
                }
            } else {
                $msg = array(
                    'class' => 'danger',
                    'message' => $_REQUEST['email'] . ' is not exists'
                );
                $_SESSION['message'] = $msg;
                header('Location: login.php');
            }
        }
        else{

        }
    }
    
    
    
    
    
    













}