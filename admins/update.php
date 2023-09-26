<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();
if($_SESSION['admin']['role']!=1){
    header("location:../404.php");
}



if(isset($_GET['update'])){

    $updateId = $_GET['update'];
    $a = "SELECT * from adminandrole where adminId=$updateId";
    $aa = mysqli_query($connection, $a);
    $row = mysqli_fetch_assoc($aa);
    
if(isset($_POST['update1'])){
    $name=$_POST["name"];
    //$email=$_POST["email"];
    $password=sha1($_POST["password"]);
    $role = $_POST["role"];

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
    $u = "UPDATE `admins` SET `name`='$name',`image`='$image_name',`password`='$password',`role`=$role WHERE id = $updateId";
    $updateCheck = mysqli_query($connection, $u);
    if($updateCheck){?>
    <script>alert("Updated correctly");</script>
    <?php }
    path('/admins/list.php');
    }
    
}

?>
<h2 class="text-center mb-5 pt-5" style="color:goldenrod">Update Admin</h2>






<!-- update form-->
<form class="p-3 mb-2 bg-secondary text-white" method="POST" enctype="multipart/form-data">
<label for="inputName">Name</label>
    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="<?php if(isset($row)){ echo $row['adminName'];  } ?>">
</div>
<div class="form-group">
<label for="employeeProfile">Profile Pic</label>
<img src="./uploads/<?= $row['image']?>" class="img-fluid" width="50px">
    <input type="file" name="adminImage" id="employeeProfile">
</div>

<div class="form-group">
<label for="inputPassword">Password</label>
    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
</div>
<div class="form-group">
<label for="inputRole">Role</label>
    <select name="role" id="inputRole">
    <?php
    $select = "SELECT * FROM `role`";
    $ss= mysqli_query($connection, $select);
    foreach($ss as $s){?>
    <option value="<?php echo $s['id'] ?>" <?php if($row['adminRole']==$s['id']){ echo "selected"; } ?>><?php echo $s['name'] ?></option>

    <?php }?>
    </select>
</div>
<button type="submit" class="btn btn-primary" name="update1" id="inputSubmit">Update</button>
</form>

<?php
include '../shared/footer.php';
?>