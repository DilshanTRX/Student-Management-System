<?php
session_start();
include('includes/config.php');
if(strlen($_studentregno['login'])==0)
    {   
header('location:Print_Admission.php');
}
else{



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enroll History</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
  
<?php if($_studentregno['login']!="")
{
 include('includes/menubar.php');
}
 ?>

    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Print Admission  </h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Print Admission
                        </div>
                      
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name </th>
                                            <th>Registration Number </th>
                                            <th> Index Number</th>
                                             <th>Course Code</th>
                                                <th>Course Name</th>
                                             <th>Level</th>
                                             <th>Semester</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select admission.course as cid, course. studentName as  studentName,studentregno  .studentregno    as studentregno    ,Index Number.Index Number as studentindexno,level.level as level,admission.enrollDate as edate ,semester.semester as semester from admission join course on course.id=admission.course join studentregno on studentregno.id=admission.studentregno join department on department.id=admission.department join level on level.id=admission.level  join semester on semester.id=admission.semester  where admission.studentRegno='".$_studentregno['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['studentregno  ']);?></td>
                                            <td><?php echo htmlentities($row['studentindexno']);?></td>
                                            <td><?php echo htmlentities($row['level']);?></td>
                                            <td><?php echo htmlentities($row['semester']);?></td>
                                             <td><?php echo htmlentities($row['edate']);?></td>
                                            <td>
                                            <a href="print.php?id=<?php echo $row['cid']?>" target="_blank">
<button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> </a>                                        


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
   
  <?php include('includes/footer.php');?>
   
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
