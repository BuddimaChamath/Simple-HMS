<!DOCTYPE html>
<html>
<head>
<title>Arogya Health Care - Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css">
</head>
<body>
<body>
  <div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
      <form class="col-6" action="loginconn.php" method="post">
        <h2 class="title has-text-centered">Login</h2>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter your username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
        <div class="text-center mt-3">
          <a href="registration/registration.php" class="text-muted">Don't have an account? Register</a>
        </div>
      </form>
    </div>
  </div>
</body>
</body>
</html>