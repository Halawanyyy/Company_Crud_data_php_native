<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();
if($_SESSION['admin']['role']!=1){
    header("location:../404.php");
}
if(isset($_GET['delete'])){
$deleteId = $_GET['delete'];
$ss = "SELECT * FROM adminandrole where adminId = $deleteId";
$query = mysqli_query($connection, $ss);
$row = mysqli_fetch_assoc($query);
$preImage = $row['image'];
unlink("./uploads/".$preImage);
$delete = "DELETE FROM admins where id = $deleteId";
$query2 = mysqli_query($connection, $delete);
if($query2){?>
<script>alert("Admin deleted");</script>
<?php
}
}

?>
<h1 class="text-center mb-5 pt-5" style="color:goldenrod">Admins list</h1>

<!-- table display-->
<table class="table table-dark">
<?php
echo "<th>"."Profile";
echo "<th>"."Id";
echo "<th>"."Name";
echo "<th>"."Role";
echo "<th>"."Actions";

$select = "SELECT * FROM `adminandrole`";


$alldata = mysqli_query($connection, $select);
foreach($alldata as $data){
echo "<tr>";
?>
<td>
    <img src="/odc4/admins/uploads/<?= $data['image'] ?>" width="30px" >
</td>
<?php
echo "<td>". $data["adminId"];
echo "<td>". $data["adminName"];
echo "<td>". $data["roleName"];
?>

<td>
<a href="http://localhost/odc4/admins/update.php?update=<?= $data['adminId'] ?>" class="btn btn-primary">Update</a>
<a onclick="confirm('Are you sure?')  " href="http://localhost/odc4/admins/list.php?delete=<?= $data['adminId'] ?>" class="btn btn-danger">Delete</a>
</td>
<?php
}?>










<?php
include '../shared/footer.php';
?>