<?php
include_once('header.php');
$EmpTotal = R::count('employee');
$DeptTotal = $obj->CountTable('department');
$payslipsCount = $obj->CountTable('payslips');

$awardsGiven = $obj->SelectByDESC('awardsgiven');
$expenses = $obj->SelectByDESC('expenses');
$payslips = $obj->SelectByDESC('payslips');

$sumAwards = 0;
if ($awardsGiven)
    foreach ($awardsGiven as $awardsGiven) {
        $sumAwards += $awardsGiven['amount'];
    }
$sumExpenses = 0;
if ($expenses)
    foreach ($expenses as $expenses) {
        $sumExpenses += $expenses['amount'];
    }
$sumPayslips = 0;
if ($payslips)
    foreach ($payslips as $payslips) {
        $sumPayslips += $payslips['amount'];
    }
$overAll = $sumAwards + $sumExpenses + $sumPayslips;

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="numDis" style="background:#03a9f4;background-image: url(assets/img/user.png);">
                    <a href="employees.php">
                        <h1><?= $EmpTotal ?></h1>
                        <h6>Total Employees</h6>
                    </a>
                </div>
            </div>
            <div class="col-sm">
                <div class="numDis" style="background:#4caf50;background-image: url(assets/img/calendar.png);">
                    <a href="department.php">
                        <h1><?= $DeptTotal ?></h1>
                        <h6>Total Departments</h6>
                    </a>
                </div>
            </div>
            <div class="col-sm">
                <div class="numDis" style="background:#ff9800 ;background-image: url(assets/img/icon.png);">
                    <a href="payslips.php">
                        <h1><?= $payslipsCount ?></h1>
                        <h6>Number of payslips</h6>
                    </a>
                </div>
            </div>
        </div>

        <h4>Expenditures</h4>
        <div class="row" style="text-align:center">
            <div class="col-sm">
                <div class="numDis" style="background:#5e35b1;">
                    <h1><?= Format::NumFormat($overAll) ?></h1>
                    <h6>Total expenditure</h6>
                </div>
            </div>
            <div class="col-sm">
                <div class="numDis" style="background:#d81b60;">
                    <a href="manage_awards.php">
                        <h1><?= Format::NumFormat($sumAwards) ?></h1>
                        <h6>Awards</h6>
                    </a>
                </div>
            </div>
            <div class="col-sm">
                <div class="numDis" style="background:#795548">
                    <a href="expenses.php">
                        <h1><?= Format::NumFormat($sumExpenses) ?></h1>
                        <h6>Expenses</h6>
                    </a>
                </div>
            </div>
            <div class="col-sm">
                <div class="numDis" style="background:#009688">
                    <a href="payslips.php">
                        <h1><?= Format::NumFormat($sumPayslips) ?></h1>
                        <h6>Pay Slips</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
include_once('footer.php');
?>

<script>
    $(document).ready(function() {
        $(document).attr("title", "HRMS | DASHBOARD");
        $('#index').addClass('active');
    });
</script>