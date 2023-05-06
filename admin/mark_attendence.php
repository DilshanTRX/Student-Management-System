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
        <title>Admin | Course</title>
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
                        <h1 class="page-head-line">Course </h1>
                    </div>
                </div>
                <div class="row">

                    <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
         

                        <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-6">
                            <select class="form-control col-md-6"  name="course" id="course">
                            <?php
                                        $sql = mysqli_query($bd, "select courseCode,courseName from course");
    $cnt = 1;
    while ($row = mysqli_fetch_array($sql)) {
        echo'  <option>Select Course</option>
                                            <option value="">'.$row[1].'</option>';
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
                                        </div>
                        </div>

                        <br>
                        <div class="panel panel-default col-md-12">
                            <div class="panel-heading">
                                Student Time Table
                                 <input type="submit" name="submit" value="Save all Attendence" class="btn btn-success" style="margin-left: 10px">
                            </div>


                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                    
                                                <th>Reg No </th>
                                                <th>Student Name </th>
                                                <th> Student pincode no </th>
                                                <th>Reg Date</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
    $sql = mysqli_query($bd, "select * from students");
    $cnt = 1;
    while ($row = mysqli_fetch_array($sql)) {
        ?>


                                                <tr>
                                                    <td><?php echo htmlentities($row['StudentRegno']); ?></td>
                                                    <td><?php echo htmlentities($row['studentName']); ?></td>
                                                    <td><?php echo htmlentities($row['pincode']); ?></td>
                                                    <td><?php echo htmlentities($row['creationdate']); ?></td>
                                                    <td>
                                                        <select name="attendence" id="attendence" class="form-control" required>
                                                            <option value="">mark</option>
                                                            <option value="present">present</option>    
                                                            <option value="absent">absent</option>    
                                                        </select>
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