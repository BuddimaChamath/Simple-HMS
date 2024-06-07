<!DOCTYPE html>
<html>
<head>
    
	<title>Room Availability</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		.container {
			max-width: 1300px;
			margin: 0 auto;
			padding: 16px;
		}
		h1 {
			text-align: center;
			margin-top: 0;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 16px;
		}
		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
		}
		form {
			display: inline-block;
		}
		select {
			margin-right: 8px;
		}
		button {
			background-color: #4CAF50;
			color: white;
			border: none;
			padding: 8px 16px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 4px;
		}
	</style>
</head>
<body>


<div class="container">
	<h1>Room Availability</h1>

<button onclick="location.href='../home.php'">Back</button>


<?php

ob_start();

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_ms";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get list of patients for dropdown
$sql_patients = "SELECT id, name FROM patients";
$result_patients = mysqli_query($conn, $sql_patients);
$patients = array();
while ($row = mysqli_fetch_assoc($result_patients)) {
    $patients[$row['id']] = $row['name'];
}

// Select all records from the 'room_availability' table
$sql = "SELECT * FROM room_availability";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Output the results as a table
    echo "<table><tr><th>ID</th><th>Room ID</th><th>Facilities</th><th>Patient Number</th><th>Availability</th><th>Edit</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row['id']."</td><td>".$row['room_id']."</td><td>".$row['facilities']."</td><td>";
        
        // Patient name
        if ($row['availability'] == 'booked') {
            $patient_number = $row['patient_number'];
            echo isset($patients[$patient_number]) ? $patients[$patient_number] : '';
        }
        
        
        echo "</td><td>".$row['availability']."</td>";
        
        // Edit fields
        echo "<td><form method='POST'><input type='hidden' name='id' value='".$row['id']."'><select name='new_patient_number'";
        if ($row['availability'] == 'available') {
            echo " disabled";
        }
        echo ">";
        echo "<option value=''";
        if ($row['patient_number'] == '') {
            echo " selected";
        }
        echo ">Select Patient</option>";
        foreach ($patients as $patient_id => $patient_name) {
            echo "<option value='".$patient_id."'";
            if ($row['patient_number'] == $patient_id) {
                echo " selected";
            }
            echo ">".$patient_name."</option>";
        }
        echo "</select><select name='new_availability'><option value='booked'";
        if ($row['availability'] == 'booked') {
            echo " selected";
        }
        echo ">Booked</option><option value='available'";
        if ($row['availability'] == 'available') {
            echo " selected";
        }
        echo ">Available</option></select><button type='submit' name='edit'>Save</button></form></td>";
        
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No results found";
}

// Handle edit form submission
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $new_patient_number = isset($_POST['new_patient_number']) ? $_POST['new_patient_number'] : '';
    $new_availability = $_POST['new_availability'];
    $sql = "UPDATE room_availability SET patient_number=".($new_patient_number ? "'$new_patient_number'" : "NULL").", availability='$new_availability' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: room.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


// Close database connection
mysqli_close($conn);

ob_end_flush();
?>
</div>
</body>
</html>
