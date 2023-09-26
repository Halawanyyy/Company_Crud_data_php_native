
<?php
include '../general/env.php';
include '../general/functions.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();

if(isset($_GET['update'])){
    $updateId = $_GET['update'];
    $a = "SELECT * from departments where id=$updateId";
    $aa = mysqli_query($connection, $a);
    $row = mysqli_fetch_assoc($aa);
    if(isset($_POST['submit'])){
    $name=$_POST["name"];
    $u = "UPDATE `departments` SET `dName`='$name' WHERE id = $updateId";
    $updateCheck = mysqli_query($connection, $u);
    path('/departments/list.php');
    }
    
}

?>
<h2 class="text-center mb-5 pt-5" style="color:goldenrod">Update department</h2>






<form class="p-3 mb-2 bg-secondary text-white" method="POST" >
<div class="form-group">
<label for="inputName">Name</label>
    <input type="text" class="form-control" id="employeeName" placeholder="Name" name="name" value="<?php if(isset($row)){echo $row['dName'];} ?>">
</div>
<button type="submit" class="btn btn-primary" name="submit" id="inputSubmit">Update</button>
</form>