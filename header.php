<?php
include_once('controllers/class.php');
$user_id = Session::GetSession('user_id');
if ($user_id) {
    $obj = new Operations;
    $adminDetails = $obj->SelectByID('admin', $user_id);
    $name = $adminDetails['name'];
} else {
    header('location:login.php');
}

class Format
{
    /**
     * @param number to be formated
     * @return Formated num (Ex: 1,000.00)
     */
    public static function NumFormat($data)
    {
        return '₹' . number_format($data, 2);
    }
    /**
     * @param date-time to be formated
     * @return Formated date-time (EX: 05-Sep-19 12:29 AM)
     */
    public static function DateTimeformat($data)
    {
        $format = date("d-M-Y", strtotime($data)) . '<br>';
        $format .= '<span style="font-size:13px;color:#bdbdbd">';
        $format .= date("h:i:s A", strtotime($data));
        $format .= '</span>';
        return $format;
        // date("h:i:s A", strtotime($data));
        // return date("d M, Y, h:i:s A", strtotime($data));
    }
    /**
     * @param date to be formated
     * @return Formated date (EX: 05-Sep-19)
     */
    public static function Dateformat($data)
    {
        return date("d/m/Y", strtotime($data));
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HRMS | DASHBOARD</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datatables CSS -->
    <link href="plugins/DataTables/datatables.min.css" rel="stylesheet">

</head>
<style>
    body {
        font-size: .875rem;
    }

    .feather {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
    }

    label {
        font-weight: bold;
    }

    .row {
        margin-bottom: 20px;
    }

    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    .left {
        text-align: left;
    }

    /*
 * Sidebar
 */

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        /* Behind the navbar */
        padding: 48px 0 0;
        /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto;
        /* Scrollable contents if viewport is shorter than content. */
    }

    @supports ((position: -webkit-sticky) or (position: sticky)) {
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
        }
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #999;
    }

    .sidebar .nav-link.active {
        color: #007bff;
    }

    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
        color: inherit;
    }

    .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
    }

    /*
 * Content
 */

    [role="main"] {
        padding-top: 48px;
        /* Space for fixed navbar */
    }

    /*
 * Navbar
 */

    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .form-control {
        padding: .75rem 1rem;
        border-width: 0;
        border-radius: 0;
    }

    .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
    }

    .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
    }

    /*Number Display card*/
    .numDis {
        height: 120px;
        margin: 10px 20px;
        border-radius: 12px;
        padding: 10px 20px;
        color: #fff;
        background-repeat: no-repeat !important;
        background-position-x: 210px !important;
        background-position-y: center !important;
    }

    .numDis h6 {
        padding-top: 10px;
    }

    .numDis a {
        color: unset;
        text-decoration: none;
    }

    .heading {
        font-size: 3rem;
        color: #4caf50;
    }

    .heading span {
        font-size: 16px;
        font-weight: unset;
        color: #a1a1a1;
    }

    .addBtn {
        margin-bottom: 15px;
        text-align: right;
    }

    .noData {
        text-align: center;
        background: #f3f3f3;
        font-weight: bold;
        color: #f44336;
    }
</style>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">HRMS</a>
        <h3 style="color:#fff">Welcome <?= $name ?></h3>
        <ul class="navbar-nav px-3 signout" style="margin-right: 10px;">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column" style="font-size: 17px;">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" id="index">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="department.php" id="department">
                                <span data-feather="grid"></span>
                                Department
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="employees.php" id="employees">
                                <span data-feather="users"></span>
                                Employees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_awards.php" id="awards">
                                <span data-feather="award"></span>
                                Awards
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="expenses.php" id="expenses">
                                <span data-feather="archive"></span>
                                Expenses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="payslips.php" id="payslips">
                                <span data-feather="bar-chart-2"></span>
                                Pay Slips
                            </a>
                        </li>

                    </ul>

                </div>
            </nav>