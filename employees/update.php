<?php
include '../general/env.php';
include '../general/functions.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();


if(isset($_GET['update'])){



    $updateId = $_GET['update'];
    $a = "SELECT * from employees where id=$updateId";
    $aa = mysqli_query($connection, $a);
    $row = mysqli_fetch_assoc($aa);
    if(isset($_POST['submit'])){
    $name=$_POST["name"];
    $salary=(int)$_POST["salary"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $department=$_POST["department"];

    if(empty($_FILES['image']['name'])){
        $image_name = $row['image'];
    }else{
        $pre_image = $row['image'];
        unlink("./upload/".$pre_image);
        $image_name=$_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = "./upload/$image_name";
        move_uploaded_file($tmp_name, $location);
    }


    $u = "UPDATE employees set `name` = '$name', salary = $salary,`image`='$image_name',email = '$email', `password` = $password, `departmentId`= $department where id =$updateId ";
    $updateCheck = mysqli_query($connection, $u);
    path('/employees/list.php');
    }
    
}

?>
<h2 class="text-center mb-5 pt-5" style="color:goldenrod">Update employee</h2>
<!-- update form-->





<form class="p-3 mb-2 bg-secondary text-white" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label for="inputName">Name</label>
    <input type="text" class="form-control" id="employeeName" placeholder="Name" name="name" value="<?php if(isset($row)){echo $row['name'];} ?>">
</div>
<div class="form-group">
<label for="inputSalary">Salary</label>
    <input type="text" class="form-control" id="employeeSalary" placeholder="Salary" name="salary" value="<?php if(isset($row)){echo $row['salary'];} ?>">
</div>
<div class="form-group">
<label for="employeeProfile">Profile Pic</label>
    <input type="file" name="image" id="employeeProfile">
</div>
<div class="form-group">
<label for="inputEmail">Email</label>
    <input type="email" class="form-control" id="employeeEmail" placeholder="Email" name="email" value="<?php if(isset($row)){echo $row['email'];} ?>">
</div>
<label for="inputEmail">Password</label>
    <input type="password" class="form-control" id="employee" placeholder="Password" name="password" value="<?php if(isset($row)){echo $row['password'];} ?>">
</div>
<br>
<label for="inputDepartment">Department</label>
    <select name="department" id="employeeDepartment" >
        <?php
        $select = "SELECT * FROM `departments`";
        //$select = "SELECT * FROM `departments` ORDER BY id";
        $options = mysqli_query($connection, $select);
        foreach($options as $b){?>
        <option value="<?php echo $b['id']; ?>" <?php if($row['departmentId']==$b['id']){ echo 'selected';}  ?>><?php echo"$b[dName]" ?></option>
    <?php }?>
    </select>
    <br>
</div>
<button type="submit" class="btn btn-primary" name="submit" id="inputSubmit">Update</button>
</form>

<?php
include '../shared/footer.php';
?>