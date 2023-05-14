<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {

    if(isset($_POST['submit'])) {
        $exam_name=$_POST['exam_name'];
        $semester=$_POST['semester'];
        $year=$_POST['year'];
        $course=$_POST['course'];
        $subject=$_POST['subject'];
        $date=$_POST['exam_date'];
        $time=$_POST['exam_time'];
        $exam_code=$_POST['exam_code'];
        $ret=mysqli_query($bd, "INSERT into exam(exam_code,name,course_id,semester_id,year_id,subject_id,date,time) values('$exam_code','$exam_name','$course','$semester','$year','$subject','$date','$time')");
        if($ret) {
            $_SESSION['msg']="Course Created Successfully !!";
        } else {
            $_SESSION['msg']="Error : Course not created";
        }
    }
    if(isset($_GET['del'])) {
        mysqli_query($bd, "delete from exam where id= '".$_GET['id']."'");
        $_SESSION['delmsg']="Exam deleted !!";
    }
    ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Exam</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  
   

</head>

<body>
<?php include('includes/header.php');?>
    
<?php if($_SESSION['alogin']!="") {
    include('includes/menubar.php');
}
    ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Exams  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Exams 
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="exam" method="post">

    <div class="form-group">
    <label for="exam_name">Exam Code   </label>
    <input type="text" class="form-control" id="exam_code" name="exam_code" placeholder="exam code" required />
  </div>

   <div class="form-group">
    <label for="exam_name">Exam Name   </label>
    <input type="text" class="form-control" id="exam_name" name="exam_name" placeholder="exam name" required />
  </div>

  <div class="form-group">
    <label for="yearname">Year</label>
    <select name="year" id="year" class="form-control"  required>
      <option value="">Select a Year</option>
        <?php
        $sql = mysqli_query($bd, "select id,year from Year");
    while ($row = mysqli_fetch_array($sql)) {
        echo'<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select>
  </div>

  <div class="form-group">
    <label for="semester">Semester</label>
    <select name="semester" id="semester" class="form-control"  required>
      <option value="">Select a Semester</option>
        <?php
        $sql = mysqli_query($bd, "select id,semester from semester");
    while ($row = mysqli_fetch_array($sql)) {
        echo'<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select>
  </div>

 <div class="form-group">
    <label for="coursename">Course</label>
    <select name="course" id="course" class="form-control"  required>
      <option value="">Select a course</option>
        <?php
        $sql = mysqli_query($bd, "select id,courseName from course");
    while ($row = mysqli_fetch_array($sql)) {
        echo'<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select>
  </div>

  <div class="form-group">
    <label for="subjectname">Subject</label>
    <select name="subject" id="subject" class="form-control"  required>
      <option value="">Select a Subject</option>
        <?php
        $sql = mysqli_query($bd, "select code,name from subject");
    while ($row = mysqli_fetch_array($sql)) {
        echo'<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select>
  </div>

  <div class="form-group">
    <label for="date">Exam Date </label>
    <input class="form-control col-md-6" type="date" name="exam_date" required>
  </div>

  <div class="form-group">
    <label for="time">Exam Time </label>
    <input class="form-control col-md-6" type="time" name="exam_time" required>
  </div>

<br>
 <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Course
                        </div>
                       
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exam Name</th>
                                            <th>Year </th>
                                            <th>Semester</th>
                                            <th>Course </th> 
                                            <th>Subject </th>  
                                            <th>Date </th>  
                                            <th>Time </th>                                
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "SELECT exam.name as examname, year.year,semester.semester,course.courseName,
subject.name,exam.date,exam.time,exam.id FROM exam INNER JOIN year on year.id = exam.year_id INNER join 
semester on semester.id = exam.semester_id INNER join subject on subject.code = exam.subject_id INNER join 
course on course.id = subject.course_id;");
    $cnt=1;
    while($row=mysqli_fetch_array($sql)) {
        ?>


    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo htmlentities($row['examname']);?></td>
        <td><?php echo htmlentities($row['year']);?></td>
        <td><?php echo htmlentities($row['semester']);?></td>
        <td><?php echo htmlentities($row['courseName']);?></td>
        <td><?php echo htmlentities($row['name']);?></td>
        <td><?php echo htmlentities($row['date']);?></td>
   
        <td><?php echo htmlentities($row['time']);?></td>
        <td>                                     
  <a href="exam.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
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
    
  <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>

  
</body>
</html>
<?php } ?>