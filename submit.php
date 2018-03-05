<?php
/**
 * Created by PhpStorm.
 * User: rasel
 * Date: 6/3/2016
 * Time: 9:27 PM
 */

session_start();
include('DB.php');




if(isset($_POST['submit_student_info'])){
    $req = $_REQUEST;

    //var_dump($req); exit();
    $db = new DB();

    if(isset($_REQUEST['email'])) {
        $search_email = $db->table('student_admission')->select('*')->where(['email' => $_REQUEST['email']])->result();
        $count = $db->count();
        $search_batch = $db->table('courses')->select('next_batch_no')->where(['id' => $_REQUEST['course']])->result();
        if($count == 0){

            $course = $db->table('courses')->select('*')->where(['id'=>$_REQUEST['course']])->result();

            $total_amount = isset($course['total_fees']) ? $course['total_fees'] : 0;

            if($total_amount != 0 || $total_amount != null) {
                $roll_no = $req['course'].$search_batch['next_batch_no']."00".$count;


                // File Upload
                if (isset($_FILES['student_thumb']) && $_FILES['student_thumb'] != '') {

                    $name     = $_FILES['student_thumb']['name'];
                    $tmpName  = $_FILES['student_thumb']['tmp_name'];
                    $error    = $_FILES['student_thumb']['error'];
                    $size     = $_FILES['student_thumb']['size'];
                    $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                    switch ($error) {
                        case UPLOAD_ERR_OK:
                            $valid = true;
                            //validate file extensions
                            if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
                                $valid = false;
                                $response = 'Invalid file extension.';
                            }
                            //validate file size
                            if ( $size/1024/1024 > 2 ) {
                                $valid = false;
                                $response = 'File size is exceeding maximum allowed size.';
                            }
                            //upload file
                            if ($valid) {
                                $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
                                move_uploaded_file($tmpName,$targetPath);
                                //header( 'Location: index.php' ) ;
                                //exit;



                                $data_array = array(
                                    'course' => isset($req['course']) && $req['course'] != '' ? $req['course'] : '',
                                    'campus' => isset($req['campus']) && $req['campus'] != '' ? $req['campus'] : '',
                                    'student_thumb' => $name,
                                    'applicant_name' => isset($req['applicant_name']) && $req['applicant_name'] != '' ? $req['applicant_name'] : '',
                                    'father_name' => isset($req['father_name']) && $req['father_name'] != '' ? $req['father_name'] : '',
                                    'father_contact_no' => isset($req['father_no']) && $req['father_no'] != '' ? $req['father_no'] : '',
                                    'mother_name' => isset($req['mother_name']) && $req['mother_name'] != '' ? $req['mother_name'] : '',
                                    'gender' => isset($req['gender']) && $req['gender'] != '' ? $req['gender'] : '',
                                    'birth_date' => isset($req['birth_date']) && $req['birth_date'] != '' ? $req['birth_date'] : '',
                                    'blood_group' => isset($req['blood_group']) && $req['blood_group'] != '' ? $req['blood_group'] : '',
                                    'contact_no' => isset($req['contact_no']) && $req['contact_no'] != '' ? $req['contact_no'] : '',
                                    'country' => isset($req['country']) && $req['country'] != '' ? $req['country'] : '',
                                    'district' => isset($req['district']) && $req['district'] != '' ? $req['district'] : '',
                                    'present_address' => isset($req['present_address']) && $req['present_address'] != '' ? $req['present_address'] : '',
                                    'permanent_address' => isset($req['permanent_address']) && $req['permanent_address'] != '' ? $req['permanent_address'] : '',
                                    'ssc_type' => isset($req['ssc_type']) ? $req['ssc_type'] : 'ssc',
                                    'ssc_grade' => isset($req['ssc_grade']) && $req['ssc_grade'] != '' ? $req['ssc_grade'] : '',
                                    'ssc_institute' => isset($req['ssc_institute']) && $req['ssc_institute'] != '' ? $req['ssc_institute'] : '',
                                    'ssc_board' => isset($req['ssc_board']) && $req['ssc_board'] != '' ? $req['ssc_board'] : '',
                                    'ssc_passing_year' => isset($req['ssc_passing_year']) && $req['ssc_passing_year'] != '' ? $req['ssc_passing_year'] : '',
                                    'ssc_group' => isset($req['ssc_group']) && $req['ssc_group'] != '' ? $req['ssc_group'] : '',
                                    'ssc_gpa' => isset($req['ssc_gpa']) && $req['ssc_gpa'] != '' ? $req['ssc_gpa'] : '',
                                    'ssc_english_result' => isset($req['ssc_english_result']) && $req['ssc_english_result'] != '' ? $req['ssc_english_result'] : '',
                                    'o_level_institute' => isset($req['o_level_institute']) && $req['o_level_institute'] != '' ? $req['o_level_institute'] : '',
                                    'o_level_subject1_name' => isset($req['o_level_subject1_name']) && $req['o_level_subject1_name'] != '' ? $req['o_level_subject1_name'] : '',
                                    'o_level_subject2_name' => isset($req['o_level_subject2_name']) && $req['o_level_subject2_name'] != '' ? $req['o_level_subject2_name'] : '',
                                    'o_level_subject3_name' => isset($req['o_level_subject3_name']) && $req['o_level_subject3_name'] != '' ? $req['o_level_subject3_name'] : '',
                                    'o_level_subject4_name' => isset($req['o_level_subject4_name']) && $req['o_level_subject4_name'] != '' ? $req['o_level_subject4_name'] : '',
                                    'o_level_subject5_name' => isset($req['o_level_subject5_name']) && $req['o_level_subject5_name'] != '' ? $req['o_level_subject5_name'] : '',
                                    'o_level_subject6_name' => isset($req['o_level_subject6_name']) && $req['o_level_subject6_name'] != '' ? $req['o_level_subject6_name'] : '',
                                    'o_level_subject7_name' => isset($req['o_level_subject7_name']) && $req['o_level_subject7_name'] != '' ? $req['o_level_subject7_name'] : '',
                                    'o_level_passing_year' => isset($req['o_level_passing_year']) && $req['o_level_passing_year'] != '' ? $req['o_level_passing_year'] : '',
                                    'o_level_subject1_result' => isset($req['o_level_subject1_result']) && $req['o_level_subject1_result'] != '' ? $req['o_level_subject1_result'] : '',
                                    'o_level_subject2_result' => isset($req['o_level_subject2_result']) && $req['o_level_subject2_result'] != '' ? $req['o_level_subject2_result'] : '',
                                    'o_level_subject3_result' => isset($req['o_level_subject3_result']) && $req['o_level_subject3_result'] != '' ? $req['o_level_subject3_result'] : '',
                                    'o_level_subject4_result' => isset($req['o_level_subject4_result']) && $req['o_level_subject4_result'] != '' ? $req['o_level_subject4_result'] : '',
                                    'o_level_subject5_result' => isset($req['o_level_subject5_result']) && $req['o_level_subject5_result'] != '' ? $req['o_level_subject5_result'] : '',
                                    'o_level_subject6_result' => isset($req['o_level_subject6_result']) && $req['o_level_subject6_result'] != '' ? $req['o_level_subject6_result'] : '',
                                    'o_level_subject7_result' => isset($req['o_level_subject7_result']) && $req['o_level_subject7_result'] != '' ? $req['o_level_subject7_result'] : '',
                                    'hsc_type' => isset($req['hsc_type']) && $req['hsc_type'] != '' ? $req['hsc_type'] : '',
                                    'hsc_grade' => isset($req['hsc_grade']) && $req['hsc_grade'] != '' ? $req['hsc_grade'] : '',
                                    'hsc_institute' => isset($req['hsc_institute']) && $req['hsc_institute'] != '' ? $req['hsc_institute'] : '',
                                    'hsc_board' => isset($req['hsc_board']) && $req['hsc_board'] != '' ? $req['hsc_board'] : '',
                                    'hsc_group' => isset($req['hsc_group']) && $req['hsc_group'] != '' ? $req['hsc_group'] : '',
                                    'hsc_passing_year' => isset($req['hsc_passing_year']) && $req['hsc_passing_year'] != '' ? $req['hsc_passing_year'] : '',
                                    'hsc_gpa' => isset($req['hsc_gpa']) && $req['hsc_gpa'] != '' ? $req['hsc_gpa'] : '',
                                    'hsc_english_result' => isset($req['hsc_english_result']) && $req['hsc_english_result'] != '' ? $req['hsc_english_result'] : '',
                                    'hsc_math_result' => isset($req['hsc_math_result']) && $req['hsc_math_result'] != '' ? $req['hsc_math_result'] : '',
                                    'hsc_physics_result' => isset($req['hsc_physics_result']) && $req['hsc_physics_result'] != '' ? $req['hsc_physics_result'] : '',
                                    'hsc_biology_result' => isset($req['hsc_biology_result']) && $req['hsc_biology_result'] != '' ? $req['hsc_biology_result'] : '',
                                    'a_level_institute' => isset($req['a_level_institute']) && $req['a_level_institute'] != '' ? $req['a_level_institute'] : '',
                                    'a_level_subject1_name' => isset($req['a_level_subject1_name']) && $req['a_level_subject1_name'] != '' ? $req['a_level_subject1_name'] : '',
                                    'a_level_subject2_name' => isset($req['a_level_subject2_name']) && $req['a_level_subject2_name'] != '' ? $req['a_level_subject2_name'] : '',
                                    'a_level_subject3_name' => isset($req['a_level_subject3_name']) && $req['a_level_subject3_name'] != '' ? $req['a_level_subject3_name'] : '',
                                    'a_level_subject4_name' => isset($req['a_level_subject4_name']) && $req['a_level_subject4_name'] != '' ? $req['a_level_subject4_name'] : '',
                                    'a_level_passing_year' => isset($req['a_level_passing_year']) && $req['a_level_passing_year'] != '' ? $req['a_level_passing_year'] : '',
                                    'a_level_subject1_result' => isset($req['a_level_subject1_result']) && $req['a_level_subject1_result'] != '' ? $req['a_level_subject1_result'] : '',
                                    'a_level_subject2_result' => isset($req['a_level_subject2_result']) && $req['a_level_subject2_result'] != '' ? $req['a_level_subject2_result'] : '',
                                    'a_level_subject3_result' => isset($req['a_level_subject3_result']) && $req['a_level_subject3_result'] != '' ? $req['a_level_subject3_result'] : '',
                                    'a_level_subject4_result' => isset($req['a_level_subject4_result']) && $req['a_level_subject4_result'] != '' ? $req['a_level_subject4_result'] : '',
                                    'diploma_institute' => isset($req['diploma_institute']) && $req['diploma_institute'] != '' ? $req['diploma_institute'] : '',
                                    'diploma_subject' => isset($req['diploma_subject']) && $req['diploma_subject'] != '' ? $req['diploma_subject'] : '',
                                    'diploma_grade' => isset($req['diploma_grade']) && $req['diploma_grade'] != '' ? $req['diploma_grade'] : '',
                                    'diploma_passing_year' => isset($req['diploma_passing_year']) && $req['diploma_passing_year'] != '' ? $req['diploma_passing_year'] : '',
                                    'diploma_cgpa' => isset($req['diploma_cgpa']) && $req['diploma_cgpa'] != '' ? $req['diploma_cgpa'] : '',
                                    'diploma_board' => isset($req['diploma_board']) && $req['diploma_board'] != '' ? $req['diploma_board'] : '',
                                    'email' => isset($req['email']) && $req['email'] != '' ? $req['email'] : '',
                                    'batch_no' => $search_batch['next_batch_no'],
                                    'cur_semester' => 1,
                                    'password' => isset($req['password']) && $req['password'] != '' ? $req['password'] : '',
                                    'total_amount' => $total_amount,
                                    'due_amount' => $total_amount,
                                    'created_at' => date('Y-m-d H:i:s'),
                                );

                                $db->table('student_admission')->insert($data_array);
                                if($db){
                                    $msg = array(
                                        'class' => 'success',
                                        'message' => 'Account created successfully!'
                                    );
                                    $_SESSION['message'] = $msg;
                                    header('Location: index.php');
                                }
                            }
                            else{
                                $msg = array(
                                    'class' => 'danger',
                                    'message' => 'Invalid student thumbnail!'
                                );
                                $_SESSION['message'] = $msg;
                                header('Location: index.php');
                            }
                            break;
                        case UPLOAD_ERR_INI_SIZE:
                            $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $response = 'The uploaded file was only partially uploaded.';
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            $response = 'No file was uploaded.';
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
                            break;
                        default:
                            $response = 'Unknown error';
                            break;
                    }
                }
                else{
                    $msg = array(
                        'class' => 'danger',
                        'message' => 'Provide a valid image of yours!'
                    );
                    $_SESSION['message'] = $msg;
                    header('Location: index.php');
                }
            }
            else {
                $msg = array(
                    'class' => 'danger',
                    'message' => 'Please select a course'
                );
                $_SESSION['message'] = $msg;
                header('Location: index.php');
            }
        }
        else{
            $msg = array(
              'class' => 'danger',
                'message' => $_REQUEST['email'].' is already exists'
            );
            $_SESSION['message'] = $msg;
            header('Location: index.php');
        }
    }













}