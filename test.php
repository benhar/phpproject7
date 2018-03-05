<?php
session_start();

if(isset($_SESSION['username'])){
    echo " I am a valid logged in user";
}
else {
    echo "I am not a valid user";
}