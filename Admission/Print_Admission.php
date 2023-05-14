<?php
include('../includes/config.php');
?>
<html>

<head>
	<title>Student Details</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Course Enroll</title>
	<link href="../assets/css/bootstrap.css" rel="stylesheet" />
	<link href="../assets/css/font-awesome.css" rel="stylesheet" />
	<link href="../assets/css/style.css" rel="stylesheet" />
	<script>
		window.onload = function() {
			window.print();
			window.history.back();
		}
	</script>

	<style type="text/css" media="print">
		th {
			height: 50px;
			width: auto;
			text-align: center;
		}

		td {
			height: 50px;
			width: auto;
			text-align: center;
		}
	

		@media print
      {
         @page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 72px;
           padding-bottom: 72px ;
         }
      } 

	</style>
</head>

<body>

<?php 

$Semester_id=$_GET['semester'];
$Index_no=$_GET['index'];
$stuid=$_GET['stuid'];

?>

<?php
					
					$sql1 = mysqli_query($bd, "SELECT DISTINCT courseenrolls.index_no,courseenrolls.student_id as regno,
					course.courseName ,year.year,semester.semester,students.studentName,exam.date,exam.exam_code,exam.name FROM exam 
					INNER JOIN courseenrolls on exam.course_id = courseenrolls.course inner JOIN
					students on students.StudentRegno = courseenrolls.student_id inner JOIN
					course on course.id = courseenrolls.course INNER JOIN
					year on year.id = courseenrolls.year INNER JOIN
                    semester on semester.id = courseenrolls.semester
					where courseenrolls.student_id='$stuid'");
													   
						 while ($row1 = mysqli_fetch_array($sql1)) {
							$newdate= $row1['date'];
							$formatedDate = date('M', strtotime($newdate));
							echo '
	<center> <img src="../assets/img/admission.png" style="width:50%; height:auto;" alt=""></center>
	<h4 style="text-align:right;">Exam No: '.$row1['exam_code'].'<h4>
	<h4 style="text-align:center;">'.$row1['name'].'</h4>
	<h4 style="text-align:center;">'.$row1['semester'].', '.$formatedDate.' – '.$row1['year'].'</h4>
	<div class="content-wrapper">
		<div class="container">

		



				<div class="row">
					<div class="col-sm-12">


						<div class="col-sm-12">
							<label for="">Name with Initials: </label>
							<input class="form-control col-md-12" type="text" name="courseDate" value="'.$row1['studentName'].'">
						</div>
						
						<div class="col-sm-6" style="width:50%;float:left">
							<label for="">Registration No:</label>
							<input class="form-control col-sm-6 " type="text" name="time" value="'.$row1['regno'].'">
						</div>
						<div class="col-sm-6" style="width:50%;float:left;">
							<label for="">Index No: </label>
							<input class="form-control col-sm-6 " type="text" name="time" value="'.$row1['index_no'].'">
						</div>

					</div>
				</div>

				';
						 }
?>
			</div>
			<br>
			<div class="row">
			<div class="row">
					<div class="col-md-12">

					<table border="1" style="width:90%; margin-left:45px;">

					<tr>
						<th>Date</th>
						<th>Time</th>
						<th>Sub.Code</th>
						<th>Title of the Subject</th>
						<th>Cand.Signature</th>
					</tr>

					<?php
					
$sql = mysqli_query($bd, "SELECT DISTINCT exam.id,exam.name,exam.date,exam.time,subject.subject_code,subject.name FROM exam 
INNER JOIN courseenrolls on exam.course_id = courseenrolls.course inner JOIN
course on course.id = courseenrolls.course inner join
subject on subject.course_id = course.id
where courseenrolls.student_id='$stuid'
GROUP by exam.id");
                                   
     while ($row = mysqli_fetch_array($sql)) {

		$date=$row['date'];
        $time=$row['time'];
		$subcode=$row['subject_code'];
		$subname=$row['name'];

				echo"	<tr>
						<td>$date</td>
						<td>$time</td>
						<td>$subcode</td>
						<td>$subname</td>
						<td> </td>
					    </tr>
					";
									   }
					?>
					</table>
						

					</div>
					<br>
					<h5 style="text-decoration: solid; margin-left:55px;"><b>Deputy Registrar<br>Examinations Divisions</b></h5>
				</div>
	</div>
			
		</div>

	</div>
	
	<script src="../assets/js/jquery-1.11.1.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
</body>

</html>
