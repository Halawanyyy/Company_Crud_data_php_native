<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();
//submit
if(isset($_POST["submit"]) ){
    $name=$_POST["name"];
    $salary=(int)$_POST["salary"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $department=$_POST["department"];

    //ADD image
    $image_name = time().$_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/$image_name";
    move_uploaded_file($tmp_name, $location);


    if(empty($name) or empty($salary)  or empty($email) or empty($department) or empty($password))
    {
    echo'   <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Cant submit with one or more empty fields</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
}else{
    $insert="INSERT INTO employees VALUES(null,'$name',$salary,'$image_name','$password','$email',$department)";
    $insertCheck = mysqli_query($connection, $insert);
    if($insertCheck){
        path('employees/list.php');
    }

}
}
?>
<h1 class="text-center pt-5 mb-5" style="color:goldenrod">Create new employee</h1>

<!-- insert form-->
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
        $options = mysqli_query($connection, $select);
        foreach($options as $b){?>
        <option value="<?php echo"$b[id]" ?>"><?php echo"$b[dName]" ?></option>
    <?php }?>
    </select>
    <br>
</div>
<button type="submit" class="btn btn-primary" name="submit" id="inputSubmit">Insert</button>
</form>

<?php
include '../shared/footer.php';
?>