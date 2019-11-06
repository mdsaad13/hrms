<?php
require_once 'class.php';
if ($_POST) {
    // print_r($_POST);
    // exit;
    $obj = new Operations;
    extract($_POST);
    //CHECKING IF EMAIL EXISTS OR NOT
    if ($obj->Validate('admin', array('email' => $email))) {
        //FETCHING DETAILS OF THAT PARTICULAR USER BY MATCHING EMAIL
        $userDetails = $obj->SelectByArgs('admin', array('email' => $email));
        if ($userDetails[0]['password'] == $password) {
            // echo "Email and Password";
            Session::SetSession('user_id', $userDetails[0]['id']);
            header("location:../index.php");
        } else {
            // echo "Incorrect Password";
            header("location:../login.php?2");
        }
    } else {
        // echo "Invalid Email";
        header("location:../login.php?3");
    }
}
