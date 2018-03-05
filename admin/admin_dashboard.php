<?php

include('header.php');
if( $_SESSION['logged_in_user'] == '' || !isset($_SESSION['logged_in_user'])){

    $msg = array(
        'class' => 'danger',
        'message' => 'Please login first'
    );
    $_SESSION['message'] = $msg;
    header('Location: admin_login.php');
}
$db = new DB();
$user_data = $db->table('admin_panel')->where(['email'=>$_SESSION['logged_in_user']])->result();

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
                        <li class="active">
                            <a data-toggle="tab" href="#user">
                                <i class="glyphicon glyphicon-home"></i>
                                Users </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#students">
                                <i class="glyphicon glyphicon-user"></i>
                                Students </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#courses">
                                <i class="glyphicon glyphicon-ok"></i>
                                Course </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#subjects">
                                <i class="glyphicon glyphicon-ok"></i>
                                Subjects </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#results">
                                <i class="glyphicon glyphicon-ok"></i>
                                Results </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#parents">
                                <i class="glyphicon glyphicon-ok"></i>
                                Parents </a>
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

        <!--User panel-->

        <div class="col-md-9 tab-content">
            <div class="tab-pane fade in active" id="user">
                <h2 class="dash-sub-heading" style="margin-bottom: 40px">Admin Panel Information</h2>
                <div class="row">
                    <table id="user_datatable" class="display table user_datab table-striped table-bordered table-hover table-condensed">
                        <thead>
                        <tr class="active">
                            <th class="text-center">User ID</th>
                            <th class="text-center">User Name</th>
                            <th class="text-center">Contact Number</th>
                            <th class="text-center">email</th>
                        </tr>
                        </thead>
                        <tbody>
<!--                        --><?php
//                        $users = getUsers();
//                        foreach ($users as $u) {
//                        ?>
<!---->
<!--                        <tr>-->
<!--                            <td>--><?php //echo $u['id'];?><!--</td>-->
<!--                            <td>--><?php //echo $u['name'];?><!--</td>-->
<!--                            <td>--><?php //echo $u['contact_number'];?><!--</td>-->
<!--                            <td>--><?php //echo $u['email'];?><!--</td>-->
<!---->
<!--                        </tr>-->
<!--                            --><?php //} ?>
                        </tbody>

                    </table>
                </div>
            </div>


            <!-- Students Tab Content -->
            <div class="tab-pane fade" id="students">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading">All Students Information</h2>
                    <div class="row">

                    </div>
                    <div class="row">
                        <table class="table student_datab table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <tr class="success">
                                <th class="text-center">Student ID</th>
                                <th class="text-center none">Course</th>
                                <th class="text-center none">Campus</th>
                                <th class="text-center">Student Name</th>
                                <th class="text-center">Father Name</th>
                                <th class="text-center none">Mother Name</th>
                                <th class="text-center none">Gender</th>
                                <th class="text-center none">Birth Date</th>
                                <th class="text-center">Contact No</th>
                                <th class="text-center none">Country</th>
                                <th class="text-center">District</th>
                                <th class="text-center">SSC GPA</th>
                                <th class="text-center none">SSC BOARD</th>
                                <th class="text-center">SSC PASSING YEAR</th>
                                <th class="text-center none">SSC ENGLISH RESULT</th>
                                <th class="text-center">EMAIL</th>
                                <th class="text-center">BATCH NUMBER</th>
                                <th class="text-center">Created At</th>
                            </tr>
                            </thead>
                            <tbody>
