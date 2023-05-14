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
        <title>Admin | Student Performance</title>
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
                        <h1 class="page-head-line">Student Performance </h1>
                    </div>
                </div>
                <div class="row">

                    <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>

              
                    <div class="row">
                        <div class="col-md-12">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="col-md-4">
                                <select class="form-control col-md-6" name="exam" id="exam">
                                <option>Select exam</option>
                                    <?php
                                    $sql1 = mysqli_query($bd, "select id,name from exam");
                                    // $cnt = 1;
                                    while ($row1 = mysqli_fetch_array($sql1)) {
                                        echo '
                                            <option value="' . $row1[0] . '">' . $row1[1] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                            <select class="form-control col-md-6" name="semester" id="semester">
                                <option>Select Semester</option>
                                    <?php
                                    $sql1 = mysqli_query($bd, "select id,semester from semester");
                                    // $cnt = 1;
                                    while ($row1 = mysqli_fetch_array($sql1)) {
                                        echo '
                                            <option value="' . $row1[0] . '">' . $row1[1] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <input type="number" name="credithours" value="Search" class="form-control" placeholder="Hours">
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
                        Student Performance
                          
                        </div>


                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                            <form action="includes/save-marks.php" method="POST" enctype="multipart/form-data">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Reg No </th>
                                            <th>Student Name </th>
                                            <th> Student Index No </th>
                                            <th>Subject Name</th>
                                            <th>Exam</th>
                                            <th>Marks</th>
                                            <th>Credit Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                           

                                        if(isset($_POST['exam']) && isset($_POST['semester'])&& isset($_POST['credithours'])){
                                            $exam_id=$_POST['exam'];
                                            $semester_id=$_POST['semester'];
                                            $credithours=$_POST['credithours'];
                                // echo"<script>alert('$course_id-$Date')</script>";
                                 $sql = mysqli_query($bd, "select exam.id,exam.semester_id,exam.year_id,exam.name as examname,course.courseName,subject.code,exam.course_id,subject.name as subname,
                                 courseenrolls.student_id,students.studentName,students.id as stuid from exam inner JOIN
                                 subject on subject.code = exam.subject_id inner JOIN
                                 course on course.id = subject.course_id inner JOIN
                                 courseenrolls on courseenrolls.course = subject.course_id INNER JOIN
                                 students on students.StudentRegno=courseenrolls.student_id INNER JOIN
                                 semester on semester.id = exam.semester_id
                                 WHERE exam.id='$exam_id' and semester.id='$semester_id'");
                                    //    echo $sql;
                                    
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>


                                            <tr>
                                                <td><?php echo htmlentities($row['student_id']); ?></td>
                                                <td><?php echo htmlentities($row['studentName']); ?></td>
                                                <td><?php echo htmlentities($row['examname']); ?></td>
                                                <td><?php echo htmlentities($row['course']); ?></td>
                                                <td><?php echo htmlentities($row['subname']); ?></td>
                                               
                                                <td>
                                                <input type="text" name="marks[]" id="marks">
                                                <input type="hidden" name="student_id[]" id="student_id" value="<?php echo $row['stuid']; ?>">
                                                <input type="hidden" name="exam_id[]" id="exam_id" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="semester_id[]" id="semester_id" value="<?php echo $row['semester_id']; ?>">
                                                <input type="hidden" name="year_id[]" id="year_id" value="<?php echo $row['year_id']; ?>">
                                                <input type="hidden" name="subject_id[]" id="subject_id" value="<?php echo $row['code']; ?>">
                                                <input type="hidden" name="course_id[]" id="course_id" value="<?php echo $row['course_id']; ?>">
                                                <input type="hidden" name="credithours[]" id="credithours" value="<?php echo $credithours; ?>"> 
                                                </td>
                                                <td><?php echo htmlentities($credithours); ?></td>
                                            </tr>
                                         
                                      
                                            <?php
                                        } 
                                    }
                                     
                                        ?>

                                     
                                       
                                    </tbody>
                                  
                                </table>
                                <input type="submit" name="submit" value="Save all Marks" class="btn btn-success" style="margin-right: 900px;">
                                       <br>
                                       <br>
                            </form> 
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