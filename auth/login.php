<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';

if(isset($_POST["submit"]) ){
$name=$_POST['name'];
$password = sha1($_POST['password']);

$select = "SELECT * FROM admins WHERE `name`='$name' and `password`='$password'";
$query = mysqli_query($connection, $select);
$rowsNum = mysqli_num_rows($query);
$row = mysqli_fetch_assoc($query);

if($rowsNum == 1){
    $_SESSION['admin']=[
        'name'=>$row['name'],
        'role'=>$row['role'],
        'id'=>$row['id']
    ];
    echo "<script>alert('Welcome Admin')</script>";
    path("index.php");
}else{
    echo "Wrong data";
}

}
?>

<h1 class="text-center pt-5 mb-5" style="color:goldenrod">Login page</h1>

<!-- insert form-->
<form class="p-3 mb-2 bg-secondary text-white" method="POST" >
<div class="form-group">
<label for="inputName">Name</label>
    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" >
</div>
<div class="form-group">
<label for="inputPassword">Password</label>
    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" >
</div>
<button type="submit" class="btn btn-primary" name="submit" id="inputSubmit">Insert</button>
</form>
<?php
include '../shared/footer.php';
?>