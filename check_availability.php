<?php 
require_once("includes/config.php");
if(!empty($_POST["cid"])) {
	$cid= $_POST["stu"];
	$studentregno= $_POST["studentregno"];

	
		$result =mysqli_query($bd, "SELECT student_id FROM 	courseenrolls WHERE course='$cid' and student_id='$studentregno");
		$count=mysqli_num_rows($result);
if($count>1)
{
echo "<span style='color:red'> Already Applied for this course.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} 
}
if(!empty($_POST["cid"])) {
	$cid= $_POST["cid"];
	
		$result =mysqli_query($bd, "SELECT * FROM 	courseenrolls WHERE course='$cid'");
		$count=mysqli_num_rows($result);
		$result1 =mysqli_query($bd, "SELECT noofSeats FROM course WHERE id='$cid'");
		$row=mysqli_fetch_array($result1);
		$noofseat=$row['noofSeats'];
if($count>=$noofseat)
{
echo "<span style='color:red'> Seat not available for this course. All Seats Are full</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} 
}

?>
