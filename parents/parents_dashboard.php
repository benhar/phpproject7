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
$db = new DB();
$user_data = $db->table('parents')->where(['email'=>$_SESSION['logged_in_user']])->result();

function getStudentOfParent($id) {
    $db = new DB();
    $user_data = $db->table('parents')->where(['email'=>$_SESSION['logged_in_user']])->result();
    return $db->table('student_admission')->select('*')->where(['father_contact_no'=> $user_data['contact_number']])->results();
}
function course_name($id){
    $db = new DB();
    $course = $db->table('courses')->where(['id'=>$id])->result();
    return $course['course_name'];
}


?>




    <div class="main-content col-md-12">

        <?php echo notice_box(); ?>
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                   
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

            <div class="col-md-9 tab-content">
                <!-- Students Tab Content -->
                <div class="active tab-pane fade in" id="students">
                    <div class="col-sm-12 table-responsive">
                        <h2 class="dash-sub-heading">All Students Information</h2>
                        <div class="row">

                        </div>
                        <div class="row">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                <tr class="success">
                                    <th class="text-center">Student ID</th>
                                    <th class="text-center">Course</th>
                                    <th class="text-center">Student Name</th>
                                    <th class="text-center">Campus</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Contact No</th>
                                    <th class="text-center">Present Address</th>
                                    <th class="text-center">email</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $students = getStudentOfParent($user_data['id']);
                                foreach ($students as $s){
                                    ?>


                                    <tr>
                                        <td><?php echo $s['id']; ?></td>
                                        <td><?php echo course_name($s['course']); ?></td>
                                        <th><?php echo $s['applicant_name']; ?></th>
                                        <td><?php echo $s['campus']; ?></td>
                                        <td><?php echo $s['gender']; ?></td>
                                        <td><?php echo $s['contact_no']; ?></td>
                                        <th><?php echo $s['present_address']; ?></th>
                                        <td><?php echo $s['email']; ?></td>
                                        <td><a href="student_details.php?student=<?php echo $s['id']?>" class="btn btn-info btn-sm">View</a></td>
                                    </tr>

                                <?php } ?>



                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


                <!-- Course Tab Content -->
                <div class="tab-pane fade" id="courses">
                    <div class="col-sm-12 table-responsive">
                        <h2 class="dash-sub-heading">Add New Course</h2>
                        <form action="../function.php" method="POST">
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
            </div>
        </div>
        <div>

        </div>
    </div>


<?php
include ('footer.php');
?>