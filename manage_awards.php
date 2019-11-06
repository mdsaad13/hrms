<?php
include_once('header.php');

$countAwardsGiven = $obj->CountTable('awardsgiven');
$countAwards = $obj->CountTable('awards');
$fetchTemplate = $obj->SelectByDESC('awards');
$awardsGiven = $obj->SelectByDESC('awardsgiven');

$totalAmt = 0;
if ($awardsGiven)
    foreach ($awardsGiven as $awardsGiven) {
        $totalAmt += $awardsGiven['amount'];
    }

$EmpDetails = $obj->SelectByDESC('employee');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage awards</h1>
    </div>

    <div class="container">
        <?php
        if (isset($_REQUEST['success'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Award template added successfully!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } else if (isset($_REQUEST['GiveAwardSuccess'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Employee was awarded successfully!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-3" style="padding: 11px;border-radius: 13px;background-color: #efefef;height: auto;">

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Statistics</a>
                    <a class="nav-link " id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Award template</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Award employee</a>
                </div>

            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Statistics -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <table style="width:100%" class="center">
                            <tr>
                                <th>
                                    <h1><?= $countAwards ?></h1>
                                </th>
                                <th>
                                    <h1><?= $countAwardsGiven ?></h1>
                                </th>
                                <th>
                                    <h1><?= Format::NumFormat($totalAmt) ?></h1>
                                </th>
                            </tr>
                            <tr>
                                <td style="font-size: 12px;color: #9e9e9e;">Number of awards</td>
                                <td style="font-size: 12px;color: #9e9e9e;">Number of awards given</td>
                                <td style="font-size: 12px;color: #9e9e9e;">Total amount of awards given</td>
                            </tr>
                        </table>
                    </div>
                    <!-- Award template -->
                    <div class="tab-pane fade " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="addBtn right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Award</button>
                        </div>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title h4" id="myLargeModalLabel">Add Award</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="controllers/insert.php">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter title" name="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" class="form-control" id="amount" placeholder="Enter amount" name="amount" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" required>
                                            </div>
                                            <div class="form-group center">
                                                <button type="submit" class="btn btn-success" name="addAwardTemplate" style="width: 30%;">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetchTemplate) {
                                    $i = 1;
                                    foreach ($fetchTemplate as $DisplayfetchTemplate) { ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $DisplayfetchTemplate['title'] ?> </td>
                                            <td><?= Format::NumFormat($DisplayfetchTemplate['amount']) ?> </td>
                                            <td><?= $DisplayfetchTemplate['description'] ?> </td>
                                            <td><a href="view_award.php?id=<?= $DisplayfetchTemplate['id'] ?>">View details</a></td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                } else echo '<tr><td colspan="3" class="noData">NO DATA AVAILABLE</td></tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Give award -->
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <form method="post" action="controllers/insert.php">

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
                                <label for="award_id">Select award template</label>
                                <select id="award_id" class="form-control" name="award_id">
                                    <option selected disabled>Choose...</option>
                                    <?php
                                    foreach ($fetchTemplate as $DisplayTemplates) {  ?>
                                        <option value="<?= $DisplayTemplates['id'] ?>">
                                            <?= $DisplayTemplates['title'] . ', ' . $DisplayTemplates['description'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comments">Comments</label>
                                <input type="text" class="form-control" id="comments" placeholder="Enter comments (optional)" name="comments">
                            </div>
                            <div class="form-group center">
                                <button type="submit" class="btn btn-success" name="addEmpAward" style="width: 30%;">Award employee</button>
                            </div>
                        </form>
                    </div>
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
        $(document).attr("title", "HRMS | AWARDS");
        $('#awards').addClass('active');
    });
</script>