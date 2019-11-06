<?php
include_once('header.php');

$EmpTotal = $obj->CountTable('employee');

$EmpDetails = $obj->SelectByDESC('employee');
$DeptDetails = $obj->SelectByDESC('department');

if ($_POST) {
    if (isset($_POST['filter'])) {
        $dept_id = $_POST['dept_id'];
        if ($_POST['dept_id'] != 'all')
            $EmpDetails = R::getAll("SELECT * FROM employee WHERE dept_id = $dept_id ORDER BY id DESC");
    }
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Employees</h1>
        <h1 class="heading">
            <span>Total Employees</span>
            <?= $EmpTotal ?>
        </h1>
    </div>

    <div class="container">
        <?php
        if (isset($_REQUEST['success'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Employee added successfully!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-8">
                <form class="form-inline" method="post" action="employees.php">
                    <div class="form-group mb-2">
                        <label for="">Display employees by department</label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select id="" class="form-control" name="dept_id">
                            <option selected value="all">All departments</option>
                            <?php
                            foreach ($DeptDetails as $Deptdata) {  ?>
                                <option value="<?= $Deptdata['id'] ?>" <?php
                                                                            if ($_POST) {
                                                                                if (isset($_POST['filter'])) {
                                                                                    $dept_id = $_POST['dept_id'];
                                                                                    if ($_POST['dept_id'] == $Deptdata['id']) echo "selected";
                                                                                }
                                                                            } ?>>
                                    <?= $Deptdata['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info mb-2" name="filter">Filter</button>
                </form>
            </div>
            <div class="col-4">
                <div class="addBtn right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Employees</button>
                </div>
            </div>
        </div>

        <!-- <div class="row"> -->
        <!-- Main content here -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Add Employees</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="controllers/insert.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="emp_id">Employees ID</label>
                                    <input type="text" class="form-control" id="emp_id" placeholder="Enter Employees ID" name="emp_id" required value="<?= 'EMP' . rand(11111, 99999) ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="dept_id">Department</label>

                                    <select id="dept_id" class="form-control" name="dept_id">
                                        <option selected disabled>Choose...</option>
                                        <?php
                                        foreach ($DeptDetails as $DeptData) {  ?>
                                            <option value="<?= $DeptData['id'] ?>">
                                                <?= $DeptData['name'] . ' - ' . $DeptData['dep_id'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter employee name" name="name" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter employee email" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="qualification">Qualification</label>
                                    <input type="text" class="form-control" id="qualification" placeholder="Enter employee qualification" name="qualification" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Apartment, studio, or floor" name="address">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="state">State</label>
                                    <select id="state" class="form-control" name="state">
                                        <option selected disabled>Choose...</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Punjab">Punjab</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter pin code">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="joining_sal">Joining salary</label>
                                    <input type="number" class="form-control" id="joining_sal" placeholder="Enter employee joining salary" name="joining_sal" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">Mobile number</label>
                                    <input type="number" class="form-control" id="mobile" placeholder="Enter employee mobile number" name="mobile" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="dob">Date of birth</label>
                                    <input type="date" class="form-control" id="dob" placeholder="Enter employee joining dob" name="dob" required>
                                </div>
                                <div class="form-group col-md-6" style="text-align: center;margin: auto;">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" checked value="Male">
                                        <label class="custom-control-label" for="customRadioInline1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="Female">
                                        <label class="custom-control-label" for="customRadioInline2">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group center">
                                <button type="submit" class="btn btn-success" name="addEmp" style="width: 30%;">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table" id="mytable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Department</th>
                    <th scope="col">Mobile number</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($EmpDetails as $EmpDetails) { ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $EmpDetails['emp_id'] ?></td>
                        <td><?= $EmpDetails['name'] ?></td>
                        <td><?= $EmpDetails['email'] ?></td>
                        <td>
                            <?php
                                $deptName = $obj->SelectByID('department', $EmpDetails['dept_id']);
                                echo $deptName['name'] . ' - ' . $deptName['dep_id'];
                                ?>
                        </td>
                        <td><?= $EmpDetails['mobile'] ?></td>
                        <td><a href="viewemployee.php?id=<?= $EmpDetails['id'] ?>">View details</a></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>

        <!-- </div> -->
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