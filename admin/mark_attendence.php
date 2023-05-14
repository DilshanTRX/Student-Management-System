<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

  
 ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | Attendance</title>
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
                        <h1 class="page-head-line">Attendance </h1>
                    </div>
                </div>
                <div class="row">

                    <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>

              
                    <div class="row">
                        <div class="col-md-12">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <select class="form-control col-md-6" name="course" id="course">
                                <option>Select Course</option>
                                    <?php
                                    $sql1 = mysqli_query($bd, "select id,courseName from course");
                                    // $cnt = 1;
                                    while ($row1 = mysqli_fetch_array($sql1)) {
                                        echo '
                                            <option value="' . $row1[0] . '">' . $row1[1] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input class="form-control col-md-6" type="date" name="courseDate">
                            </div>
                            <div class="col-md-3">
                                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                            </div>
                            </form>
                        </div>
                    </div>
                

                    <br>
                    <div class="panel panel-default col-md-12">
                        <div class="panel-heading">
                            Student Time Table
                          
                        </div>


                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                            <form action="includes/insert-attendence.php" method="POST" enctype="multipart/form-data">
                                <table class="table">
                                    
                                    <thead>
                                        <tr>

                                            <th>Reg No </th>
                                            <th>Student Name </th>
                                            <th>Reg Date</th>
                                            <th>Time</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                            $course_id="";
                            $Date="";

                                        if(isset($_POST['course']) && isset($_POST['courseDate'])){
                                            $course_id=$_POST['course'];
                                            $Date=$_POST['courseDate'];
                                // echo"<script>alert('$course_id-$Date')</script>";
                                 $sql = mysqli_query($bd, "select student_id,course,students.studentName,timetable.date,timetable.time,students.id from courseenrolls inner join
                                        students on students.StudentRegNo = courseenrolls.student_id inner join
                                        timetable on timetable.course_id = courseenrolls.course
                                         where courseenrolls.course='$course_id' and timetable.date='$Date'");
                                    //    echo $sql;
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>


                                            <tr>
                                                <td><?php echo htmlentities($row['student_id']); ?></td>
                                                <td><?php echo htmlentities($row['studentName']); ?></td>
                                                <td><?php echo htmlentities($row['date']); ?></td>
                                                <td><?php echo htmlentities($row['time']); ?></td>
                                               
                                                <td>
                                               
                                                <input type="checkbox" name="status[]" id="status" style="width:30px; height:30px;">
                                                <input type="hidden" name="student_id[]" id="student_id" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="course_id[]" id="course_id" value="<?php echo $row['course']; ?>">
                                                <input type="hidden" name="AttenDate[]" id="AttenDate" value="<?php echo $row['date']; ?>">
                                                                    
                                                </td>
                                            </tr>
                                         
                                      
                                            <?php
                                        } 
                                    }
                                     
                                        ?>

                                     
                                       
                                    </tbody>
                                  
                                </table>
                                <input type="submit" name="submit" value="Save all Attendence" class="btn btn-success" style="margin-right: 900px;">
                                       <br>
                            </form> 
                            <br> 
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
    </body>

    </html>
<?php } ?>