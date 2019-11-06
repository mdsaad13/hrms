<?php
include_once('header.php');

$expensesDetails = $obj->SelectByDESC('expenses');

$expensesTotal = 0;
foreach ($expensesDetails as $CalcTotal) {
    $expensesTotal += $CalcTotal['amount'];
}

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Expenses</h1>
        <h1 class="heading" style="color:red">
            <span>Total expenses</span>
            <?= Format::NumFormat($expensesTotal) ?>
        </h1>
    </div>

    <div class="container">
        <?php
        if (isset($_REQUEST['success'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Expense added successfully!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <div class="row">
            <!-- Main content here -->

            <div class="col-4">
                <h3 class="center">Add Expense</h3>
                <form method="post" action="controllers/insert.php">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" placeholder="Enter Amount" name="amount" required>
                    </div>
                    <div class="form-group center">
                        <button type="submit" class="btn btn-primary" name="addExpense" style="width: 30%;">Add</button>
                    </div>

                </form>
            </div>
            <div class="col-8">
                <table class="table" id="mytable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($expensesDetails as $expensesDetails) {  ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $expensesDetails['title'] ?> </td>
                                <td><?= $expensesDetails['description'] ?> </td>
                                <td><?= Format::NumFormat($expensesDetails['amount']) ?> </td>
                                <td><?= Format::DateTimeformat($expensesDetails['date']) ?> </td>
                            </tr>
                        <?php
                            $i++;
                        }
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
        $(document).attr("title", "HRMS | EXPENSES");
        $('#expenses').addClass('active');
    });
</script>