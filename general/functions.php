<?php
function test($condition, $message)
{
    if($condition)
        echo "Correct ".$message;
    else
        echo "False ".$message;
}
function path($p){
    echo "
    <script>
    location.replace('/odc4/$p')
    </script>
    ";
}
?>