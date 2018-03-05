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
elseif(isset($_POST) && isset($_POST['submit_result_addition']) ){
    $req = $_REQUEST;
    if($req['course'] != '' && $req['select_batch'] != '' && $req['semester'] != '' && $req['select_subject'] != '' && $req['cgpa'] != '' && $req['result_student_id']){
        $db = new DB();
        $student = $req['result_student_id'];
        $course = $req['course'];
        $batch = $req['select_batch'];
        $sems = $req['semester'];
        $subject = $req['select_subject'];
        $cgpa = $req['cgpa'];


        $chk_dup = $db->table('results')
            ->where([
                'student_id'=>$student,
                'subject_id'=>$subject,
                'semester'=>$sems,
                'batch_no' => $batch,
                'course_id' =>$course
            ])->result();
        $count = $db->count();
        if($count == 0) {
            $data = array(
                'cgpa' => $cgpa,
                'student_id' => $student,
                'subject_id' => $subject,
                'semester' => $sems,
                'batch_no' => $batch,
                'course_id' => $course,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth_user()['id']
            );

            $db->table('results')->insert($data);
            if($db){
                $_SESSION['message_bag'] = "Result Successfully added";
                $_SESSION['class'] = 'success';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else{

            }
        }
        else{
            $_SESSION['message_bag'] = "Result already exists";
            $_SESSION['class'] = 'danger';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    else{
        $_SESSION['message_bag'] = "Please fill all field with proper data";
        $_SESSION['class'] = 'danger';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


elseif(isset($_POST) && isset($_POST['submit_parent_addition']) ){
    $req = $_REQUEST;
    if($req['parent_name'] != '' && $req['parent_no'] != '' && $req['parent_email'] != '' && $req['parent_pass'] != '' && $req['parent_student_id'] != ''){
        $db = new DB();
        $name = $req['parent_name'];
        $no = $req['parent_no'];
        $email = $req['parent_email'];
        $pass = $req['parent_pass'];
        $id = $req['parent_student_id'];


        $chk_dup = $db->table('student_admission')
            ->where([
                'id'=>$id,
            ])->result();
        $count = $db->count();
        if($count > 0) {
            $data = array(
                'name' => $name,
                'contact_number' => $no,
                'email' => $email,
                'password' => $pass,
                'created_at' => date('Y-m-d H:i:s'),
            );

            $db->table('parents')->insert($data);
            if($db){
                $_SESSION['message_bag'] = "Parents Successfully added";
                $_SESSION['class'] = 'success';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else{
                $_SESSION['message_bag'] = "Parents addition failed";
                $_SESSION['class'] = 'danger';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        else{
            $_SESSION['message_bag'] = "No student found with this id";
            $_SESSION['class'] = 'danger';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    else{
        $_SESSION['message_bag'] = "Please fill all field with proper data";
        $_SESSION['class'] = 'danger';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

elseif(isset($_POST) && isset($_POST['get_batch_of_course']) ){
    if(isset($_POST['course_id'])){
        $course_id = $_POST['course_id'];
        echo getCurrentBatchNo($course_id);
    }
}
elseif(isset($_POST) && isset($_POST['get_result_of_course']) ){
    if(isset($_POST['semester'])){
        $sems = $_POST['semester'];
        $student = $_POST['student_id'];
        echo json_encode(getResult($student, $sems));
    }
}
elseif(isset($_POST) && isset($_POST['get_subject_of_course']) ){
    if(isset($_POST['course_id']) && isset($_POST['semester_id'])){
        $course_id = $_POST['course_id'];
        $semester_id = $_POST['semester_id'];

        $data = array(
            'subjects' => getSubejctsOfSemester($course_id, $semester_id),
            'students' => getStudentsOfCourse($course_id, $semester_id)
        );
        echo json_encode($data);
    }
    else{

    }
}


function getCourses(){
    $db = new DB();
    return $db->table('courses')->select('*')->results();
}
function getSubjects(){
    $db = new DB();
    return $db->table('subjects')->select('*')->results();
}

function getStudents(){
    $db = new DB();
    return $db->table('student_admission')->select('*')->results();
}
function getusers(){
    $db = new DB();
    return $db->table('admin_panel')->select('*')->results();
}
function getSemesters(){
    $db = new DB();
    return $db->table('semesters')->select('*')->results();
}
function getCurrentBatchNo($course_id){
    $db = new DB();
    $course = $db->table('courses')->select('*')->where(['id'=>$course_id])->result();
    return $course['next_batch_no'];
}
function getSubejctsOfSemester($course_id, $semester_id){
    $db = new DB();
    $course = $db->table('subjects')->select('*')->where(['course_id'=>$course_id, 'semester'=>$semester_id])->results();
    return $course;
}
function getStudentsOfCourse($course_id, $semester_id){
    $db = new DB();
    $students = $db->table('student_admission')->select('*')->where(['course'=>$course_id, 'cur_semester'=>$semester_id])->results();
    return $students;
}
function getResult($student, $sems){
    $mysql = "SELECT * FROM results JOIN subjects ON results.`subject_id` = subjects.`id` WHERE results.`student_id` = $student AND results.`semester`=$sems";
    $q = mysql_query($mysql);
    $arr = array();
    while($row = mysql_fetch_array($q)){
        array_push($arr, $row);
    }
    return $arr;
}
function CourseName($data){
    $q = "SELECT * FROM courses where id='".mysql_real_escape_string($data)."'";
    $exe = mysql_query($q);
    $data = mysql_fetch_assoc($exe);
    return $data['course_name'];
}


function auth_user(){
    $user_email = $_SESSION['logged_in_user'];
    if($user_email != '') {
        $db = new DB();
        return $user = $db->table('admin_panel')->where(['email' => $user_email])->result();
    }
    else{
        return '';
    }
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
