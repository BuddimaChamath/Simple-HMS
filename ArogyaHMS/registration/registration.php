<?php
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital_ms";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the form data
    $name = $_POST['username'];
    $pass = $_POST['password'];

    // Insert the patient into the database
    $sql = "INSERT INTO login (username, password) VALUES ('$name', '$pass')";

    if (mysqli_query($conn, $sql)) {
        header("Location: registrationform.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
