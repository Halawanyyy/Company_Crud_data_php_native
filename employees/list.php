<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();
$check=false;
if(isset($_GET['delete'])){
    $deleteID = $_GET['delete'];
    
    //Delete image from upload
    $selectImage = "SELECT `image` from employees where id = $deleteID" ;
    $query = mysqli_query($connection, $selectImage);
    $row = mysqli_fetch_assoc($query);
    $image= $row['image'];
    unlink("./upload/".$image);
    
    //
    $delete = "DELETE FROM employees WHERE id = $deleteID";
    $deleteCheck = mysqli_query($connection, $delete);

    
    path('employees/list.php#return');
}
if(isset($_GET['submit'])){
    $sId = $_GET['sId'];
    $eId = $_GET['eId'];
    $search = $_GET['search'];
    if(!($sId=="") and $eId==""){
    $delete1 = "DELETE FROM employees WHERE id >= $sId";
    $deleteCheck1 = mysqli_query($connection, $delete1);
    path('employees/list.php');
    }else if(!($sId=="") and !($eId=="")){
    $delete2 = "DELETE FROM employees WHERE id BETWEEN $sId and $eId";
    $deleteCheck2 = mysqli_query($connection, $delete2);
    path('employees/list.php');
    }else if(!($search=="")){
        $select = "SELECT * FROM `depandemp` WHERE `name` like '%$search%' ";
        $check=true;
    }
    
}

?>
<h1 class="text-center mb-5 pt-5" style="color:goldenrod">Employees list</h1>

<form action="">
<div class="form-check form-check-inline ">
<label class="form-check-label" for="inlineCheckbox1" >start  </label>
<input type="number" class="form-control"  placeholder="sId" name="sId" >
</div>
<div class="form-check form-check-inline">
<label class="form-check-label" for="inlineCheckbox2">End  </label>
<input type="number" class="form-control"  placeholder="eId" name="eId" >

</div>
<div class="form-check form-check-inline">
<label class="form-check-label" for="inlineCheckbox3">search</label>
<input type="text" name="search" id="">
</div>

<div class="form-check form-check-inline">
<input type="radio" class="form-check-input" name="cBox1" id="Checkbox1" value="ASC">
<label class="form-check-label" for="Checkbox1">Asc</label>

</div>

<div class="form-check form-check-inline">
<input type="radio" class="form-check-label" name="cBox1" id="Checkbox1" value="DESC">
<label class="form-check-label" for="Checkbox2">Desc</label>
</div>

<input type="submit" value="submit" name="submit">
</form>
<!-- table display-->
<table class="table table-dark">
    
<?php
echo "<th>"."Profile";
echo "<th>"."Id";
echo "<th>"."Name";
echo "<th>"."email";
echo "<th>"."salary";
echo "<th>"."Department";
echo "<th>"."Actions";
if(!$check){
    $select = "SELECT * FROM `depandemp` ORDER by empID ";
}
/*if($_GET['cBox1']=='ASC'){
    $select=
}elseif($_GET['cBox1']=='DESC'){
    $select=$select." ORDER BY `depandemp`.`salary` DESC";
}
*/
$alldata = mysqli_query($connection, $select);
foreach($alldata as $data){
echo "<tr>";
?>
<td>
    <img src="/odc4/employees/upload/<?= $data['image'] ?>" width="30px" >
</td>
<?php
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