<?php
include_once('header.php');
$emp_id = $_REQUEST['id'];

/* FETCHING DATA FROM DATABASE */
$empData = $obj->SelectByID('employee', $emp_id);
$awardsGiven = R::getAll("SELECT * FROM awardsgiven WHERE emp_id = $emp_id ORDER BY id DESC");
$payslipsData = R::getAll("SELECT * FROM payslips WHERE emp_id = $emp_id ORDER BY id DESC");
$deptData = $obj->SelectByID('department', $empData['dept_id']);

$awardsCount = $obj->CountByArgs('awardsgiven', "emp_id = $emp_id");

//Calculating total amount of awards given
$awardsTotAmount = 0;
if ($awardsGiven) {
    foreach ($awardsGiven as $CalTotalAmount) {
        $awardsTotAmount += $CalTotalAmount['amount'];
    }
}
//Calculating total amount of salary/payslips given
$salTotAmount = 0;
if ($payslipsData) {
    foreach ($payslipsData as $CalpayslipsData) {
        $salTotAmount += $CalpayslipsData['amount'];
    }
}
?>
<style>
    .viewdataHeading {
        text-align: center;
        background: #2196f3;
        color: white;
        padding: 10px;
        border-radius: 16px;
    }

    .subHeading {
        font-size: 20px;
        color: grey;
        font-weight: bold;
        margin-bottom: 5px;
    }
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">View employee: <?= $empData['name'] . ' - ' . $empData['emp_id'] ?></h2>
    </div>

    <div class="container">
        <div class="row">
            <table style="width:100%" class="center">
                <tr>
                    <th>
                        <h1><?= $awardsCount ?></h1>
                    </th>
                    <th>
                        <h1><?= Format::NumFormat($awardsTotAmount) ?></h1>
                    </th>
                    <th>
                        <h1><?= Format::NumFormat($salTotAmount) ?></h1>
                    </th>
                </tr>
                <tr>
                    <td style="font-size: 12px;color: #9e9e9e;">
                        Awards given
                    </td>
                    <td style="font-size: 12px;color: #9e9e9e;">
                        Total amount from awards
                    </td>
                    <td style="font-size: 12px;color: #9e9e9e;">
                        Total salary given
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-12">
                <h4 class="viewdataHeading">General data</h4>
                <div class="row">
                    <div class="col" style="padding: 0px 37px;">
                        <div class="subHeading">General details</div>
                        <table style="width:100%">
                            <tr>
                                <th>
                                    Department
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $deptData['name'] . ', ' . $deptData['designation'] . ' (' . $deptData['dep_id'] . ')' ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Email
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['email'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Mobile number
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['mobile'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Qualification
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['qualification'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Gender
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['gender'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col" style="padding: 0px 37px;">
                        <div class="subHeading">Address details</div>
                        <table style="width:100%">
                            <tr>
                                <th>
                                    Address
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['address'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Country
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['country'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    City
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['city'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    State
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['state'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Pincode
                                </th>
                                <td>:</td>
                                <td>
                                    <?= $empData['pincode'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h4 class="viewdataHeading">Awards data</h4>

                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Awarded on</th>
                            <th scope="col">Award name</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($awardsGiven) {
                            $i = 1;
                            foreach ($awardsGiven as $RowawardsGiven) { ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= Format::DateTimeformat($RowawardsGiven['date']) ?></td>
                                    <td>
                                        <?php
                                                $awardName = $obj->SelectByID('awards', $RowawardsGiven['award_id']);
                                                echo $awardName['title'];
                                                ?>
                                    </td>
                                    <td><?= Format::NumFormat($RowawardsGiven['amount']) ?></td>
                                </tr>
                        <?php
                                $i++;
                            }
                        } else echo '<tr><td colspan="4" class="noData">NO DATA AVAILABLE</td></tr>';
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h4 class="viewdataHeading">Payslips data</h4>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Slip ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($payslipsData) {
                            $i = 1;
                            foreach ($payslipsData as $RowpayslipsData) { ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $RowpayslipsData['slip_id'] ?></td>
                                    <td><?= Format::DateTimeformat($RowpayslipsData['date']) ?></td>
                                    <td><?= Format::NumFormat($RowpayslipsData['amount']) ?></td>
                                </tr>
                        <?php
                                $i++;
                            }
                        } else echo '<tr><td colspan="3" class="noData">NO DATA AVAILABLE</td></tr>';
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<?php
include_once('footer.php');
?>
<script>
    $(document).ready(function() {
        $(document).attr("title", "HRMS | EMPLOYEES");
        $('#employees').addClass('active');
    });
</script>