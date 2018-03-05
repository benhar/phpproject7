<?php
include('header.php');


$db = new DB();
$courses = $db->table("courses")->select("*")->results();
?>



<div class="row">
    <div class="col-md-12 page-title">
        <h1>Admission Form</h1>
    </div>
</div>
<?php if(isset($_SESSION['message'])){ ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-<?php echo $_SESSION['message']['class'];?>" role="alert">
                <p><?php echo  $_SESSION['message']['message'];?></p>
            </div>
        </div>
    </div>
<?php
    unset($_SESSION['message']);
} ?>
<div class="main-content col-md-12">
    <form id="student_admission" class="form" role="form" action="http://localhost/php/submit.php" method="POST" enctype="multipart/form-data">
        <!-- Choose course -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select desire course &nbsp;<span style="color: #f00;">*</span></label>
                    <select class="form-control" name="course" id="course" required>
                        <option value="0">Select a course</option>

                        <?php
                            foreach($courses as $c) {

                                ?>
                                <option value="<?php echo $c['id'];?>"><?php echo $c["course_name"];?></option>
                        <?php
                            }
                        ?>


                    </select>
                </div>
                <div class="form-group">
                    <label>Select campus &nbsp;<span style="color: #f00;">*</span></label>
                    <select class="form-control" name="campus" required>
                        <option value="0">Select a campus</option>
                        <option value="Main">Dhanmondi</option>
                        <option value="Permanent">Ashulia, Savar</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 pull-right">
                <div class="form-group">