<!--                            --><?php
//
//                                $students = getStudents();
//                                foreach ($students as $s){
//                                    ?>
<!---->
<!---->
<!--                                    <tr>-->
<!--                                        <td>--><?php //echo $s['id']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $s['course']; ?><!--</td>-->
<!--                                        <th>--><?php //echo $s['applicant_name']; ?><!--</th>-->
<!--                                        <td>--><?php //echo $s['campus']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $s['gender']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $s['contact_no']; ?><!--</td>-->
<!--                                        <th>--><?php //echo $s['present_address']; ?><!--</th>-->
<!--                                        <td>--><?php //echo $s['email']; ?><!--</td>-->
<!--                                    </tr>-->
<!---->
<!--                                --><?php //} ?>



                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


            <!-- Course Tab Content -->
            <div class="tab-pane fade" id="courses">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading">Add New Course</h2>
                    <form action="function.php" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New Course Name</label>
                                <input type="text" class="form-control" name="new_course_name" id="entercoursename" placeholder="Enter New Course Name">
                            </div>
                            <div class="form-group">
                                <label>Total Cost</label>
                                <input type="text" class="form-control" name="total_cost" id="totalcost" placeholder="Enter Total Cost">
                            </div>
                            <div class="form-group">
                                <label>Semester Fees</label>
                                <input type="text" class="form-control" name="semester_fee" id="semesterfee" placeholder="Enter Semester Fee">
                            </div>
                            <button type="submit" name="submit_student_info" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-12 table-responsive">

                    <h2 class="dash-sub-heading" style="margin-top: 25px">All Course Information</h2>

                    <div class="row">

                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <tr class="active">
                                <th class="text-center">Course Name</th>
                                <th class="text-center">Total Cost</th>
                                <th class="text-center">Semester Fees</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $courses = getCourses();
                                foreach ($courses as $c) {
                                    ?>
                                    <tr>
                                        <td><?php echo $c['course_name']; ?></td>
                                        <td><?php echo $c['total_fees']; ?></td>
                                        <td><?php echo $c['semester_fee']; ?></td>
                                        <th><a href="<?php echo $c['id']; ?>"><i class="fa fa-flag"></i></a></th>
                                    </tr>
                                    <?php
                                }
                                    ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Subject Tab Content -->
            <div class="tab-pane fade" id="subjects">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading">Add New Subjects</h2>
                    <form action="admin_submit.php" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Course</label>
                                <select name="course" id="select_course" class="form-control">
                                    <option value="0">Select Course</option>
                                    <?php
                                    $courses = getCourses();
                                    foreach ($courses as $c) {
                                        ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo $c['course_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Semester</label>
                                <select name="semester" id="select_sems" class="form-control">
                                    <option value="0">Select Semester</option>
                                    <?php
                                    for($i=1; $i<13; $i++) {
                                        ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Enter subject name</label>
                                <input type="text" class="form-control" name="subject_name" id="semesterfee" placeholder="Enter Semester Fee">
                            </div>
                            <div class="form-group">
                                <label>Enter subject credit</label>
                                <input type="text" class="form-control" name="subject_credit" id="semesterfee" placeholder="Enter Semester Fee">
                            </div>
                            <button type="submit" name="submit_subject_addition" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-12 table-responsive">

                    <h2 class="dash-sub-heading" style="margin-top: 25px">All Subjects Information</h2>

                    <div class="row">

                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <tr class="active">
                                <th class="text-center">Subject Name</th>
                                <th class="text-center">Total Credit</th>
                                <th class="text-center">Course Name</th>
                                <th class="text-center">Semester</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $subjects = getSubjects();
                            foreach ($subjects as $s) {
                                ?>
                                <tr>
                                    <td><?php echo $s['subject_name']; ?></td>
                                    <td><?php echo $s['subject_credit']; ?></td>
                                    <td><?php echo CourseName($s['course_id']); ?></td>
                                    <td><?php echo $s['semester']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Subject Tab Content -->
            <div class="tab-pane fade" id="results">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading">Add A Result</h2>
                    <form action="function.php" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Course</label>
                                <select name="course" class="form-control result_select_course">
                                    <option value="0">Select Course</option>
                                    <?php
                                    $courses = getCourses();
                                    foreach ($courses as $c) {
                                        ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo $c['course_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Batch no.</label>
                                <select name="select_batch" id="select_batch" class="form-control result_select_batch">
                                    <option value="0">Select Batch no</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Semester</label>
                                <select name="semester" id="select_sems" class="form-control result_select_sems">
                                    <option value="0">Select Semester</option>
                                    <?php
                                    for($i=1; $i<13; $i++) {
                                        ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select a Subject</label>
                                <select name="select_subject" id="select_subject" class="form-control result_select_subject">
                                    <option value="0">Select a Subject no</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Student ID</label>
                                <select name="result_student_id" id="result_student_id" class="form-control result_student_id">
                                    <option value="0">Select a Student ID</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Enter CGPA</label>
                                <input type="text" class="form-control" name="cgpa" id="" placeholder="Enter CGPA">
                            </div>
                            <button type="submit" name="submit_result_addition" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--Parents -->
            <div class="tab-pane fade" id="parents">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading">Add A Parent</h2>
                    <form action="function.php" method="POST">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="parent_name" id="" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="parent_no" id="" placeholder="Enter Number">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="parent_email" id="" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="parent_pass" id="" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label>Student ID</label>
                                <input type="text" class="form-control" name="parent_student_id" id="" placeholder="Enter ID">
                            </div>
                            <button type="submit" name="submit_parent_addition" class="btn btn-success">Submit</button>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="dash-sub-heading">All Parents</h2>
                            <table class="table parents_datab table-striped table-bordered table-hover table-condensed">
                                <thead>
                                <tr class="active">
                                    <th class="text-center">ID</th>
                                    <th>Name</th>
                                    <th class="text-center">Contact Number</th>
                                    <th class="text-center">Email</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--Payments -->
            <div class="tab-pane fade" id="payments">
                <div class="col-sm-12 table-responsive">
                    <h2 class="dash-sub-heading" style="margin-top: 25px">All Payment Information</h2>

                    <div class="row">

                        <table class="table payments_datab table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <tr class="active">
                                <th class="text-center">ID</th>
                                <th class="text-center">Student Name</th>
                                <th>Semester</th>
                                <th class="text-center">Payment ID</th>
                                <th class="text-center">Payment Amount</th>
                                <th class="text-center">Pay Date</th>
                            </tr>
                            </thead>
<!--                            <tbody>-->
<!--                            --><?php
//                            $subjects = getSubjects();
//                            foreach ($subjects as $s) {
//                                ?>
<!--                                <tr>-->
<!--                                    <td>--><?php //echo $s['subject_name']; ?><!--</td>-->
<!--                                    <td>--><?php //echo $s['subject_credit']; ?><!--</td>-->
<!--                                    <td>--><?php //echo $s['course_id']; ?><!--</td>-->
<!--                                    <td>--><?php //echo $s['semester']; ?><!--</td>-->
<!--                                    <th><a href="--><?php //echo $s['id']; ?><!--"><i class="fa fa-flag"></i></a></th>-->
<!--                                </tr>-->
<!--                                --><?php
//                            }
//                            ?>
<!--                            </tbody>-->

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