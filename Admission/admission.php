`<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:admission.php');
}
else{

if(isset($_POST['submit']))
{
$studentname=$_POST['studentName'];
$Studentregno=$_POST['Studentregno'];
$studentindexno=$_POST['studentindexno'];
$level=$_POST['level'];
$semester=$_POST['semester'];
$courseCode=$_POST['courseCode'];
$courseName=$_POST['courseName'];
$ret=mysqli_query($bd, "insert into admission(studentName,Studentregno,studentindexno,level,semester,courseCode,courseName) values('$studentname','$Studentregno','$studentindexno','$level','$semester','$courseCode','$courseName')");
if($ret)
{
$_SESSION['msg']="Student Admission Card Created !!";
echo "Student Student Admission Card Created !!";
}
else
{
  $_SESSION['msg']="Error : Student Admission Card not Created";
  echo "Error:".mysqli_error($bd);
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Student Admission Card</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Admission Card </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Student Admission Card
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="studentName">Student Name  </label>
    <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Student Name" required />
  </div>

 <div class="form-group">
    <label for="Studentregno">Student Reg No   </label>
    <input type="text" class="form-control" id="Studentregno" name="Studentregno"  placeholder="Student Reg no" required />
     <span id="user-availability-status1" style="font-size:12px;">
  </div>



  <div class="form-group">
    <label for="studentindexno">Student Index no  </label>
    <input type="text" class="form-control" id="studentindexno" name="studentindexno" " placeholder="Student Index no" required />
     <span id="user-availability-status1" style="font-size:12px;">
  </div>

  <div class="form-group">
    <label for="level">Level </label>
    <input type="level" class="form-control" id="level" name="level" placeholder="Enter level" required />
  </div>  

  <div class="form-group">
    <label for="semester">Semester </label>
    <input type="semester" class="form-control" id="semester" name="semester" placeholder="Enter Semester" required />
  </div>   

  <div class="form-group">
    <label for="courseCode">CourseCode </label>
    <input type="courseCode" class="form-control" id="courseCode" name="courseCode" placeholder="Course Code" required />
  </div>   

  <div class="form-group">
    <label for="courseName">CourseName </label>
    <input type="courseName" class="form-control" id="courseName" name="courseName" placeholder="Course Name" required />
  </div>   



 <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>

            </div>





        </div>
    </div>

    





        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'regno='+$("#studentregno").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } ?>