<!--                    <label class="control-label">Select Your Image &nbsp;<span style="color: #f00;">*</span></label>-->
<!--                    <input id="student_thumb" name="student_thumb" type="file" class="file-loading">-->


                    <div class="kv-avatar center-block" style="width:200px">
                        <input id="student_thumb" name="student_thumb" type="file" class="file-loading" size="200" required>
                    </div>
                </div>
            </div>
        </div>

        <!--Personal Information -->

        <div class="row">
            <h3 class="block_title">Personal Information</h3>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Applicant Name &nbsp;<span style="color: #f00;">*</span></label>
                    <input type="text" class="form-control" name="applicant_name" id="entername" placeholder="Enter Your Name" required>
                </div>
                <div class="form-group">
                    <label>Father's Name &nbsp;<span style="color: #f00;">*</span></label>
                    <input type="text" class="form-control" name="father_name" id="fatherrname" placeholder="Enter Your Father's Name" required>
                </div>
                <div class="form-group">
                    <label>Father's Contact Number &nbsp;<span style="color: #f00;">*</span></label>
                    <input type="text" class="form-control" name="father_no" id="fatherrname" placeholder="Enter Your Father's Name" required>
                </div>
                <div class="form-group">
                    <label>Mother's Name</label>
                    <input type="mother_name" class="form-control" name="mother_name" id="mothername" placeholder="Enter Your Mother's Name">
                </div>
                <div class="form-group">
                    <label>Gender &nbsp;<span style="color: #f00;">*</span></label>
                    <select class="form-control" name="gender" required>
                        <option value="0">Select Your Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dtp_input2" class="control-label">Date of Birth&nbsp;<span style="color: #f00;">*</span></label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" size="16" type="text" value="" readonly required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input2" value="" name="birth_date" id="birth_date"  /><br/>
                </div>
                <div class="form-group">
                    <label>Blood Group</label>
                    <select class="form-control" name="blood_group">
                        <option value="0">Select Your Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
            </div>

            <!--Address-->

            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Number &nbsp;<span style="color: #f00;">*</span></label>
                    <input type="contact" class="form-control" name="contact_no" id="contact_no" placeholder="Enter Your Mobile Number">
                </div>
                <div class="form-group">
                    <label>Country &nbsp;<span style="color: #f00;">*</span></label>
                    <select class="form-control" name="country">
                        <option value="0">Select Your Country</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="America">America</option>
                        <option value="India">India</option>
                        <option value="Pakistan">Pakistan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Home District &nbsp;<span style="color: #f00;">*</span></label>
                    <select class="form-control" name="district">
                        <option value="0">Select Your District</option>
                        <option value="BAGERHAT">BAGERHAT</option>
                        <option value="BANDARBAN">BANDARBAN</option>
                        <option value="BARGUNA">BARGUNA</option>
                        <option value="BARISAL">BARISAL</option>
                        <option value="BHOLA">BHOLA</option>
                        <option value="BOGRA">BOGRA</option>
                        <option value="BRAHMANBARIA">BRAHMANBARIA</option>
                        <option value="CHANDPUR">CHANDPUR</option>
                        <option value="CHAPAINABABGANJ">CHAPAINABABGANJ</option>
                        <option value="CHITTAGONG">CHITTAGONG</option>
                        <option value="CHUADANGA">CHUADANGA</option>
                        <option value="COMILLA">COMILLA</option>
                        <option value="COXS BAZAR">COXS BAZAR</option>
                        <option value="DHAKA">DHAKA</option>
                        <option value="DINAJPUR">DINAJPUR</option>
                        <option value="FARIDPUR">FARIDPUR</option>
                        <option value="FENI">FENI</option>
                        <option value="GAIBANDHA">GAIBANDHA</option>
                        <option value="GAZIPUR">GAZIPUR</option>
                        <option value="GOPALGANJ">GOPALGANJ</option>
                        <option value="HABIGANJ">HABIGANJ</option>
                        <option value="JAMALPUR">JAMALPUR</option>
                        <option value="JESSORE">JESSORE</option>
                        <option value="JHALOKATI">JHALOKATI</option>
                        <option value="JHENAIDAH">JHENAIDAH</option>
                        <option value="JOYPURHAT">JOYPURHAT</option>
                        <option value="KHAGRACHHARI">KHAGRACHHARI</option>
                        <option value="KHULNA">KHULNA</option>
                        <option value="KISHOREGONJ">KISHOREGONJ</option>
                        <option value="KURIGRAM">KURIGRAM</option>
                        <option value="KUSHTIA">KUSHTIA</option>
                        <option value="LAKSHMIPUR">LAKSHMIPUR</option>
                        <option value="LALMONIRHAT">LALMONIRHAT</option>
                        <option value="MADARIPUR">MADARIPUR</option>
                        <option value="MAGURA">MAGURA</option>
                        <option value="MANIKGANJ">MANIKGANJ</option>
                        <option value="MAULVIBAZAR">MAULVIBAZAR</option>
                        <option value="MEHERPUR">MEHERPUR</option>
                        <option value="MUNSHIGANJ">MUNSHIGANJ</option>
                        <option value="MYMENSINGH">MYMENSINGH</option>
                        <option value="NAOGAON">NAOGAON</option>
                        <option value="NARAIL">NARAIL</option>
                        <option value="NARAYANGANJ">NARAYANGANJ</option>
                        <option value="NARSINGDI">NARSINGDI</option>
                        <option value="NATORE">NATORE</option>
                        <option value="NETRAKONA">NETRAKONA</option>
                        <option value="NILPHAMARI">NILPHAMARI</option>
                        <option value="NOAKHALI">NOAKHALI</option>
                        <option value="PABNA">PABNA</option>
                        <option value="PANCHAGARH">PANCHAGARH</option>
                        <option value="PATUAKHALI">PATUAKHALI</option>
                        <option value="PIROJPUR">PIROJPUR</option>
                        <option value="RAJBARI">RAJBARI</option>
                        <option value="RAJSHAHI">RAJSHAHI</option>
                        <option value="RANGAMATI">RANGAMATI</option>
                        <option value="RANGPUR">RANGPUR</option>
                        <option value="SATKHIRA">SATKHIRA</option>
                        <option value="SHARIATPUR">SHARIATPUR</option>
                        <option value="SHERPUR">SHERPUR</option>
                        <option value="SIRAJGANJ">SIRAJGANJ</option>
                        <option value="SUNAMGANJ">SUNAMGANJ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Present Address</label>
                    <textarea type="present_address" class="form-control address" name="present_address" id="present_address" placeholder="Enter Your Present Address"></textarea>
                </div>
                <div class="form-group">
                    <label>Permanent Address</label>
                    <textarea type="permanent_address" class="form-control address" name="permanent_address" id="permanent_address" placeholder="Enter Your Permanent Address"></textarea>
                </div>
            </div>

        </div>

        <!-- Academic info -->
        <div class="row">
            <h3 class="block_title">Academic Information</h3>
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#ssc" data-toggle="tab">SSC/Dakhil/Vocational &nbsp;<span style="color: #f00;">*</span></a></li>
                    <li><a href="#hsc" data-toggle="tab">HSC/Alim/Vocational &nbsp;<span style="color: #f00;">*</span></a></li>
                </ul>

                <div class="tab-content">
                    <div id="ssc" class="tab-pane active fade in">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Choose Secondary Education type</label>
                                    <label for="ssc-dakhil">
                                        <input type="radio" name="ssc_type" id="ssc-dakhil" value="ssc" checked="checked">
                                        SSC/Dakhil/Vocational
                                    </label>
                                    <label for="o-level">
                                        <input type="radio" name="ssc_type" id="o-level" value="o_level">
                                        O-Level
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ssc_container" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SSC/Dakhil/Vocational Grade &nbsp;<span style="color: #f00;">*</span></label>
                                    <select class="form-control" name="ssc_grade">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A+">A+</option>
                                        <option value="A">A</option>
                                        <option value="A-">A-</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SSC/Dakhil/Vocational Institution</label>
                                    <input type="ssc_institute_name" class="form-control" name="ssc_institute" id="institute_name" placeholder="Enter Your SSC/Dakhil/Vocational Institute Name">
                                </div>
                                <div class="form-group">
                                    <label>SSC/Dakhil/Vocational Board</label>
                                    <select class="form-control" name="ssc_board">
                                        <option value="0">Select Your Board</option>
                                        <option value="dhaka">Dhaka</option>
                                        <option value="barisal">Barisal</option>
                                        <option value="chittagong">Chittagong</option>
                                        <option value="rajshahi">Rajshahi</option>
                                        <option value="sylhet">Sylhet</option>
                                        <option value="Comilla">Comilla</option>
                                        <option value="dinajpur">Dinajpur</option>
                                        <option value="jessore">Jessore</option>
                                        <option value="madrasha">Madrasha</option>
                                        <option value="technical">Technical</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SSC/Dakhil/Vocational Passing Year</label>
                                    <select class="form-control" name="ssc_passing_year">
                                        <option value="0">Select Your Passing Year</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                        <option value="2007">2007</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SSC/Dakhil/Vocational Group</label>
                                    <select class="form-control" name="ssc_group">
                                        <option value="0">Select Your Group</option>
                                        <option value="Science">Science</option>
                                        <option value="Humanities">Humanities</option>
                                        <option value="Business-Studies">Business Studies</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SSC/Dakhil/Vocational GPA</label>
                                    <input type="gpa" class="form-control" name="ssc_gpa" id="gpa" placeholder="Enter Your SSC/Dakhil/Vocational GPA">
                                </div>
                                <div class="form-group">
                                    <label>SSC/Dakhil/Vocational English Result</label>
                                    <select class="form-control" name="ssc_english_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A+">A+</option>
                                        <option value="A">A</option>
                                        <option value="A-">A-</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row o_level_container" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">O Level Institute</label>
                                    <select class="form-control" name="o_level_institute">
                                        <option value="0">Select Your Institute</option>
                                        <option value="EDexcel">EDexcel</option>
                                        <option value="cambridge">Cambridge</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 1 Name</label>
                                    <select class="form-control" name="o_level_subject1_name">
                                        <option value="0">Select Your Subject</option>
                                        <option value="english-Literature">English Literature</option>
                                        <option value="bangla">Bangla</option>
                                        <option value="mathemetics">Mathemetics</option>
                                        <option value="additional-math">Additional Math</option>
                                        <option value="biology">Biology</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="physics">Physics</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="ict">ICT</option>
                                        <option value="computer-science">Computer Science</option>
                                        <option value="business-studies">Business Studies</option>
                                        <option value="bangladesh-studies">Bangladesh Studies</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="law">Law</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 2 Name</label>
                                    <select class="form-control" name="o_level_subject2_name">
                                        <option value="0">Select Your Subject</option>
                                        <option value="english-Literature">English Literature</option>
                                        <option value="bangla">Bangla</option>
                                        <option value="mathemetics">Mathemetics</option>
                                        <option value="additional-math">Additional Math</option>
                                        <option value="biology">Biology</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="physics">Physics</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="ict">ICT</option>
                                        <option value="computer-science">Computer Science</option>
                                        <option value="business-studies">Business Studies</option>
                                        <option value="bangladesh-studies">Bangladesh Studies</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="law">Law</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 3 Name</label>
                                    <select class="form-control" name="o_level_subject3_name">
                                        <option value="0">Select Your Subject</option>
                                        <option value="english-Literature">English Literature</option>
                                        <option value="bangla">Bangla</option>
                                        <option value="mathemetics">Mathemetics</option>
                                        <option value="additional-math">Additional Math</option>
                                        <option value="biology">Biology</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="physics">Physics</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="ict">ICT</option>
                                        <option value="computer-science">Computer Science</option>
                                        <option value="business-studies">Business Studies</option>
                                        <option value="bangladesh-studies">Bangladesh Studies</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="law">Law</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 4 Name</label>
                                    <select class="form-control" name="o_level_subject4_name">
                                        <option value="0">Select Your Subject</option>
                                        <option value="english-Literature">English Literature</option>
                                        <option value="bangla">Bangla</option>
                                        <option value="mathemetics">Mathemetics</option>
                                        <option value="additional-math">Additional Math</option>
                                        <option value="biology">Biology</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="physics">Physics</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="ict">ICT</option>
                                        <option value="computer-science">Computer Science</option>
                                        <option value="business-studies">Business Studies</option>
                                        <option value="bangladesh-studies">Bangladesh Studies</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="law">Law</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 5 Name</label>
                                    <select class="form-control" name="o_level_subject5_name">
                                        <option value="0">Select Your Subject</option>
                                        <option value="english-Literature">English Literature</option>
                                        <option value="bangla">Bangla</option>
                                        <option value="mathemetics">Mathemetics</option>
                                        <option value="additional-math">Additional Math</option>
                                        <option value="biology">Biology</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="physics">Physics</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="ict">ICT</option>
                                        <option value="computer-science">Computer Science</option>
                                        <option value="business-studies">Business Studies</option>
                                        <option value="bangladesh-studies">Bangladesh Studies</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="law">Law</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 6 Name</label>
                                    <select class="form-control" name="o_level_subject6_name">
                                        <option value="0">Select Your Subject</option>
                                        <option value="english-Literature">English Literature</option>
                                        <option value="bangla">Bangla</option>
                                        <option value="mathemetics">Mathemetics</option>
                                        <option value="additional-math">Additional Math</option>
                                        <option value="biology">Biology</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="physics">Physics</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="ict">ICT</option>
                                        <option value="computer-science">Computer Science</option>
                                        <option value="business-studies">Business Studies</option>
                                        <option value="bangladesh-studies">Bangladesh Studies</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="law">Law</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 7 Name</label>
                                    <select class="form-control" name="o_level_subject7_name">
                                        <option value="0">Select Your Subject</option>
                                        <option value="english-Literature">English Literature</option>
                                        <option value="bangla">Bangla</option>
                                        <option value="mathemetics">Mathemetics</option>
                                        <option value="additional-math">Additional Math</option>
                                        <option value="biology">Biology</option>
                                        <option value="Chemistry">Chemistry</option>
                                        <option value="physics">Physics</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="ict">ICT</option>
                                        <option value="computer-science">Computer Science</option>
                                        <option value="business-studies">Business Studies</option>
                                        <option value="bangladesh-studies">Bangladesh Studies</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="commerce">Commerce</option>
                                        <option value="law">Law</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">O Level passing year</label>
                                    <select class="form-control" name="o_level_passing_year">
                                        <option value="0">Select Your Passing Year</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                        <option value="2007">2007</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 1 Result</label>
                                    <select class="form-control" name="o_level_subject1_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 2 Result</label>
                                    <select class="form-control" name="o_level_subject2_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 3 Result</label>
                                    <select class="form-control" name="o_level_subject3_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 4 Result</label>
                                    <select class="form-control" name="o_level_subject4_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 5 Result</label>
                                    <select class="form-control" name="o_level_subject5_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 6 Result</label>
                                    <select class="form-control" name="o_level_subject6_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">O Level Subject 7 Result</label>
                                    <select class="form-control" name="o_level_subject7_result">
                                        <option value="0">Select Your Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="hsc" class="tab-pane fade">

                        <div id="ssc" class="tab-pane active fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Choose Higher Secondary Education type</label>
                                        <label for="hsc-alim">
                                            <input type="radio" name="hsc_type" id="hsc-dakhil" value="hsc" checked="checked">
                                            HSC/Alim/Vocational
                                        </label>
                                        <label for="a-level">
                                            <input type="radio" name="hsc_type" id="a-level" value="a_level">
                                            A-Level
                                        </label>
                                        <label for="diploma">
                                            <input type="radio" name="hsc_type" id="diploma" value="diploma">
                                            Diploma
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row hsc_container">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Grade</label>
                                        <select class="form-control" name="hsc_grade">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="A-">A-</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Institution</label>
                                        <input type="ssc_institute_name" class="form-control" name="hsc_institute" id="institute_name" placeholder="Enter Your SSC/Dakhil/Vocational Institute Name">
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Board</label>
                                        <select class="form-control" name="hsc_board">
                                            <option value="0">Select Your Board</option>
                                            <option value="dhaka">Dhaka</option>
                                            <option value="barisal">Barisal</option>
                                            <option value="chittagong">Chittagong</option>
                                            <option value="rajshahi">Rajshahi</option>
                                            <option value="sylhet">Sylhet</option>
                                            <option value="Comilla">Comilla</option>
                                            <option value="dinajpur">Dinajpur</option>
                                            <option value="jessore">Jessore</option>
                                            <option value="madrasha">Madrasha</option>
                                            <option value="technical">Technical</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Group</label>
                                        <select class="form-control" name="hsc_group">
                                            <option value="0">Select Your Group</option>
                                            <option value="Science">Science</option>
                                            <option value="Humanities">Humanities</option>
                                            <option value="Business-Studies">Business Studies</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Passing Year</label>
                                        <select class="form-control" name="hsc_passing_year">
                                            <option value="0">Select Your Passing Year</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational GPA</label>
                                        <input type="gpa" class="form-control" id="gpa" name="hsc_gpa" placeholder="Enter Your SSC/Dakhil/Vocational GPA">
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational English Result</label>
                                        <select class="form-control" name="hsc_english_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="A-">A-</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Mathemetics Result</label>
                                        <select class="form-control" name="hsc_math_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="A-">A-</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Physics Result</label>
                                        <select class="form-control" name="hsc_physics_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="A-">A-</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>HSC/Alim/Vocational Biology Result</label>
                                        <select class="form-control" name="hsc_biology_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="A-">A-</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row a_level_container">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">A Level Institute</label>
                                        <input type="institute-name" class="form-control" name="a_level_institute" id="institute-name" placeholder="Enter Your Institute Name">

                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 1 Name</label>
                                        <select class="form-control" name="a_level_subject1_name">
                                            <option value="0">Select Your Subject</option>
                                            <option value="english-Literature">English Literature</option>
                                            <option value="bangla">Bangla</option>
                                            <option value="mathemetics">Mathemetics</option>
                                            <option value="additional-math">Additional Math</option>
                                            <option value="biology">Biology</option>
                                            <option value="Chemistry">Chemistry</option>
                                            <option value="physics">Physics</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="ict">ICT</option>
                                            <option value="computer-science">Computer Science</option>
                                            <option value="business-studies">Business Studies</option>
                                            <option value="bangladesh-studies">Bangladesh Studies</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="commerce">Commerce</option>
                                            <option value="law">Law</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 2 Name</label>
                                        <select class="form-control" name="a_level_subject2_name">
                                            <option value="0">Select Your Subject</option>
                                            <option value="english-Literature">English Literature</option>
                                            <option value="bangla">Bangla</option>
                                            <option value="mathemetics">Mathemetics</option>
                                            <option value="additional-math">Additional Math</option>
                                            <option value="biology">Biology</option>
                                            <option value="Chemistry">Chemistry</option>
                                            <option value="physics">Physics</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="ict">ICT</option>
                                            <option value="computer-science">Computer Science</option>
                                            <option value="business-studies">Business Studies</option>
                                            <option value="bangladesh-studies">Bangladesh Studies</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="commerce">Commerce</option>
                                            <option value="law">Law</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 3 Name</label>
                                        <select class="form-control" name="a_level_subject3_name">
                                            <option value="0">Select Your Subject</option>
                                            <option value="english-Literature">English Literature</option>
                                            <option value="bangla">Bangla</option>
                                            <option value="mathemetics">Mathemetics</option>
                                            <option value="additional-math">Additional Math</option>
                                            <option value="biology">Biology</option>
                                            <option value="Chemistry">Chemistry</option>
                                            <option value="physics">Physics</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="ict">ICT</option>
                                            <option value="computer-science">Computer Science</option>
                                            <option value="business-studies">Business Studies</option>
                                            <option value="bangladesh-studies">Bangladesh Studies</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="commerce">Commerce</option>
                                            <option value="law">Law</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 4 Name</label>
                                        <select class="form-control" name="a_level_subject4_name">
                                            <option value="0">Select Your Subject</option>
                                            <option value="english-Literature">English Literature</option>
                                            <option value="bangla">Bangla</option>
                                            <option value="mathemetics">Mathemetics</option>
                                            <option value="additional-math">Additional Math</option>
                                            <option value="biology">Biology</option>
                                            <option value="Chemistry">Chemistry</option>
                                            <option value="physics">Physics</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="ict">ICT</option>
                                            <option value="computer-science">Computer Science</option>
                                            <option value="business-studies">Business Studies</option>
                                            <option value="bangladesh-studies">Bangladesh Studies</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="commerce">Commerce</option>
                                            <option value="law">Law</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">A Level passing year</label>
                                        <select class="form-control" name="a_level_passing_year">
                                            <option value="0">Select Your Passing Year</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 1 Result</label>
                                        <select class="form-control" name="a_level_subject1_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 2 Result</label>
                                        <select class="form-control" name="a_level_subject2_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 3 Result</label>
                                        <select class="form-control" name="a_level_subject3_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">A Level Subject 4 Result</label>
                                        <select class="form-control" name="a_level_subject4_result">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>

                                </div>
                            </div>



                            <div class="row diploma_container">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Diploma Institute</label>
                                        <input type="institute-name" class="form-control" name="diploma_institute" id="institute-name" placeholder="Enter Your Institute Name">

                                    </div>
                                    <div class="form-group">
                                        <label for="">Diploma Subject Name</label>
                                        <select class="form-control" name="diploma_subject">
                                            <option value="0">Select Your Subject</option>
                                            <option value="computer">Computer Engineering</option>
                                            <option value="electrical">Electrical</option>
                                            <option value="mechanical">Mechanical</option>
                                            <option value="power">Power</option>
                                            <option value="telecommunication">Telecommunication</option>
                                            <option value="civil">Civil</option>
                                            <option value="electromedical">Electromedical</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Diploma Grade</label>
                                        <select class="form-control" name="diploma_grade">
                                            <option value="0">Select Your Grade</option>
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="A-">A-</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Diploma passing year</label>
                                        <select class="form-control" name="diploma_passing_year">
                                            <option value="0">Select Your Passing Year</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Diploma CGPA</label>
                                        <input type="diploma-cgpa" class="form-control" name="diploma_cgpa" id="diploma-cgpa" placeholder="Enter Your CGPA">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Diploma Board</label>
                                        <input type="diploma-board" class="form-control" name="diploma_board" id="diploma-board" placeholder="Enter Your Board Name">
                                    </div>

                                </div>
                            </div>


                        </div>



                    </div>
                </div>
            </div>




        </div>

        <!-- Account info -->
        <div class="row">
            <h3 class="block_title">Account Information</h3>
            <div class="form-group col-md-4">
                <label>Email &nbsp;<span style="color: #f00;">*</span></label>
                <input type="applicant_email" class="form-control" name="email" id="enteremail" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group col-md-4">
                <label>Password &nbsp;<span style="color: #f00;">*</span></label>
                <input type="password" class="form-control" name="password" id="enterpassword" placeholder="Enter Your Password" required>
            </div>
            <div class="form-group col-md-4">
                <label>Re-type Password &nbsp;<span style="color: #f00;">*</span></label>
                <input type="password" class="form-control" name="re-password" id="enterpassword" placeholder="Enter Your Password">
            </div>
        </div>

        <!-- Actions -->
        <div class="row">
            <button type="submit" name="submit_student_info" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-warning">Reset</button>
        </div>
    </form>
</div>


<?php
include('footer.php');
?>