<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';

?>
<h2 class="text-center mb-5 pt-5" style="color:goldenrod">Departments list</h2>
<!-- table display-->
<table class="table table-dark">
<?php
echo "<th>"."Id";
echo "<th>"."Name";
$select = "SELECT * FROM `departments` ORDER BY id";
$alldata = mysqli_query($connection, $select);
foreach($alldata as $data){
echo "<tr>";
echo "<td>". $data["id"];
echo "<td>". $data["dName"];
} ?>






<?php
include '../shared/footer.php';
?>