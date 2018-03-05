<?php
session_start();
include('DB.php');

if(isset($_REQUEST)){
    $data = $_REQUEST;

    $db = new DB();


    # SEARCH THE USER BY USERNAME
    $where = array('username' => $data['username']);
    $user = $db->table('users')->select('username', 'password')->where($where)->result();
    if($db->count() > 0){
        $pass = md5($data['password']);
        $db_pass = $user['password'];

        # MATCH IT
        if($db_pass == $pass){
            $_SESSION['username'] = $data['username'];
            
            header('Location: test.php');
        }
        else{
            echo "Incorrect Password";
        }
    }
    else{
        echo "Invalid username";
    }




}


