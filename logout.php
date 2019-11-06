<?php
include_once('controllers/sessions.php');
Session::DestroySession();
if (!Session::GetSession('user_id')) {
    header("Location: login.php");
}
