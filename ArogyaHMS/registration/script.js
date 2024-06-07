function validateForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  if (username == "" || password == "") {
      alert("All fields are required");
      return false;
  }
  // submit form
  document.getElementById("add-user-form").submit();
  // display success message
  document.getElementById("success-message").innerHTML = "Registration successful!";
  document.getElementById("success-message").style.display = "block";
}

