<?php
    session_start();
    include "DB.php";

if(isset($_SESSION['logged_in_user']) && $_SESSION['logged_in_user'] != '') {
    if (isset($_POST['semester_id']) && $_POST['semester_id'] != '') {
        // INIT DB
        $db = new DB();

        $sem = $_POST['semester_id'];
        $student = $db->table('student_admission')->where(['email' => $_SESSION['logged_in_user']])->result();
        
        $course = $db->table('courses')->where(['id'=>$student['course']])->result();

        $fees = $course['semester_fee'];
        
        if($fees != ''){
            $trxid = uniqid();
            $trx_data = array(
                'tran_id' => $trxid,
                'student_id' => $student['id'],
                'email' => $student['email'],
                'course_id' => $course['id'],
                'semester' => $sem,
                'total_amount' => $fees,
                'creation_time' => date('Y-m-d H:i:s')
            );

            $saveTrx = $db->table('transactions')->insert($trx_data);
            if($saveTrx) {

                $history = array(
                    'tran_id' => $trxid,
                    'creation_time' => date('Y-m-d H:i:s')
                );

                $saveOrder = $db->table('transaction_history')->insert($history);






                ?>
                <form action="https://sandbox.sslcommerz.com/gwprocess/v3/process.php" method="post">
                    <input type="hidden" name="tran_id" value="<?php echo $trx_data['tran_id']; ?>">
                    <input type="hidden" name="total_amount" value="<?php echo $trx_data['total_amount']; ?>">
                    <input type="hidden" name="success_url" value="http://localhost/php/success.php">
                    <input type="hidden" name="fail_url" value="http://localhost/php/fail.php">
                    <input type="hidden" name="cancel_url" value="http://localhost/php/cancel.php">
                    <input type="hidden" name="store_id" value="testbox">
                </form>
                <script>
                    document.forms[0].submit();
                </script>
                <?php
            }
        }
        else{
            
        }
    }
    else{
        
    }
}
else{
    
}





?>