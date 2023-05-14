<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {


    if(isset($_POST['submit'])) {
        $lecturername=$_POST['lecturername'];
        $department=$_POST['department'];
        $coursename=$_POST['coursename'];
        $ret=mysqli_query($bd, "insert into lecturer(name,department_id,course_id) values('$lecturername','$department','$coursename')");
        echo $ret;
        if($ret) {
            $_SESSION['msg']="Lecturer Details Successfully Added !!";
            echo "Lecturer Details Successfully Added !!";
        } else {
            $_SESSION['msg']="Error : Lecturer Details not Added";
            echo "Error:".mysqli_error($bd);
        }
    }
    if(isset($_GET['del'])) {
        mysqli_query($bd, "delete from lecturer where id = '".$_GET['id']."'");
        $_SESSION['delmsg']="Course deleted !!";
    }
    ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Student Registration</title>
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
                        <h1 class="page-head-line">Lecturer Details  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Lecturer Details
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="lecturername">Lecturer Name  </label>
    <input type="text" class="form-control" id="lecturername" name="lecturername" placeholder="Lecturer Name" required />
  </div>
 <div class="form-group">
    <label for="department">Department   </label>
    <select name="department" id="department" class="form-control" required>
      <option value="">Select a department</option>
        <?php

        $sql = mysqli_query($bd, "select id,department from department");

    while ($row = mysqli_fetch_array($sql)) {
        echo'<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select>
  </div>
 <div class="form-group">
    <label for="coursename">Course   </label>
    <select name="coursename" id="coursename" class="form-control"  required>
      <option value="">Select a course</option>
        <?php
        $sql = mysqli_query($bd, "select id,courseName from course");
    while ($row = mysqli_fetch_array($sql)) {
        echo'<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select>
  </div>

 <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <div class="col-md-12">

<div class="panel panel-default">
    <div class="panel-heading">
        Manage Lecturers
    </div>

    <div class="panel-body">
        <div class="table-responsive table-bordered">
            <table class="table">
                <thead>
                    <tr>
                        <th >Id</th>
                        <th>Name</th>
                        <th>Creation Date</th>
                        <th>Course ID</th>
                        <th>Department ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $sql = mysqli_query($bd, "select lecturer.id,lecturer.name,course.courseName,department.department,lecturer.created_date from lecturer INNER JOIN
                       department on department.id = lecturer.department_id INNER JOIN
                       course on course.id = lecturer.course_id");
    $cnt = 1;
    while ($row = mysqli_fetch_array($sql)) {
        ?>


                        <tr>
                            <td><?php echo htmlentities($row['id']);?></td>
                            <td><?php echo htmlentities($row['name']); ?></td>
                            <td><?php echo htmlentities($row['created_date']); ?></td>
                            <td><?php echo htmlentities($row['courseName']); ?></td>
                            <td><?php echo htmlentities($row['department']); ?></td>
                            <td>
                                <a href="lecturer.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php
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
<!-- <script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'regno='+$("#department").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script> -->


</body>
</html>
<?php } ?>