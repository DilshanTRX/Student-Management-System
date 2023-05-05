<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{

$studentregno=$_POST['studentregno'];
$coursecode=$_POST['coursecode'];
$Total_lecture=$_POST['Total_lecture'];
$count=$_POST['count'];
 $percentage = ($count / $Total_lecture) * 100;

$ret=mysqli_query($bd, "insert into attendence(StudentRegno,courseCode,Total_lecture,count,percentage) values('$studentregno','$coursecode','$Total_lecture','$count','$percentage')");

if($ret)
{
$_SESSION['msg']="Student Attendence Created !!";
echo "Student Attendence Created !!";
}
else
{
  $_SESSION['msg']="Error : Student Attendence  not Created";
  echo "Error:" .mysqli_error($bd);
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
    <title>Admin | Student Attendence</title>
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
                        <h1 class="page-head-line">Student Attendence  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Student Attendence
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">

   <div class="form-group">
    <label for="studentregno">Student Reg No  </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno" placeholder="Student Reg no" required />
  </div>

  <div class="form-group">
    <label for="coursecode">Course Code  </label>
    <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" required />
  </div>
  <div class="form-group">
    <label for="coursecode">Total lecture  </label>
    <input type="text" class="form-control" id="Total_lecture" name="Total_lecture" placeholder="Total lecture" required />
  </div>

  <div class="form-group">
    <label for="count">Count  </label>
    <input type="text" class="form-control" id="count" name="count" placeholder="Count" required />
  </div>



 <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>

            </div>

<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Student Attendence
                        </div>
                       
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Reg No </th>
                                            <th>Course Code  </th>
                                            <th>Total lecture</th>
                                            <th>Count</th>
                                            <th>Percentage</th>
                                            
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select * from attendence");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['StudentRegno']);?></td>
                                            <td><?php echo htmlentities($row['courseCode']);?></td>
                                            <td><?php echo htmlentities($row['Total_lecture']);?></td>
                                             <td><?php echo htmlentities($row['count']);?></td>
                                             <td><?php echo htmlentities($row['percentage']);?></td>
                                           
                                            <td>
                                            <a href="edit-attendence.php?id=<?php echo $row['id']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>                                        
  <a href="attendence.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
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
