<?php 
session_start();
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    
    // Create a function to validate user inputs
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    //check if the input field is empty
    if (empty($username)) {
        header("Location: login.php?error=User Name is required");
        exit();
    }else if(empty($password)){
        header("Location: login.php?error=Password is required");
        exit();
    }else{
        //verify the username and password from the database
        $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // Check if the entered username and password match the ones in the database
            if ($row['username'] === $username && $row['password'] === $password) {
                //create session variables
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
                exit();
            }else{
                header("Location: login.php?error=Incorrect User name or password");
                exit();
            }
        }else{
            header("Location: login.php?error=Incorrect User name or password");
            exit();
        }
    }

}else{
    header("Location: login.php");
    exit();
}
