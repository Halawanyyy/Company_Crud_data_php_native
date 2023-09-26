<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';

auth();
if($_SESSION['admin']['role']!=1){
    header("location:../404.php");
}
//submit
if(isset($_POST["submit"]) ){
    $name=$_POST["name"];
    //$email=$_POST["email"];
    $password=sha1($_POST["password"]);
    

    $role = $_POST["role"];
    $image_name = time().$_FILES['adminImage']['name'];
    $tmp_name = $_FILES['adminImage']['tmp_name'];
    $location = "./uploads/$image_name";
    move_uploaded_file($tmp_name, $location);
    
    


    if(empty($name)  or empty($email)  or empty($password))
    {
    echo'   <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Cant submit with one or more empty fields</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
}else{
    $insert="INSERT INTO admins VALUES(null,'$name','$image_name','$password',$role)";
    $insertCheck = mysqli_query($connection, $insert);
    if($insertCheck){
        path('index.php');
    }
}
}
?>

<h1 class="text-center pt-5 mb-5" style="color:goldenrod">Create new Admin</h1>

<!-- insert form-->
<form class="p-3 mb-2 bg-secondary text-white" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label for="inputName">Name</label>
    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" >
</div>
<div class="form-group">
<label for="employeeProfile">Profile Pic</label>
    <input type="file" name="adminImage" id="employeeProfile">
</div>
<div class="form-group">
<label for="inputEmail">Email</label>
    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" >
</div>
<div class="form-group">
<label for="inputPassword">Password</label>
    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" >
</div>
<div class="form-group">
<label for="inputRole">Role</label>
    <select name="role" id="inputRole">
    <?php
    $select = "SELECT * FROM `role`";
    $ss= mysqli_query($connection, $select);
    foreach($ss as $s){?>
    <option value="<?php echo $s['id'] ?>"><?php echo $s['name'] ?></option>

    <?php }?>
    </select>
</div>
<button type="submit" class="btn btn-primary" name="submit" id="inputSubmit">Insert</button>
</form>

<?php
include '../shared/footer.php';
?>