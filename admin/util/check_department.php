<?php
require_once("includes/config.php");
if(!empty($_POST["department"])) {
    $department_id = $_POST["department"];
    $result =mysqli_query($bd, "SELECT id FROM department WHERE id='$department_id'");
    $count=mysqli_num_rows($result);
    if($count>0) {
        echo "<span style='color:red'> Department with this Regno Already Registered.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {


    }
}
