<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {



    if (isset($_GET['del'])) {
        mysqli_query($bd, "delete from students where StudentRegno = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Student record deleted !!";
    }

    if (isset($_GET['pass'])) {
        $password = "12345";
        $newpass = md5($password);
        mysqli_query($bd, "update students set password='$newpass' where StudentRegno = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Password Reset. New Password is 12345";
    }
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | Student Admission Print</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php if ($_SESSION['alogin'] != "") {
            include('includes/menubar.php');
        }
        ?>

        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Admission Course Students </h1>
                    </div>
                </div>
                <div class="row">

                    <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>

                  
                    <div class="row">
                        <div class="col-md-12">
                        <form action="" method="POST">
                        <div class="col-md-6">
                         
                                <select class="form-control col-md-6" name="course" id="course">
                                <option>Select Course</option>
                                    <?php
                                    $sql = mysqli_query($bd, "select id,courseName from course");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($sql)) {
                                        echo ' 
                                            <option value="'.$row[0].'">' . $row[1] . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                            <!-- <div class="col-md-3">
                                <input class="form-control col-md-6" type="date" name="courseDate">
                            </div> -->
                            <div class="col-md-3">
                                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                            </div>
                            </form>
                        </div>
                    </div>
                

                    <br>
                    <div class="panel panel-default col-md-12">
                        <div class="panel-heading">
                            Student Admission Print
                      
                        </div>


                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>

                                         
                                            <th>Student Name </th>
                                            <th> Student Registration No </th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

if(isset($_POST['course'])){
$course_id=$_POST['course'];
}
else{
    $course_id="";
}
                                    //     $sql1 = mysqli_query($bd, "SELECT COUNT(timetable.course_id) from timetable
                                    //     where timetable.course_id='1' and timetable.semester_id='1'");

                                    //     while ($row1 = mysqli_fetch_array($sql1)) {
                                    //             $classCount=$row1[0];
                                    //     }
                                        
                                    //     $sql12 = mysqli_query($bd, "SELECT COUNT(attendance.student_id) from attendance
                                    //     where attendance.course_id='1' and attendance.status='1'");
                                       
                                    //    while ($row2 = mysqli_fetch_array($sql2)) {
                                    //         $attenCount=$row2[0];
                                    //     }

                                        
                                        
                                         $sql = mysqli_query($bd, "SELECT DISTINCT exam.course_id,students.id as stuid,students.StudentRegno, students.studentName, courseenrolls.index_no, 
                                         courseenrolls.semester 
                                         FROM exam INNER JOIN courseenrolls ON courseenrolls.course = exam.course_id INNER JOIN
                                          students ON courseenrolls.student_id = students.StudentRegno INNER JOIN 
                                          attendance ON attendance.student_id = students.id 
                                          WHERE  ((SELECT COUNT(attendance.id) FROM attendance 
                                          WHERE courseenrolls.course='$course_id' and attendance.student_id =students.id AND attendance.course_id = exam.course_id AND 
                                          attendance.status = '1') / (SELECT COUNT(*) FROM timetable WHERE timetable.course_id = exam.course_id)) >= 0.8 
                                          ;");
                                   
                                       while ($row = mysqli_fetch_array($sql)) {
                                      
                                        $semester=$row['semester'];
                                        $indexno=$row['index_no'];  
                                        $stuid=$row['StudentRegno'];

                                      ?>
                                           
                                            <tr>
                                           
                                                <td><?php echo htmlentities($row['studentName']); ?></td>
                                                <td><?php echo htmlentities($row['StudentRegno']); ?></td>
                                             
                                                <td>
                                                    <a href=""></a>
                                                    <a href="../Admission/Print_Admission.php?date=&semester=<?php echo urlencode($semester); ?>&index=<?php echo urlencode($indexno); ?>&stuid=<?php echo urlencode($stuid); ?>" target="_blank">
  <button id="print-screen" class="btn btn-primary">Print Screen</button>
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

        <?php include('includes/footer.php'); ?>

        <script src="assets/js/jquery-1.11.1.js"></script>

        <script src="assets/js/bootstrap.js"></script>

  <!-- <script>
function printStudent() {
  window.open('../Admission/Print_Admission.php','studentWindow');
}
</script> -->

    </body>

    </html>
<?php } ?>