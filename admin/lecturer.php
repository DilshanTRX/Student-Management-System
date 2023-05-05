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
                <div class="col-md-3"></div>
                    <div class="col-md-12">
                        <h1 class="page-head-line">Lecturer Details  </h1>
                    </div>
                </div>
                <div class="row">
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
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
  </div>
    

  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
<script>
function userAvailability() {

</script>


</body>
</html>
<?php } ?>