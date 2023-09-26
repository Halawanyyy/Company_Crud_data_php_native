<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();

if(isset($_GET['delete'])){
    $deleteID = $_GET['delete'];
    $delete = "DELETE FROM departments WHERE id = $deleteID";
    $deleteCheck = mysqli_query($connection, $delete);
    if($deleteCheck){
    path('departments/list.php');
    }else{
        echo "Cant delete ";
    }
}

?>
<h2 class="text-center mb-5 pt-5" style="color:goldenrod">Departments list</h2>
<!-- table display-->
<table class="table table-dark">
<?php
echo "<th>"."Id";
echo "<th>"."Name";
echo "<th>"."Actions";
$select = "SELECT * FROM `departments` ORDER BY id";
$alldata = mysqli_query($connection, $select);
foreach($alldata as $data){
echo "<tr>";
echo "<td>". $data["id"];
echo "<td>". $data["dName"];
?>
<td>
<a href="http://localhost/odc4/departments/update.php?update=<?= $data['id'] ?>" class="btn btn-primary">Update</a>
<a onclick="confirm('Are you sure?')  " href="http://localhost/odc4/departments/list.php?delete=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>
</td>
<?php
} ?>






<?php
include '../shared/footer.php';
?>