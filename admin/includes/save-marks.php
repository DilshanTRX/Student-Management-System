<?php
include('config.php');

if(isset($_POST['submit'])){

    // Get the values from the form
    $marksArray = isset($_POST['marks']) ? $_POST['marks'] : array();
    $studentIdArray = isset($_POST['student_id']) ? $_POST['student_id'] : array();
    $examIdArray = isset($_POST['exam_id']) ? $_POST['exam_id'] : array();
    $semesterIdArray = isset($_POST['semester_id']) ? $_POST['semester_id'] : array();
    $yearIdArray = isset($_POST['year_id']) ? $_POST['year_id'] : array();
    $subjectIdArray = isset($_POST['subject_id']) ? $_POST['subject_id'] : array();
    $courseIdArray = isset($_POST['course_id']) ? $_POST['course_id'] : array();
    $credithoursArray = isset($_POST['credithours']) ? $_POST['credithours'] : array();
        echo count($marksArray);
    // Loop through the arrays and insert attendance records
    for($i=0; $i<count($marksArray); $i++){
        $marks = $marksArray[$i];
        $studentId = $studentIdArray[$i];
        $examId = $examIdArray[$i];
        $semesterId = $semesterIdArray[$i];
        $yearId = $yearIdArray[$i];
        $subjectId = $subjectIdArray[$i];
        $courseId = $courseIdArray[$i];
        $credithours = $credithoursArray[$i];

        // Prepare the insert statement
        $insertQuery = "INSERT INTO studentperformance(exam_id,semester_id,year_id,subject_id,course_id,student_id,marks,credithours) VALUES ('$examId','$semesterId','$yearId','$subjectId','$courseId','$studentId','$marks','$credithours')";
       echo $insertQuery;
        // Execute the insert statement
        $result = mysqli_query($bd, $insertQuery);

        // Check if the insert was successful
        if (!$result) {
            // Error occurred, display error message and exit loop
            echo "Error: " . mysqli_error($bd);
            break;
        }
    }

    // Set a session variable to indicate that the attendance was saved
    $_SESSION['status'] = "Marks Saved";
}

echo "<script>
alert('Marks Added successfully!');
document.location='../student-academic-performance.php'
</script>";

?>
