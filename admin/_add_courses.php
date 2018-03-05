<?php
//session_start();
//
//$email = $_SESSION['logged_in_user'];
//
//include('../DB.php');
//$db = new DB();
//
//$user = $db->table('users')->where(array('email'=>$email))->result();
//
//
//if(isset($_POST) && isset($_POST['create_course'])) {
//    $data = array();
//    $data['course_name'] = $_POST['course_name'];
//    $data['total_fees'] = $_POST['total_fees'];
//    $data['semester_fee'] = $_POST['semester_fee'];
//    $data['created_by'] = $user['id'];
//    $data['created_at'] = date('d-m-Y H:i:s');
//
//    $store = $db->table('courses')->insert($data);
//
//    if($store){
//        //echo $db->print_error();
//        echo "Course created successfully";
//    }
//    else{
//        echo "Unable to create a course";
//    }
//}
//
//?>
<!---->
<!--<html>-->
<!--<head>-->
<!---->
<!--</head>-->
<!--<body>-->
<!--<form action="#" method="POST">-->
<!--    <div class="form-group">-->
<!--        <label for="">Course Name</label>-->
<!--        <input type="text" name="course_name" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="">Total Fees</label>-->
<!--        <input type="text" name="total_fees" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="">Semester Fee</label>-->
<!--        <input type="text" name="semester_fee" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <input type="submit" name="create_course" class="form-control" value="Create">-->
<!--    </div>-->
<!--</form>-->
<!--</body>-->
<!--</html>-->