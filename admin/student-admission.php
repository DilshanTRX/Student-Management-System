<!DOCTYPE html>
<html>
<head>
	<title>Student List</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3./1css/bootstrap.min.css">
	<!-- Custom CSS -->
	<style type="text/css">
		table {
			margin-top: 20px;
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}

		tr:hover {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Student List</h2>
		<button class="btn btn-primary" onclick="printTable()">Print</button>
		<table id="student-table">
			<thead>
				<tr>
					<th>Student ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// Create an array of students
					$students = array(
						array('id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'phone' => '123-456-7890'),
						array('id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'phone' => '555-555-5555'),
						array('id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob.johnson@example.com', 'phone' => '555-123-4567')
					);

					// Loop through the array of students and display them in a table row
					foreach ($students as $student) {
						echo '<tr>';
						echo '<td>' . $student['id'] . '</td>';
						echo '<td>' . $student['name'] . '</td>';
						echo '<td>' . $student['email'] . '</td>';
						echo '<td>' . $student['phone'] . '</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Custom JS -->
	<script type="text/javascript">
		function printTable() {
			var printContents = document.getElementById("student-table").outerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>
</body>
</html>
