<!DOCTYPE html>
<html>
<head>
<script> scr="script.js"</script>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form action="registration.php" method="post" id="add-user-form">
          <h2 class="text-center mb-5">Sign Up</h2>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Register</button>
          <p class="text-center">Already registered? <a href="../login.php">Login here</a></p>
        </form>
      </div>
    </div>
  </div>
<script>
$( "#add-user-form" ).submit(function( event ) {
    event.preventDefault();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function showSuccessMessage() {
    Swal.fire({
        title: 'Success!',
        text: 'Registration Successful',
        icon: 'success',
        confirmButtonText: 'OK'
    });
}
</script>
</body>
</html>
