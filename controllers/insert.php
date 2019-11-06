<?php
include_once('class.php');
if ($_POST) {
    $obj = new Operations;

    if (isset($_POST['addDept'])) {
        array_pop($_POST);
        $obj->insert('department', $_POST);
        header("location:../department.php?success");
    }
    if (isset($_POST['addEmp'])) {
        array_pop($_POST);
        $_POST['country'] = 'India';
        $obj->insert('employee', $_POST);
        header("location:../employees.php?success");
    }
    if (isset($_POST['addExpense'])) {
        array_pop($_POST);
        $_POST['date'] = date("Y-m-d H:i:s");
        $obj->insert('expenses', $_POST);
        header("location:../expenses.php?success");
    }
    if (isset($_POST['addAwardTemplate'])) {
        // print_r($_POST);
        array_pop($_POST);
        $obj->insert('awards', $_POST);
        header("location:../manage_awards.php?success");
    }
    if (isset($_POST['addEmpAward'])) {
        // print_r($_POST);
        array_pop($_POST);
        $currentDateTime = date("Y-m-d H:i:s");
        $awardDetails = $obj->SelectByID('awards', $_POST['award_id']);

        $_POST['amount'] = $awardDetails['amount'];
        $_POST['date'] = $currentDateTime;
        $obj->insert('awardsgiven', $_POST);

        header("location:../manage_awards.php?GiveAwardSuccess");
    }
    if (isset($_POST['addPayslip'])) {
        array_pop($_POST);
        $_POST['date'] = date("Y-m-d H:i:s");
        $obj->insert('payslips', $_POST);
        header("location:../payslips.php?success");
    }
}
