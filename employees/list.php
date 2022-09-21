<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';

if(isset($_GET['delete'])){
    $deleteID = $_GET['delete'];
    $delete = "DELETE FROM employees WHERE id = $deleteID";
    $deleteCheck = mysqli_query($connection, $delete);
    path('employees/list.php#return');
}
?>
<h1 class="text-center mb-5 pt-5" style="color:goldenrod">Employees list</h1>
<!-- table display-->
<table class="table table-dark">
<?php
echo "<th>"."Id";
echo "<th>"."Name";
echo "<th>"."email";
echo "<th>"."salary";
echo "<th>"."Department";
echo "<th>"."Actions";
$select = "SELECT * FROM `depandemp` ORDER by empID";
$alldata = mysqli_query($connection, $select);
foreach($alldata as $data){
echo "<tr>";
echo "<td>". $data["empID"];
echo "<td>". $data["name"];
echo "<td>". $data["email"];
echo "<td>". $data["salary"];
echo "<td>". $data["dName"];
?>
<td>
<a href="http://localhost/odc4/employees/update.php?update=<?= $data['empID'] ?>" class="btn btn-primary">Update</a>
<a onclick="return confirm('Are you sure?')  " href="http://localhost/odc4/employees/list.php?delete=<?= $data['empID'] ?>" class="btn btn-danger">Delete</a>
</td>
<?php
}?>










<?php
include '../shared/footer.php';
?>