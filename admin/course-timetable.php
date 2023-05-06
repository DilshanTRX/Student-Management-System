<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $course = $_POST['course'];
        $date = $_POST['courseDate'];
        $time = $_POST['time'];
        $ret = mysqli_query($bd, "INSERT into timetable(course_id,date,time) values('$course','$date','$time')");
        if ($ret) {
            $_SESSION['msg'] = "Course Created Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Course not created";
        }
    }

    if (isset($_GET['del'])) {
        mysqli_query($bd, "delete from timetable where id = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Student record deleted !!";
    }

    // if (isset($_GET['pass'])) {
    //     $password = "12345";
    //     $newpass = md5($password);
    //     mysqli_query($bd, "update students set password='$newpass' where StudentRegno = '" . $_GET['id'] . "'");
    //     $_SESSION['delmsg'] = "Password Reset. New Password is 12345";
    // }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | Time table</title>
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
                        <h1 class="page-head-line">Time Table </h1>
                    </div>
                </div>
                <div class="row">

                    <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>


                    <div class="row">
                        <div class="col-md-12">
                            <form name="timetable" method="post">
                                <div class="col-md-3">

                                    <select class="form-control col-md-6" name="course" id="course">
                                        <?php
                                    $sql = mysqli_query($bd, "select id,courseName from course");
    $cnt = 1;
    while ($row = mysqli_fetch_array($sql)) {
        echo '  <option>Select Course</option>
                                            <option value="'.$row[0].'">' . $row[1] . '</option>';
    }
    ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control col-md-6" type="date" name="courseDate">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control col-md-6" type="time" name="time">
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" name="submit" value="Save Time Table">
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Code </th>
                                            <th> Course Name </th>
                                            <th>Course Date</th>
                                            <th>Course Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
    $sql = mysqli_query($bd, "select timetable.id,course.courseName,timetable.date,course.courseCode,timetable.time from timetable inner join
                                             course on course.id = timetable.course_id");
    $cnt = 1;
    while ($row = mysqli_fetch_array($sql)) {
        ?>

                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo htmlentities($row['courseCode']); ?></td>
                                                <td><?php echo htmlentities($row['courseName']); ?></td>
                                                <td><?php echo htmlentities($row['date']); ?></td>
                                                <td><?php echo htmlentities($row['time']); ?></td>
                                                <td>
                                                    <a href="course-timetable.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
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

        <?php include('includes/footer.php'); ?>

        <script src="assets/js/jquery-1.11.1.js"></script>

        <script src="assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php } ?>