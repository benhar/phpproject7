<?php

include('header.php');
if( $_SESSION['logged_in_user'] == '' || !isset($_SESSION['logged_in_user'])){

    $msg = array(
        'class' => 'danger',
        'message' => 'Please login first'
    );
    $_SESSION['message'] = $msg;
    header('Location: parents_login.php');
}

if(isset($_GET['student']) && $_GET['student'] != '') {

    $db = new DB();
    $user_data = $db->table('parents')->where(['email' => $_SESSION['logged_in_user']])->result();

    $student = $db->table('student_admission')->where(['id'=>$_GET['student']])->result();

    function getStudentOfParent($id) {
        $db = new DB();
        return $db->table('student_admission')->select('*')->where(['parent_id' => $id])->results();
    }
    function course_name($id)
    {
        $db = new DB();
        $course = $db->table('courses')->where(['id' => $id])->result();
        return $course['course_name'];
    }

//var_dump($student_pay_history); exit();

    function getPayHistory($id) {
        $db = new DB();

        $query = "SELECT
                payment_history.`payment_amount` AS 'Amount', payment_history.`pay_date` AS 'Date' , transactions.`tran_id` as 'Transaction ID', courses.`course_name` AS 'Course Name', payment_history.`semester` AS 'Semester'
                FROM payment_history
                JOIN transactions ON payment_history.`payment_id` = transactions.`id`
                RIGHT JOIN courses ON transactions.`course_id` = courses.`id`
                WHERE payment_history.student_id=".$id;

        $db->custom_sql($query);
        $student_data = $db->data;
        $data_array = array();
        while($row = mysql_fetch_array($student_data)){
            array_push($data_array, $row);
        }
        return $data_array;
    }

    function getStudentLedger($id){
        $db = new DB();

        if($_SESSION['logged_in_user'] != null) {
            $user = $db->table('student_admission')->select('*')->where(['id' => $id])->result();

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

    $student_ledger = getStudentLedger($student['id']);
    $student_pay_history  = getPayHistory($student['id']);
}
else{
    echo "Please select a student"; exit();
}
?>




    <div class="main-content col-md-12">

        <?php echo notice_box(); ?>
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="images/<?php echo $user_data['image_url']; ?>" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php echo $user_data['name']; ?>
                        </div>
                        <div class="profile-usertitle-job">
                            <?php echo $user_data['email'] ?>
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <a href="../logout.php" class="btn btn-info btn-lg">
                            <span class="glyphicon glyphicon-log-out"></span> Log out
                        </a>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav nav-stacked">
                            <li>
                                <a class="active" data-toggle="tab" href="#students">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Students </a>
                            </li>

                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>

            <!--User panel-->
            <div class="col-md-9">
                <div class="tab-pane fade in active" id="students">
                    <div class="col-sm-12 table-responsive">
                        <h2 class="dash-sub-heading">Student Info</h2>
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <div class="form-group">
                                    <p><?php echo $student['applicant_name']; ?></p>
                                </div>
                            </div>
                        </div>
                        <h2 class="dash-sub-heading">Academic Result</h2>
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <div class="form-group">
                                    <input class="result_student_id" type="hidden" name="result_student_id" value="<?php echo $student['id']?>">
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
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 table-responsive">
                        <div class="row">
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
                                <?php
                                if(count($student_pay_history) == 0){
                                    echo "<td colspan='5'>No Payments found..</td>";
                                }

                                foreach ($student_pay_history as $pay){ ?>
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

        </div>
    </div>


<?php
include ('footer.php');
?>