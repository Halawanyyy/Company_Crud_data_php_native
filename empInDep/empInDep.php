<?php
include '../general/functions.php';
include '../general/env.php';
include '../shared/header.php';
include '../shared/nav.php';

$join="SELECT * FROM depandemp";
$joincheck=mysqli_query($connection,$join);
$a = mysqli_fetch_assoc($joincheck);
?>

<h2 class="text-center mb-5 pt-5" style="color:goldenrod">Employees in deps</h2>

<table class="table table-dark">
<?php
echo "<th>"."Id";
echo "<th>"."Name";
echo "<th>"."email";
echo "<th>"."salary";
echo "<th>"."Department";
foreach($joincheck as $data){
echo "<tr>";
echo "<td>". $data["empID"];
echo "<td>". $data["name"];
echo "<td>". $data["email"];
echo "<td>". $data["salary"];
echo "<td>". $data["dName"];
} ?>





<?php
include '../shared/footer.php';
?>