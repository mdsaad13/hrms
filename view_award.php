<?php
include_once('header.php');
$award_id = $_REQUEST['id'];

/* FETCHING DATA FROM DATABASE */
$awardData = $obj->SelectByID('awards', $award_id);
$awardsCount = $obj->CountByArgs('awardsgiven', "award_id = $award_id");
$awardsGiven = R::getAll("SELECT * FROM awardsgiven WHERE award_id = $award_id ORDER BY id DESC");
$awardsTotAmount = 0;
if ($awardsGiven) {
    foreach ($awardsGiven as $CalTotalAmount) {
        $awardsTotAmount += $CalTotalAmount['amount'];
    }
}
?>
<style>
    .h2 a {
        font-size: 18px;
    }
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Award name: <?= $awardData['title'] ?>
            <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">EDIT</a>
        </h1>
        <h1 class="heading">
            <span>Price</span>
            <?= Format::NumFormat($awardData['amount']) ?>
        </h1>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Add Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="controllers/edit.php">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required value="<?= $awardData['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount_col" placeholder="Enter amount" name="amount" value="<?= $awardData['amount'] ?>" readonly disabled>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" required value="<?= $awardData['description'] ?>">
                        </div>
                        <input type="hidden" name="id" value="<?= $award_id ?>">
                        <div class="form-group center">
                            <button type="submit" class="btn btn-success" name="editAward" style="width: 30%;">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        if (isset($_REQUEST['editSuccess'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Update success!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="row">
            <table style="width:100%" class="center">
                <tr>
                    <th>
                        <h1><?= $awardsCount ?></h1>
                    </th>
                    <th>
                        <h1><?= Format::NumFormat($awardsTotAmount) ?></h1>
                    </th>
                </tr>
                <tr>
                    <td style="font-size: 12px;color: #9e9e9e;">
                        Given to employees
                    </td>
                    <td style="font-size: 12px;color: #9e9e9e;">
                        Total amount
                    </td>
                </tr>
            </table>
        </div>
        <table class="table" id="mytable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Department</th>
                    <th scope="col">Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($awardsGiven as $awardsGiven) { ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= Format::DateTimeformat($awardsGiven['date']) ?></td>
                        <?php
                            $FetchEmployee = $obj->SelectByID('employee', $awardsGiven['emp_id']);
                            $FetchDept = $obj->SelectByID('department', $FetchEmployee['dept_id']);
                            ?>
                        <td>
                            <a href="viewemployee.php?id=<?= $FetchEmployee['id'] ?>">
                                <?= $FetchEmployee['name'] . ', ' . $FetchEmployee['emp_id'] ?>
                            </a>
                        </td>
                        <td><?= $FetchDept['name'] . ', ' . $FetchDept['dep_id'] ?></td>
                        <td><?php echo ($awardsGiven['comments']) ? $awardsGiven['comments'] : 'N/A' ?></td>
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
        $(document).attr("title", "HRMS | AWARDS");
        $('#awards').addClass('active');
    });
</script>