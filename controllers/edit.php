<?php
include_once('class.php');
if ($_POST) {
    $obj = new Operations;
    echo "<pre>";

    if (isset($_POST['editAward'])) {
        array_pop($_POST);
        $id = $_POST['id'];
        array_pop($_POST);
        if ($obj->update('awards', $id, $_POST)) {
            header("location:../view_award.php?id=$id&editSuccess");
        }
    }
}
