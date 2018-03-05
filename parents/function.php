<?php
session_start();
include('../DB.php');
$db = new DB();

if(isset($_POST) && isset($_POST['submit_student_info'])){
    $req = $_POST;

    //var_dump($req);
//    new_course_name
//total_cost
//semester_fee

    $course_name = (isset($_POST['new_course_name']) && $_POST['new_course_name'] != '') ? $_POST['new_course_name'] : '';
    $total_cost = (isset($_POST['total_cost']) && $_POST['total_cost'] != '') ? $_POST['total_cost'] : '';
    $semester_fee = (isset($_POST['semester_fee']) && $_POST['semester_fee'] != '') ? $_POST['semester_fee'] : '';

    if($course_name != '' && $total_cost != '' && $semester_fee != ''){

        $search_name = $db->table('courses')->select('*')->where(['course_name' => $_POST['new_course_name']])->result();
        $count = $db->count();

        if($count == 0) {
            $course = array(
                'course_name' => $course_name,
                'total_fees' => $total_cost,
                'semester_fee' => $semester_fee
            );
            $db->table('courses')->insert($course);

            if ($db) {

                $_SESSION['message_bag'] = "Course created successfully";
                $_SESSION['class'] = 'success';
                header('Location: admin_dashboard.php');
            } else {

                $_SESSION['message_bag'] = "Unable to create this course. Try again";
                $_SESSION['class'] = 'danger';
                header('Location: admin_dashboard.php');
            }
        }
        else{
            $_SESSION['message_bag'] = "Duplicate course name. Try again";
            $_SESSION['class'] = 'danger';
            header('Location: admin_dashboard.php');
        }

    }
    else {
        $_SESSION['message_bag'] = "Empty inputs. Need course name, Total cost, Semester fee";
        $_SESSION['class'] = 'danger';

        header('Location: admin_dashboard.php');

    }

}




function getCourses(){
    $db = new DB();
    return $db->table('courses')->select('*')->results();
}

function getStudents(){
    $db = new DB();
    return $db->table('student_admission')->select('*')->results();
}
function getusers(){
    $db = new DB();
    return $db->table('admin_panel')->select('*')->results();
}




function notice_box(){
    if(isset($_SESSION['message_bag']) && $_SESSION['message_bag'] != '' && $_SESSION['class'] && $_SESSION['class'] != ''){?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-<?php echo $_SESSION['class']; ?>"><?php echo $_SESSION['message_bag']; ?></div>
            </div>
        </div>

        <?php

        $_SESSION['message_bag'] = "";
        $_SESSION['class'] = "";
    }
}
