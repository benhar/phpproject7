<?php

include('header.php');
$basepath = "http://localhost/php";
if( $_SESSION['logged_in_user'] == '' || !isset($_SESSION['logged_in_user'])){

    $msg = array(
        'class' => 'danger',
        'message' => 'Please login first'
    );
    $_SESSION['message'] = $msg;
    header('Location: login.php');
}


$db = new DB(); 
$user_data = $db->table('student_admission')->where(['email'=>$_SESSION['logged_in_user']])->result();

$student_ledger = getStudentLedger();



function getStudentLedger(){
    $db = new DB();

    if($_SESSION['logged_in_user'] != null) {
        $user = $db->table('student_admission')->select('*')->where(['email' => $_SESSION['logged_in_user']])->result();

        if($user){
            $course = $db->table('courses')->select('*')->where(['id'=> $user['course']])->result();

            return $array = array(
              'total_fees' => $course['total_fees'],
                'paid_amount' => $user['paid_amount'],
                'due_amount' => $user['due_amount']
            );
        }else{
            return '';
        }
    }
}

$paid_sems = getStudentPaidSems();
function getStudentPaidSems(){
    $db = new DB();
    $user = $db->table('student_admission')->select('*')->where(['email' => $_SESSION['logged_in_user']])->result();
    return $paid_sems = $db->table('payment_history')->where(['student_id'=>$user['id']])->results();
}

$student_pay_history  = getStudentPayHistory();

//var_dump($student_pay_history); exit();
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


function getStudentPayHistory() {
    $db = new DB();
    $student = $db->table('student_admission')->where(['email'=>$_SESSION['logged_in_user']])->result();

    $query = "SELECT 
                payment_history.`payment_amount` AS 'Amount', payment_history.`pay_date` AS 'Date' , transactions.`tran_id` as 'Transaction ID', courses.`course_name` AS 'Course Name', payment_history.`semester` AS 'Semester'
                FROM payment_history
                JOIN transactions ON payment_history.`payment_id` = transactions.`id`
                RIGHT JOIN courses ON transactions.`course_id` = courses.`id`
                WHERE payment_history.student_id=".$student['id'];

    $db->custom_sql($query);
    $student_data = $db->data;
    $data_array = array();
    while($row = mysql_fetch_array($student_data)){
        array_push($data_array, $row);
    }
    return $data_array;
}

function getCourseName($id){
    $db = new DB();
    $data = $db->table('courses')->where(['id'=>$id])->result();
    return $data['course_name'];
}

?>


<div class="main-content col-md-12">

    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php if(isset($user_data['student_thumb'])){ echo $basepath."/uploads/".$user_data['student_thumb'];} else{echo 'http://placehold.it/300x300';} ?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo $user_data['applicant_name']; ?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo $user_data['email'] ?>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <a href="logout.php" class="btn btn-info btn-lg">
                        <span class="glyphicon glyphicon-log-out"></span> Log out
                    </a>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav nav-stacked">
                        <li class="active">
                                <a data-toggle="tab" href="#menu1">
                                <i class="glyphicon glyphicon-home"></i>
                                Overview </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#results">
                                <i class="glyphicon glyphicon-user"></i>
                                Results </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#payments">
                                <i class="glyphicon glyphicon-ok"></i>
                                Payments </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9 tab-content">

            <?php echo notice_box(); ?>

