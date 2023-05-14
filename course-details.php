<?php
session_start();
//test
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
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
    <title>Course Details</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
  
<?php if($_SESSION['login']!="")
{
 include('includes/menubar.php');
}
 ?>
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course Details </h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Course Details
                        </div>
                      
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exam Name</th>
                                            <th>Semester </th>
                                            <th> Year</th>
                                             <th>Subject Name</th>
                                                <th>Course Name</th>
                                             <th>marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select exam.name as examname,semester.semester,year.year,subject.name as subname,
course.courseName,studentperformance.marks,studentperformance.credithours  FROM studentperformance inner JOIN
exam on exam.id = studentperformance.exam_id INNER JOIN
semester on semester.id = studentperformance.semester_id inner JOIN
year on year.id = studentperformance.year_id inner JOIN
subject on subject.code = studentperformance.subject_id inner JOIN
course on course.id = studentperformance.course_id inner JOIN
students on students.id = studentperformance.student_id INNER JOIN
courseenrolls on courseenrolls.student_id = students.StudentRegno
where courseenrolls.student_id='".$_SESSION['login']."'");
$cnt=1;
$gpa = 0.0;
$total_credit_hours = 0;
while($row=mysqli_fetch_array($sql))
{
    $marks = $row['marks'];
    $credit_hours = $row['credithours'];
    $grade_point = 0.0;
    
    if($marks >= 85)
    {
        $grade_point = 4.0;
    }
    elseif($marks >= 75)
    {
        $grade_point = 3.0;
    }
    elseif($marks >= 65)
    {
        $grade_point = 2.0;
    }
    elseif($marks >= 50)
    {
        $grade_point = 1.0;
    }
    else
    {
        $grade_point = 0.0;
    }
    
    $total_credit_hours += $credit_hours;
    $gpa += ($grade_point * $credit_hours);


if($total_credit_hours > 0)
{
    $gpa /= $total_credit_hours;
}
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['examname']);?></td>
                                            <td><?php echo htmlentities($row['semester']);?></td>
                                            <td><?php echo htmlentities($row['year']);?></td>
                                            <td><?php echo htmlentities($row['subname']);?></td>
                                            <td><?php echo htmlentities($row['courseName']);?></td>
                                             <td><?php echo htmlentities($row['marks']);?></td>
                                           
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
<br>
                            <div class="col-md-3">
                            <label for="">GPA :</label>
                            <input type="text" class="form-control" name="gpa" value="<?php echo $gpa; ?>" readonly>
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
