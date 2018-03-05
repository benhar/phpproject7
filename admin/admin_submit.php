<?php
/**
 * Created by PhpStorm.
 * User: rasel
 * Date: 6/3/2016
 * Time: 9:27 PM
 */

session_start();
include('../DB.php');




if(isset($_POST['submit_course_info'])){
    $req = $_REQUEST;

    $db = new DB();


    if(isset($_REQUEST['course_name'])) {
        $search_course = $db->table('courses')->select('course_name')->where(['course_name' => $_REQUEST['course_name']])->result();
        $count = $db->count();

        if($count == 0){

            $data_array = array(
                'course_name' => isset($req['course_name']) && $req['course_name'] != '' ? $req['course_name'] : '',
                'total_fees' => isset($req['total_fees']) && $req['total_fees'] != '' ? $req['total_fees'] : '',
                'semester_fee' => isset($req['semester_fee']) && $req['semester_fee'] != '' ?  $req['semester_fee'] : '',
                'created_by' => isset($req['created_by']) && $req['created_by'] != '' ?  $req['created_by'] : '',
                'created_at' => isset($req['created_at']) && $req['created_at'] != '' ?  $req['created_at'] : '',
            );

            $db->table('courses')->insert($data_array);
            if($db){
                $msg = array(
                    'class' => 'success',
                    'message' => $_REQUEST['course_name'].' is added successfully'
                );
                $_SESSION['message_bag'] = $msg;
                header('Location: admin_dashboard.php');
            }
            else{
                $msg = array(
                    'class' => 'danger',
                    'message' => $_REQUEST['course_name'].' is added successfully'
                );
                $_SESSION['message_bag'] = $msg;
                header('Location: admin_dashboard.php');

            }
        }
        else{
            $msg = array(
                'class' => 'danger',
                'message' => $_REQUEST['course_name'].' is already exists'
            );
            $_SESSION['message_bag'] = $msg;
            header('Location: admin_dashboard.php');
        }
    }




}





if(isset($_POST['submit_subject_addition'])){
    $req = $_REQUEST;

    $db = new DB();


    if(isset($_REQUEST['subject_name'])) {
        $search_subject = $db->table('subjects')->select('subject_name')->custom_where(" subject_name='".$req['subject_name']."' AND course_id='".$req['course']."'")->result();
        $count = $db->count();

        if($count == 0){

            $data_array = array(
                'subject_name' => isset($req['subject_name']) && $req['subject_name'] != '' ? $req['subject_name'] : '',
                'subject_credit' => isset($req['subject_credit']) && $req['subject_credit'] != '' ? $req['subject_credit'] : '',
                'course_id' => isset($req['course']) && $req['course'] != '' ?  $req['course'] : '',
                'semester' => isset($req['semester']) && $req['semester'] != '' ?  $req['semester'] : '',
                'created_at' => isset($req['created_at']) && $req['created_at'] != '' ?  $req['created_at'] : '',
                'created_by' => isset($req['created_by']) && $req['created_by'] != '' ?  $req['created_by'] : '',
            );

            $db->table('subjects')->insert($data_array);
            if($db){

                $_SESSION['message_bag'] = $req['subject_name']." is added succesfully";
                $_SESSION['class'] = 'success';
                header('Location: admin_dashboard.php');
            }
            else{

                $_SESSION['message_bag'] = "Unable to add";
                $_SESSION['class'] = 'danger';
                header('Location: admin_dashboard.php');

            }
        }
        else{

            $_SESSION['message_bag'] = $req['subject_name']." is duplicate or already exists";
            $_SESSION['class'] = 'danger';
            header('Location: admin_dashboard.php');
        }
    }




}