<!--            OVERVIEW OF USER PROFILE       -->
            <div class="tab-pane fade in active" id="menu1">
                <h4>Course Information</h4>
                <table class="table table-bordered table-hovered table-striped">
                    <tr>
                        <td><strong>Course Name</strong></td>
                        <td><?php echo getCourseName($user_data['course']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Campus</strong></td>
                        <td><?php echo $user_data['campus']; ?></td>
                    </tr>

                </table>


                <h4>Personal Information</h4>
                <table class="table table-bordered table-hovered table-striped">
                    <tr>
                        <td><strong>Full Name</strong></td>
                        <td><?php echo $user_data['applicant_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Fathers Name</strong></td>
                        <td><?php echo $user_data['father_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date of birth</strong></td>
                        <td><?php echo date('d-M-Y', strtotime($user_data['birth_date'])); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Gender</strong></td>
                        <td><?php echo $user_data['gender']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Home District</strong></td>
                        <td><?php echo $user_data['district']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Present Address</strong></td>
                        <td><?php echo $user_data['present_address']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact Number</strong></td>
                        <td><?php echo $user_data['contact_no']; ?></td>
                    </tr>
                </table>


                <h4>Educational Background</h4>
                <h5>SSC</h5>
                <table class="table table-bordered table-hovered table-striped">
                    <?php if($user_data['ssc_type'] == 'ssc'){?>
                    <tr>
                        <td><strong>SSC Group</strong></td>
                        <td><?php echo $user_data['ssc_group']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>SSC Board</strong></td>
                        <td><?php echo $user_data['ssc_board']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>SSC Passing Year</strong></td>
                        <td><?php echo $user_data['ssc_passing_year']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>SSC GPA</strong></td>
                        <td><?php echo $user_data['ssc_gpa']; ?></td>
                    </tr>
                    <?php } elseif($user_data['ssc_type'] == 'o_level'){?>
                        <tr>
                            <td><strong>O Level Group</strong></td>
                            <td><?php echo $user_data['ssc_group']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>SSC Board</strong></td>
                            <td><?php echo $user_data['ssc_board']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>SSC Passing Year</strong></td>
                            <td><?php echo $user_data['ssc_passing_year']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>SSC GPA</strong></td>
                            <td><?php echo $user_data['ssc_gpa']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <h5>HSC</h5>
                <table class="table table-bordered table-hovered table-striped">
                    <tr>
                        <td><strong>HSC Group</strong></td>
                        <td><?php echo $user_data['hsc_group']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>HSC Board</strong></td>
                        <td><?php echo $user_data['hsc_board']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>HSC Passing Year</strong></td>
                        <td><?php echo $user_data['hsc_passing_year']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>HSC GPA</strong></td>
                        <td><?php echo $user_data['hsc_gpa']; ?></td>
                    </tr>
                </table>


            </div>
            <!-- Result Tab Content -->
            <div class="tab-pane fade" id="results">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading">Academic Result</h2>
                    <div class="row">
                        <div class="col-md-3 pull-right">
                            <div class="form-group">
                                <input class="result_student_id" type="hidden" name="result_student_id" value="<?php echo $user_data['id']?>">
                                <select class="form-control result_sems" name="result_sems">
                                    <?php for($i=1; $i<13; $i++){?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <tr class="success">
                                <th class="text-center">Subject</th>
                                <th class="text-center">Credit</th>
                                <th class="text-center">CGPA</th>
                            </tr>
                            </thead>
                            <tbody class="result_trs">
                            <tr>
                                <td></td>
                                <td></th>
                                <td></th>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Payments Tab Content -->
            <div class="tab-pane fade" id="payments">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading">Student Ledger</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped table-condensed table-bordered table-hovered">
                                <tbody>
                                <tr>
                                    <td><strong>Total Payable</strong></td>
                                    <td><?php echo $student_ledger['total_fees']; ?> BDT</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Paid</strong></td>
                                    <td><?php echo $student_ledger['paid_amount']; ?> BDT</td>
                                </tr>
                                <tr>
                                    <td><strong>Due</strong></td>
                                    <td><?php echo $student_ledger['due_amount']; ?>BDT</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>

                    <div class="row">
                        <form action="pay_process.php" method="POST">
                        <div class="col-md-4">
                            <label for="">Select a semester/admission to pay</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="semester_id">
<!--                                    --><?php //if($user_data['admission_paid'] == 0){ ?>
<!--                                    <option value="1001">Admission - 50000</option>-->
<!--                                    --><?php //} ?>

                                    <?php
                                    $i = 1;
                                    $isAdmission = 0;
                                    $countAdmission = 0;
                                    for($i = 1; $i<13; $i++) {
                                        $check = 0;
                                        foreach ($paid_sems as $p) {
                                            if ($p['semester'] == $i) {
                                                $check = 1;
                                            }
                                            if($p['semester'] == 127){
                                                $isAdmission = 1;
                                            }
                                        }
                                        if($isAdmission == 1){}else{
                                            if($countAdmission < 1) {
                                                ?>

                                                <option value="127">Admission - 50000</option>
                                                <?php
                                                $countAdmission++;
                                            }
                                        }
                                        if($check){}else{
                                                ?>
                                                <option
                                                    value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success">Pay Now</button>
                        </div>
                        </form>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <tr class="active">
                                <th class="text-center">Transaction ID</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Course Name</th>
                                <th class="text-center">Semester</th>
                                <th class="text-center">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($student_pay_history as $pay){ ?>
                                <tr>
                                    <td><?php echo $pay['Transaction ID']; ?></td>
                                    <td><?php echo $pay['Date']; ?></th>
                                    <td><?php echo $pay['Course Name']; ?></td>
                                    <td><?php if($pay['Semester'] != ''){echo  $pay['Semester']; }else{echo  'Admission';} ?></th>
                                    <td><?php echo $pay['Amount']; ?></td>
                                 </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div>

<?php
include ('footer.php');
?>
