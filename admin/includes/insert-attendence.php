<?php
include('config.php');

if(isset($_POST['submit'])){

    // Get the values from the form
    $statusArray = isset($_POST['status']) ? $_POST['status'] : array();
    $studentIdArray = isset($_POST['student_id']) ? $_POST['student_id'] : array();
    $courseIdArray = isset($_POST['course_id']) ? $_POST['course_id'] : array();
    $attenDateArray = isset($_POST['AttenDate']) ? $_POST['AttenDate'] : array();
echo count($statusArray);
    // Loop through the arrays and insert attendance records
    for($i=0; $i<count($statusArray); $i++){
        $status = isset($statusArray[$i]) ? 1 : 0;
        $studentId = $studentIdArray[$i];
        $courseId = $courseIdArray[$i];
        $attenDate = $attenDateArray[$i];

        // Prepare the insert statement
        $insertQuery = "INSERT INTO attendance (student_id, course_id,date, status) VALUES ('$studentId', '$courseId', '$attenDate', $status)";
echo$insertQuery;
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
    $_SESSION['status'] = "Attendance Saved";
}

echo "<script>
alert('Attendance marked successfully!');
document.location='../mark_attendence.php'

</script>";

?>
