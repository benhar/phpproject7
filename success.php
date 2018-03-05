<?php

var_dump($_REQUEST);
session_start();
include('DB.php');

if(isset($_POST['tran_id'])){
    $req = $_REQUEST;

    $db = new DB();

    if(isset($_REQUEST['tran_id'])) {
        $search_tran_id = $db->table('transaction_history')->select('*')->where(['tran_id' => $_REQUEST['tran_id']])->results();
        $count = $db->count();

        if($count > 0){

            $data_array = array(
                    'tran_id' => $_POST['tran_id'],
                    'val_id' => $req['val_id'],
                    'amount' => $_POST['amount'],
                    'card_type' => $_POST['card_type'],
                    'store_amount' => $_POST['store_amount'],
                    'card_no' => $_POST['card_no'],
                    'bank_tran_id' => $_POST['bank_tran_id'],
                    'status' => $_POST['status'],
                    'tran_date' => $_POST['tran_date'],
                    'card_issuer_country' => $_POST['card_issuer_country'],
                    'verify_sign' => $_POST['verify_sign'],
                    'verify_key' => $_POST['verify_key'],
                    );

            $update = $db->table('transaction_history')->where(['tran_id'=>$_POST['tran_id']])->update($data_array);
            if($update){
                // Business Logic

                // Update Success
                $update_trx = $db->table('transactions')->where(['tran_id'=>$_POST['tran_id']])->update(['status'=>'SUCCESS']);

                // Pay logic
                if($update_trx){
                    $student_trx = $db->table('transactions')->select('*')->where(['tran_id'=>$_POST['tran_id']])->result();
                    $insertPayment = array(
                        'student_id' => $student_trx['student_id'],
                        'payment_id' => $student_trx['id'],
                        'semester' => $student_trx['semester'],
                        'payment_amount' => $student_trx['total_amount'],
                    );

                    $insert_payment = $db->table('payment_history')->insert($insertPayment);
                    if($insert_payment){
                        $student = $db->table('student_admission')->where(['id'=>$student_trx['student_id']])->result();

                        $paid_amount_now = $student_trx['total_amount'];
                        $total = $student['total_amount'];
                        $paid = $student['paid_amount'] + $paid_amount_now;
                        $due = $student['due_amount'] - $paid_amount_now;

                        $update = $db ->table('student_admission')->where(['id'=>$student_trx['student_id']])->update([
                            'paid_amount' => $paid,
                            'due_amount' => $due,
                            'semester_starts' => $student_trx['semester']
                        ]);

                        if($update){

                            $_SESSION['message_bag'] = '<span class="fa fa-tick-o"></span> Your Payment is successful. Your transaction id is '.$_REQUEST['tran_id'];
                            $_SESSION['class'] = 'success';
                            header('Location: dashboard.php');
                        }


                    }
                }





            }

            }
        else{
            $msg = array(
                'class' => 'danger',
                'message' => $_REQUEST['tran_id'].' is not valid'
            );
            $_SESSION['message'] = $msg;
            header('Location: dashboard.php');
        }
    }


}