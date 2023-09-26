<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();
$updateId = $_SESSION['admin']['id'];
$cc = "SELECT * FROM admins where id = $updateId";
$query = mysqli_query($connection, $cc);
$row = mysqli_fetch_assoc($query);
if(isset($_POST["update1"]) ){
    $name=$_POST['name'];

    if(empty($_FILES['adminImage']['name'])){
        $image_name = $row['image'];
    }else{
        $preImage = $row['image'];
        unlink("./uploads/".$preImage);
        $image_name = time().$_FILES['adminImage']['name'];
        $tmp_name = $_FILES['adminImage']['tmp_name'];
        $location = "./uploads/$image_name";
        move_uploaded_file($tmp_name, $location);
        
}
    $update= "UPDATE `admins` SET `name`='$name',`image`='$image_name' WHERE id=$updateId";
    $query1= mysqli_query($connection, $update);
    if($query1){?>
    <script>alert("Data updated");</script>
    <?php
    path("index.php");
    }
}


    

?>

<h1 class="text-center pt-5 mb-5" style="color:goldenrod">Edit profile</h1>

<!-- insert form-->
<form class="p-3 mb-2 bg-secondary text-white" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label for="inputName">Name</label>
    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="<?php if(isset($row)){ echo $row['name']; } ?>" required>
</div>
<div class="form-group">
<label for="employeeProfile">Profile Pic</label>
<img src="./uploads/<?= $row['image']?>" class="img-fluid" width="50px">
    <input type="file" name="adminImage" id="employeeProfile">
</div>
<button type="submit" class="btn btn-primary" name="update1" id="inputSubmit">Update</button>
</form>

<?php
include '../shared/footer.php';
?>