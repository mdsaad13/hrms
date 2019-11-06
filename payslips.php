<?php
include_once('header.php');

$payslipsCount = $obj->CountTable('payslips');
$payslipsDetails = $obj->SelectByDESC('payslips');

//Calculating total amount
$payslipsTotal = 0;
if ($payslipsDetails) {
    foreach ($payslipsDetails as $CalTotalAmount) {
        $payslipsTotal += $CalTotalAmount['amount'];
    }
}

$EmpDetails = $obj->SelectByDESC('employee');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pay Slips</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add pay slip</button>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Add Pay Slip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="controllers/insert.php">
                        <div class="form-group">
                            <label for="slip_id">Pay slip ID</label>
                            <input type="text" class="form-control" id="slip_id" placeholder="Enter title" name="slip_id" required readonly value="<?= mt_rand(111111, 999999) ?>">
                        </div>
                        <div class="form-group">
                            <label for="emp_id">Select employee</label>
                            <select id="emp_id" class="form-control" name="emp_id">
                                <option selected disabled>Choose...</option>
                                <?php
                                foreach ($EmpDetails as $DisplayEmpDetails) {  ?>
                                    <option value="<?= $DisplayEmpDetails['id'] ?>">
                                        <?= $DisplayEmpDetails['name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" placeholder="Enter amount" name="amount">
                        </div>
                        <div class="form-group center">
                            <button type="submit" class="btn btn-success" name="addPayslip" style="width: 30%;">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        if (isset($_REQUEST['success'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Pay slip added successfully!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="row">
            <table style="width:100%" class="center">
                <tr>
                    <th>
                        <h1><?= $payslipsCount ?></h1>
                    </th>
                    <th>
                        <h1><?= Format::NumFormat($payslipsTotal) ?></h1>
                    </th>
                </tr>
                <tr>
                    <td style="font-size: 12px;color: #9e9e9e;">
                        Number of slips generated
                    </td>
                    <td style="font-size: 12px;color: #9e9e9e;">
                        Total amount of generated slips
                    </td>
                </tr>
            </table>
        </div>
        <table class="table" id="mytable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pay slip ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Department</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($payslipsDetails as $payslipsDetails) { ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $payslipsDetails['slip_id'] ?></td>
                        <td><?= Format::DateTimeformat($payslipsDetails['date']) ?></td>
                        <?php
                            $FetchEmployee = $obj->SelectByID('employee', $payslipsDetails['emp_id']);
                            $FetchDept = $obj->SelectByID('department', $FetchEmployee['dept_id']);
                            ?>
                        <td>
                            <a href="viewemployee.php?id=<?= $FetchEmployee['id'] ?>">
                                <?= $FetchEmployee['name'] . ', ' . $FetchEmployee['emp_id'] ?>
                            </a>
                        </td>
                        <td><?= $FetchDept['name'] . ', ' . $FetchDept['dep_id'] ?></td>
                        <td><?= Format::NumFormat($payslipsDetails['amount']) ?></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

</main>
<?php
include_once('footer.php');
?>
<script>
    $(document).ready(function() {
        $(document).attr("title", "HRMS | PAYSLIPS");
        $('#payslips').addClass('active');
    });
</script>