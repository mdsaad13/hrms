<?php
include_once('header.php');
$DeptTotal = $obj->CountTable('department');

$DeptDetails = $obj->SelectByDESC('department');

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Departments</h1>
        <h1 class="heading">
            <span>Total departments</span>
            <?= $DeptTotal ?>
        </h1>
    </div>

    <div class="container">
        <?php
        if (isset($_REQUEST['success'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Department added successfully!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="addBtn right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Department</button>
        </div>
        <div class="row">
            <!-- Main content here -->
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
                            <form method="post" action="controllers/insert.php">
                                <div class="form-group">
                                    <label for="dep_id">Department ID</label>
                                    <input type="text" class="form-control" id="dep_id" aria-describedby="emailHelp" placeholder="Enter Department ID" name="dep_id" required value="<?= 'DEPT' . rand(11111, 99999) ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Department name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter department name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" placeholder="Enter Designation" name="designation" required>
                                </div>
                                <div class="form-group center">
                                    <button type="submit" class="btn btn-success" name="addDept" style="width: 30%;">Submit</button>
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
                        <th scope="col">Department ID</th>
                        <th scope="col">Department name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Number of Employees</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($DeptDetails) {
                        $i = 1;
                        foreach ($DeptDetails as $DeptDetails) { ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $DeptDetails['dep_id'] ?> </td>
                                <td><?= $DeptDetails['name'] ?> </td>
                                <td><?= $DeptDetails['designation'] ?> </td>
                                <td>
                                    <b><?= $obj->CountByArgs('employee', 'dept_id = ' . $DeptDetails['id']) ?></b>
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    } else echo '<tr><td colspan="5" class="noData">NO DATA AVAILABLE</td></tr>';
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</main>
<?php
include_once('footer.php');
?>
<script>
    $(document).ready(function() {
        $(document).attr("title", "HRMS | DEPARTMENT");
        $('#department').addClass('active');
    });
</script>