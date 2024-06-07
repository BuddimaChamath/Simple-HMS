<!DOCTYPE html>
<html>
<head>
<title>Arogya Health Care</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
      <a class="navbar-brand" href="#">Arogya Health Care</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="login.php">Patients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Staff</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Room Availability</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<main class="container">
    <div class="jumbotron">
      <h1 class="display-7" style="text-align: center;">Arogya Health Care Dashboard</h1>
<?php

// Replace "localhost", "username", "password", and "database_name" with your actual database credentials
$connection = mysqli_connect("localhost", "root", "", "hospital_ms");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Query to retrieve the number of registered patients
$patient_query = "SELECT COUNT(*) AS patient_count FROM patients";
$patient_result = mysqli_query($connection, $patient_query);
$patient_count = mysqli_fetch_assoc($patient_result)["patient_count"];

$waiting_query = "SELECT COUNT(*) AS waiting_count FROM waiting_list";
$waiting_result = mysqli_query($connection, $waiting_query);
$waiting_count = mysqli_fetch_assoc($waiting_result)["waiting_count"];

$invoice_query = "SELECT COUNT(*) AS invoice_count FROM invoices";
$invoice_result = mysqli_query($connection, $invoice_query);
$invoice_count = mysqli_fetch_assoc($invoice_result)["invoice_count"];

// Query to retrieve the number of booked rooms
$booked_query = "SELECT COUNT(*) AS booked_count FROM room_availability WHERE availability = 'booked'";
$booked_result = mysqli_query($connection, $booked_query);
$booked_count = mysqli_fetch_assoc($booked_result)["booked_count"];

// Query to retrieve the number of available rooms
$available_query = "SELECT COUNT(*) AS available_count FROM room_availability WHERE availability = 'available'";
$available_result = mysqli_query($connection, $available_query);
$available_count = mysqli_fetch_assoc($available_result)["available_count"];




// Close the database connection
mysqli_close($connection);

?>

 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
      <div class="patient-count-box">
  <div class="patient-count-item">
    <i class="fas fa-user"></i>
    <span>Registered Patients:</span>
    <span><?php echo $patient_count; ?></span>
  </div>
  <div class="patient-count-item">
    <i class="fas fa-clock"></i>
    <span>Waiting List:</span>
    <span><?php echo $waiting_count; ?></span>
  </div>
  <div class="patient-count-item">
    <i class="fas fa-file-invoice-dollar"></i>
    <span>Invoices:</span>
    <span><?php echo $invoice_count; ?></span>
  </div>
</div>

<style>
  .patient-count-box {
    display: flex;
    justify-content: space-between;
    background-color: #f0f0f0;
    border-radius: 10px;
    padding: 20px;
    font-size: 24px;
  }
  
  .patient-count-item {
    display: flex;
    align-items: center;
    margin-right: 20px;
  }
  
  .patient-count-item i {
    font-size: 48px;
    margin-right: 10px;
  }
  table {
      border-collapse: collapse;
      width: 70%;
  }

  th, td {
      text-align: left;
      padding: 8px;
  }

  th {
      background-color: darkgray;
      color: white;
  }

  tr:nth-child(even) {
      background-color: #f2f2f2;
  }

  tr:hover {
      background-color: #ddd;
  }
</style>

<br>
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_ms";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the number of appointments for each doctor
$sql = "SELECT doctor_name, COUNT(*) as num_appointments FROM waiting_list GROUP BY doctor_name";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
  // Output the results as a table
  echo "<table><tr><th>Doctor Name</th><th>Number of Appointments</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>".$row['doctor_name']."</td><td>".$row['num_appointments']."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No appointments found";
}

// Close the database connection
mysqli_close($conn);
?>
<br>
<div style="display: flex; justify-content: flex-end; margin-top: 20px;">
    <table>
        <tr>
            <th>Room Availability</th>
            <th>Count</th>
        </tr>
        <tr>
            <td>Booked Rooms</td>
            <td><?php echo $booked_count; ?></td>
        </tr>
        <tr>
            <td>Available Rooms</td>
            <td><?php echo $available_count; ?></td>
        </tr>
    </table>
</div>


     
      
</div>
</main>
  <footer id="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>Contact Us</h3>
          <p>
              1234 Main St, Suite 100<br>
              Anytown, SL 12345<br>
              Phone: 011-555-5555<br>
              Email: info@arogyahc.com
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <p>Copyright &copy; Arogya Health Care 2023</p>
            </div>
          </div>
        </div>
      </footer>
  
</body>
</html>
