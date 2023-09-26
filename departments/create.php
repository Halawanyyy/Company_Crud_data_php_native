<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';
auth();

if(isset($_GET["submit"]) ){
    $name=$_GET["name"];
    if(empty($name)  )
    {
    echo'   <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Cant submit with one or more empty fields</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
}else{
    $insert="INSERT INTO `departments` VALUES(null,'$name')";
    $insertCheck = mysqli_query($connection, $insert);
    if($insertCheck){
path('/departments/list.php');
    }else{
        echo'   <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Already existed department</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
    }
    
}
}
?>
<h2 class="text-center mb-5 pt-5" style="color:goldenrod">Create department</h2>
<!-- insert form-->
    <form class="p-3 mb-2 bg-secondary text-white" >
<div class="form-group">
<label for="inputName">Name</label>
    <input type="text" class="form-control" id="inputName" placeholder="name" name="name">
</div>

<button type="submit" class="btn btn-primary" name="submit" id="inputSubmit">Insert department</button>
</form>
<?php
include '../shared/footer.php';
?>